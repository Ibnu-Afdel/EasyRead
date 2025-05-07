<div class="container mx-auto px-4 py-8">
    @if (session()->has('message'))
        <div
            class="mb-6 p-4 rounded-lg {{ session('message_type') === 'error' ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }}">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
        <div class="md:flex">
            <div class="md:w-1/3 p-6 bg-gray-50 border-r border-gray-200 flex flex-col">
                @if ($book->cover_url)
                    <img src="{{ $book->cover_url }}" alt="Cover for {{ $book->title }}"
                        class="rounded-lg shadow-md w-full h-auto object-cover mb-6">
                @else
                    <div class="w-full h-80 bg-gray-200 flex items-center justify-center text-gray-400 rounded-lg mb-6">
                        <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M2.003 5.884L10 2.5l7.997 3.384A1 1 0 0019 7V17a1 1 0 01-1 1H2a1 1 0 01-1-1V7a1 1 0 011.003-1.116zM17 16V7l-7-3.043L3 7v9h14zM5 14h10V9H5v5z" />
                        </svg>
                        <span class="sr-only">No Cover Available</span>
                    </div>
                @endif

                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $book->title }}</h1>
                <p class="text-lg text-gray-600 mb-4">By: {{ $book->author ?: 'Unknown Author' }}</p>

                <div class="space-y-3 text-sm mb-6">
                    <div>
                        <span class="font-semibold text-gray-700">Language:</span>
                        <span class="text-gray-600">{{ $Str::title($book->language) ?: 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="font-semibold text-gray-700">Downloads:</span>
                        <span class="text-gray-600">{{ number_format($book->download_count) ?: '0' }}</span>
                    </div>
                    <div>
                        <span class="font-semibold text-gray-700">Media
                            Type:</span>
                        <span class="text-gray-600">{{ $book->media_type ?: 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="font-semibold text-gray-700">Gutenberg ID:</span>
                        <span class="text-gray-600">{{ $book->gutenberg_id }}</span>
                    </div>
                </div>

                <div class="mt-auto pt-4 border-t border-gray-100">
                    @if ($book->available_formats && is_array($book->available_formats) && count($book->available_formats) > 0)
                        <h3 class="text-md font-semibold text-gray-700 mb-2">Download Formats:</h3>
                        <div class="space-y-2">
                            @foreach ($book->available_formats as $format => $url)
                                @if ($url)
                                    <a href="{{ $url }}" target="_blank" rel="noopener noreferrer"
                                        class="block w-full text-center py-2.5 px-4 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 transition-colors">
                                        Download {{ strtoupper($format) }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @elseif($book->download_url)
                        <h3 class="text-md font-semibold text-gray-700 mb-2">Download:</h3>
                        <a href="{{ $book->download_url }}" wire:click.prevent="downloadBook"
                            class="block w-full text-center py-3 px-4 text-base font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 transition-colors">
                            Download Book
                        </a>
                    @else
                        <p class="text-sm text-gray-500">No download formats available for this book.</p>
                    @endif
                </div>
            </div>

            <div class="md:w-2/3 p-6 md:p-8">
                @if ($book->description)
                    <div class="mb-8">
                        <h2 class="text-2xl font-semibold text-gray-700 mb-3">Description</h2>
                        <div class="prose prose-sm sm:prose lg:prose-lg xl:prose-xl max-w-none text-gray-600">
                            {!! nl2br(e($book->description)) !!}
                        </div>
                    </div>
                @endif

                @if (!empty($book->subjects))
                    @php
                        $subjectListShow = is_array($book->subjects)
                            ? $book->subjects
                            : explode(',', (string) $book->subjects);
                    @endphp
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Subjects</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach (collect($subjectListShow)->map(fn($s) => trim($s))->filter() as $subject)
                                <span
                                    class="bg-gray-200 text-gray-700 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $subject }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (!empty($book->bookshelves))
                    @php
                        $bookshelfListShow = is_array($book->bookshelves)
                            ? $book->bookshelves
                            : explode(',', (string) $book->bookshelves);
                    @endphp
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Bookshelves</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach (collect($bookshelfListShow)->map(fn($s) => trim($s))->filter() as $bookshelf)
                                <span
                                    class="bg-indigo-100 text-indigo-700 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $bookshelf }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mt-6">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Read Online</h2>
                    @php
                        $onlineReadUrl = null;
                        $isHtml = false;
                        $isPdf = false;
                        $isTxt = false;

                        if ($book->available_formats && is_array($book->available_formats)) {
                            if (isset($book->available_formats['HTML (UTF-8)'])) {
                                $onlineReadUrl = $book->available_formats['HTML (UTF-8)'];
                                $isHtml = true;
                            } elseif (isset($book->available_formats['HTML'])) {
                                $onlineReadUrl = $book->available_formats['HTML'];
                                $isHtml = true;
                            } elseif (isset($book->available_formats['PDF'])) {
                                $onlineReadUrl = $book->available_formats['PDF'];
                                $isPdf = true;
                            } elseif (isset($book->available_formats['TXT'])) {
                                $onlineReadUrl = $book->available_formats['TXT'];
                                $isTxt = true;
                            }
                        }

                        if (!$onlineReadUrl && $book->read_url) {
                            $onlineReadUrl = $book->read_url;
                            if (
                                $Str::contains(strtolower($onlineReadUrl), ['.htm', '.html']) ||
                                $Str::contains(strtolower($book->media_type ?? ''), 'html')
                            ) {
                                $isHtml = true;
                            } elseif ($Str::contains(strtolower($onlineReadUrl), '.pdf')) {
                                $isPdf = true;
                            } elseif (
                                $Str::contains(strtolower($onlineReadUrl), '.txt') ||
                                $Str::contains(strtolower($book->media_type ?? ''), 'text/plain')
                            ) {
                                $isTxt = true;
                            }
                        }

                        if (!$onlineReadUrl && $book->download_url) {
                            if (
                                $Str::contains(strtolower($book->download_url), ['.htm', '.html']) ||
                                $Str::contains(strtolower($book->media_type ?? ''), 'html')
                            ) {
                                $onlineReadUrl = $book->download_url;
                                $isHtml = true;
                            } elseif ($Str::contains(strtolower($book->download_url), '.pdf')) {
                                $onlineReadUrl = $book->download_url;
                                $isPdf = true;
                            } elseif (
                                $Str::contains(strtolower($book->download_url), '.txt') ||
                                $Str::contains(strtolower($book->media_type ?? ''), 'text/plain')
                            ) {
                                $onlineReadUrl = $book->download_url;
                                $isTxt = true;
                            }
                        }

                    @endphp

                    @if ($onlineReadUrl)
                        @if ($isPdf)
                            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4"
                                role="alert">
                                <p class="font-bold">PDF Viewing Note</p>
                                <p>Depending on the source server's settings and your browser, it might download instead
                                    of displaying below. Use the "Download PDF" button for direct access.</p>
                            </div>
                            <iframe src="{{ $onlineReadUrl }}" class="w-full h-[80vh] border rounded-lg shadow"
                                title="Book Content Viewer (PDF)"></iframe>
                        @elseif ($isHtml)
                            <iframe src="{{ $onlineReadUrl }}" class="w-full h-[80vh] border rounded-lg shadow"
                                title="Book Content Viewer (HTML)"></iframe>
                        @elseif ($isTxt)
                            <iframe src="{{ $onlineReadUrl }}"
                                class="w-full h-[80vh] border rounded-lg shadow bg-white"
                                title="Book Content Viewer (Text)"></iframe>
                        @else
                            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-4" role="alert">
                                <p class="font-bold">Online Reading Note</p>
                                <p>Attempting to display content. If it doesn't load correctly, please use a download
                                    option.</p>
                            </div>
                            <iframe src="{{ $onlineReadUrl }}" class="w-full h-[80vh] border rounded-lg shadow"
                                title="Book Content Viewer"></iframe>
                        @endif
                    @else
                        <p class="text-gray-500">No content available for online reading. Try a download option if
                            available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 text-center">
        <a href="{{ route('api.books.index') }}" class="text-blue-600 hover:text-blue-800 hover:underline">&larr; Back
            to Book List</a>
    </div>
</div>
