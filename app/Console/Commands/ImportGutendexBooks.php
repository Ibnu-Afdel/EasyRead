<?php

namespace App\Console\Commands;

use App\Models\Book;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class ImportGutendexBooks extends Command
{

    protected $signature = 'books:import {--pages=0 : The number of pages to fetch from the API. 0 for no limit.}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import free books from Gutendex API, with an option to limit pages processed, storing multiple download formats.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Fetching free books from Gutendex API...');
        $page = 1;
        $importedCount = 0;
        $updatedCount = 0;

        $pageLimit = (int) $this->option('pages');
        if ($pageLimit <= 0) {
            $pageLimit = PHP_INT_MAX;
        }

        while ($page <= $pageLimit) {
            $this->line("Attempting to fetch page: {$page}");

            try {
                $response = Http::get("https://gutendex.com/books", [
                    // 'topic' => 'business', 
                    'page' => $page,
                ]);

                if ($response->failed()) {
                    $this->error("Failed to fetch from API (status: {$response->status()}) on page {$page}.");
                    Log::error("Gutendex API request failed with status: {$response->status()}", ['response_body' => $response->body()]);
                    break;
                }

                $booksData = $response->json('results');

                if (empty($booksData)) {
                    $this->info("No more books to import. Reached end of results on page {$page}.");
                    break;
                }

                foreach ($booksData as $bookData) {
                    $formats = $bookData['formats'] ?? [];
                    $availableFormats = [];


                    $primaryDownloadUrl = $formats['application/pdf']
                        ?? $formats['text/html; charset=utf-8']
                        ?? $formats['application/epub+zip']
                        ?? $formats['text/plain; charset=utf-8']
                        ?? null;

                    if (isset($formats['application/pdf'])) {
                        $availableFormats['PDF'] = $formats['application/pdf'];
                    }
                    if (isset($formats['application/epub+zip'])) {
                        $availableFormats['EPUB'] = $formats['application/epub+zip'];
                    }
                    if (isset($formats['text/plain; charset=utf-8'])) {
                        $availableFormats['TXT'] = $formats['text/plain; charset=utf-8'];
                    }
                    if (isset($formats['text/html; charset=utf-8'])) {
                        $availableFormats['HTML (UTF-8)'] = $formats['text/html; charset=utf-8'];
                    } elseif (isset($formats['text/html'])) {
                        $availableFormats['HTML'] = $formats['text/html'];
                    }
                    if (isset($formats['application/x-mobipocket-ebook'])) {
                        $availableFormats['MOBI'] = $formats['application/x-mobipocket-ebook'];
                    }



                    if (!$primaryDownloadUrl && !empty($availableFormats)) {
                        $primaryDownloadUrl = reset($availableFormats);
                    }


                    if (!$primaryDownloadUrl && empty($availableFormats)) {
                        $this->warn("Skipping book '{$bookData['title']}' (ID: {$bookData['id']}) due to no suitable download URLs.");
                        continue;
                    }

                    $cover = $formats['image/jpeg'] ?? null;

                    $authors = collect($bookData['authors'] ?? [])
                        ->pluck('name')
                        ->implode(', ') ?: 'Unknown';

                    $description = ($bookData['summaries'][0] ?? 'No summary')  . "Imported from hello Gutendex. Subjects: " . implode(', ', $bookData['subjects'] ?? ['N/A']);

                    $book = Book::updateOrCreate(
                        ['gutenberg_id' => $bookData['id']],
                        [
                            'title' => $bookData['title'] ?? 'Untitled',
                            'author' => $authors,
                            'cover_url' => $cover,
                            'download_url' => $primaryDownloadUrl,
                            'read_url' => $availableFormats['HTML (UTF-8)'] ?? $availableFormats['HTML'] ?? $primaryDownloadUrl,
                            'available_formats' => json_encode($availableFormats),
                            'description' => $description,
                            'subjects' => implode(',', $bookData['subjects'] ?? []),
                            'bookshelves' => implode(',', $bookData['bookshelves'] ?? []),
                            'language' => $bookData['languages'][0] ?? 'unknown',
                            'media_type' => $bookData['media_type'] ?? 'Text',
                            'download_count' => $bookData['download_count'] ?? 0,
                        ]
                    );

                    if ($book->wasRecentlyCreated) {
                        $importedCount++;
                    } elseif ($book->wasChanged()) {
                        $updatedCount++;
                    }
                }

                $this->info("Processed page {$page}. Current totals - Imported: {$importedCount}, Updated: {$updatedCount}");

                if ($page >= $pageLimit && $pageLimit !== PHP_INT_MAX) {
                    $this->info("Reached specified page limit of {$pageLimit}.");
                    break;
                }

                $page++;
                sleep(1);
            } catch (Exception $e) {
                $this->error("An exception occurred on page {$page}: " . $e->getMessage());
                Log::error("Exception during Gutendex import: " . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
                break;
            }
        }

        $this->info("Done! Total new books imported: {$importedCount}. Total books updated: {$updatedCount}.");
        return Command::SUCCESS;
    }
}
