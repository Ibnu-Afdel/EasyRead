<?php

namespace App\Console\Commands;

use App\Models\Book;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportGutendexBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'books:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import free books from Gutendex API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fetching free books from Gutendex API...');

        $page = 1;
        $imported = 0;

        while (true) {
            $response = Http::get("https://gutendex.com/books?topic=business&page=$page");

            if ($response->failed()) {
                $this->error("Failed to fetch from API (status: {$response->status()})");
                return;
            }

            $books = $response->json('results');
            if (empty($books)) {
                $this->info("No more books to import.");
                break;
            }

            foreach ($books as $bookData) {
                $formats = $bookData['formats'];

                $downloadUrl = $formats['application/pdf']
                    ?? $formats['text/html; charset=utf-8']
                    ?? $formats['application/epub+zip']
                    ?? null;

                if (!$downloadUrl) continue;

                $cover = $formats['image/jpeg'] ?? null;
                $authors = collect($bookData['authors'] ?? [])
                    ->pluck('name')
                    ->implode(', ') ?: 'Unknown';

                $book = Book::updateOrCreate([
                    'gutenberg_id' => $bookData['id'],
                ], [
                    'title' => $bookData['title'],
                    'author' => $authors,
                    'cover_url' => $cover,
                    'download_url' => $downloadUrl,
                    'description' => $bookData['summary'] ?? 'Imported from Gutendex',
                    'subjects' => implode(', ', $bookData['subjects'] ?? []),
                    'bookshelves' => implode(', ', $bookData['bookshelves'] ?? []),
                    'language' => $bookData['languages'][0] ?? 'unknown',
                    'media_type' => $bookData['media_type'] ?? 'Text',
                    'download_count' => $bookData['download_count'] ?? 0,
                ]);

                $imported++;
            }

            $this->info("Imported page $page...");
            $page++;
        }

        $this->info("✅ Done! Total books imported or updated: $imported");
    }
}
