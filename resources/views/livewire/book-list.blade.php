<div>
    <div class="bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="container mx-auto px-4 py-12">
            <!-- Header Section -->
            <div class="mb-10 text-center">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">API Book Library</h1>
                <p class="text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto mb-6">
                    Explore our collection of classic literature imported from the Gutendex API, available in multiple
                    formats.
                </p>
                <div class="flex justify-center">
                    <a href="{{ route('api.my-books.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors duration-300 shadow-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        My Reading Library
                    </a>
                </div>
            </div>

            <!-- Notification Messages -->
            @if (session()->has('message'))
                <div
                    class="mb-6 p-4 rounded-lg shadow-md {{ session('message_type') === 'error' ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }} animate-fade-in">
                    <div class="flex items-center">
                        @if (session('message_type') === 'error')
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        @else
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        @endif
                        {{ session('message') }}
                    </div>
                </div>
            @endif

            <!-- Search Bar -->
            <div class="mb-10 max-w-3xl mx-auto">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" wire:model.live.debounce.500ms="search"
                        class="w-full pl-10 pr-4 py-3.5 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="Search by title, author, subjects, or Gutenberg ID...">
                    @if (trim($search))
                        <button wire:click="$set('search', '')"
                            class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="w-5 h-5 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    @endif
                </div>
            </div>

            <!-- No Results -->
            @if (!$decoded_book)
                <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-xl shadow-md">
                    <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    @if (trim($search) !== '')
                        <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">No books found for
                            "{{ $search }}"</h3>
                        <p class="mt-2 text-base text-gray-500 dark:text-gray-400">Try searching for something else or
                            clear the search.</p>
                        <button wire:click="$set('search', '')"
                            class="mt-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                            Clear Search
                        </button>
                    @else
                        <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">No books available</h3>
                        <p class="mt-2 text-base text-gray-500 dark:text-gray-400">Please check back later or try
                            importing some books.</p>
                    @endif
                </div>
            @else
                <!-- Book Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-8">
                    @foreach ($books as $book)
                        <div
                            class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden flex flex-col h-full group hover:shadow-xl transition-all duration-300">
                            <!-- Book Cover -->
                            <div class="relative overflow-hidden bg-gray-200 dark:bg-gray-700 aspect-[3/4] w-full">
                                @if ($book->cover_url)
                                    <img src="{{ $book->cover_url }}" alt="Cover for {{ $book->title }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    </div>
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center text-gray-400 dark:text-gray-500">
                                        <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M2.003 5.884L10 2.5l7.9973.384A1 1 0 0019 7V17a1 1 0 01-1 1H2a1 1 0 01-1-1V7a1 1 0 011.003-1.116zM17 16V7l-7-3.043L3 7v9h14zM5 14h10V9H5v5z" />
                                        </svg>
                                    </div>
                                @endif

                                <!-- Language Badge -->
                                <div
                                    class="absolute top-3 right-3 px-2 py-1 bg-blue-600 text-white text-xs font-medium rounded-md">
                                    {{ \Illuminate\Support\Str::upper($book->language) ?: 'N/A' }}
                                </div>

                                <!-- Quick Actions - visible on hover -->
                                <div
                                    class="absolute bottom-0 left-0 right-0 p-4 flex justify-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <button wire:click="read({{ $book->id }})"
                                        class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        View
                                    </button>
                                    @if ($book->download_url)
                                        <a href="{{ $book->download_url }}" target="_blank" rel="noopener noreferrer"
                                            class="px-3 py-1.5 bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium rounded-lg transition-colors flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                </path>
                                            </svg>
                                            Download
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Book Info -->
                            <div class="p-5 flex flex-col flex-grow">
                                <h3 class="font-semibold text-lg text-gray-800 dark:text-white line-clamp-2 mb-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors"
                                    title="{{ $book->title }}">
                                    {{ $book->title }}
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3" title="{{ $book->author }}">
                                    By: {{ $book->author ?: 'Unknown Author' }}
                                </p>

                                <!-- Description -->
                                <p class="text-sm text-gray-600 dark:text-gray-300 line-clamp-3 mb-4 flex-grow">
                                    {{ \Illuminate\Support\Str::limit($book->description ?: 'No description available.', 150) }}
                                </p>

                                <!-- Book Metadata -->
                                <div class="text-xs text-gray-500 dark:text-gray-400 mb-3 flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-gray-400 dark:text-gray-500" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10">
                                        </path>
                                    </svg>
                                    <span>{{ number_format($book->download_count) ?: 0 }} downloads</span>
                                </div>

                                <!-- Subjects -->
                                @if (!empty($book->subjects))
                                    @php
                                        $subjectList = is_array($book->subjects)
                                            ? $book->subjects
                                            : explode(',', (string) $book->subjects);
                                    @endphp
                                    <div class="mb-4">
                                        <div class="flex flex-wrap gap-1">
                                            @foreach (collect($subjectList)->map(fn($s) => trim($s))->filter()->take(3) as $subject)
                                                <span
                                                    class="inline-block bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 text-xs px-2 py-1 rounded-md">
                                                    {{ $subject }}
                                                </span>
                                            @endforeach
                                            @if (collect($subjectList)->count() > 3)
                                                <span
                                                    class="inline-block bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 text-xs px-2 py-1 rounded-md">
                                                    +{{ collect($subjectList)->count() - 3 }} more
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <!-- Available Formats -->
                                @php
                                    $bookFormats = is_array($book->available_formats)
                                        ? $book->available_formats
                                        : (is_string($book->available_formats)
                                            ? json_decode($book->available_formats, true)
                                            : []);

                                    $formatInfo = [
                                        // MIME
                                        'text/html; charset=utf-8' => ['label' => 'HTML', 'viewable' => true],
                                        'text/html' => ['label' => 'HTML', 'viewable' => true],
                                        'text/plain; charset=utf-8' => ['label' => 'TXT', 'viewable' => true],
                                        'text/plain' => ['label' => 'TXT', 'viewable' => true],
                                        'text/plain; charset=us-ascii' => ['label' => 'TXT', 'viewable' => true],
                                        'application/epub+zip' => ['label' => 'EPUB', 'viewable' => false],
                                        'application/pdf' => ['label' => 'PDF', 'viewable' => false],
                                        'application/x-mobipocket-ebook' => ['label' => 'MOBI', 'viewable' => false],
                                        'application/octet-stream' => ['label' => 'ZIP', 'viewable' => false],
                                        'application/rdf+xml' => ['label' => 'RDF', 'viewable' => false],
                                        'image/jpeg' => ['label' => 'Cover', 'viewable' => true],

                                        // Direct format names
                                        'EPUB' => ['label' => 'EPUB', 'viewable' => false],
                                        'HTML' => ['label' => 'HTML', 'viewable' => true],
                                        'TXT' => ['label' => 'TXT', 'viewable' => true],
                                        'PDF' => ['label' => 'PDF', 'viewable' => false],
                                        'MOBI' => ['label' => 'MOBI', 'viewable' => false],
                                        'RDF' => ['label' => 'RDF', 'viewable' => false],
                                        'Cover' => ['label' => 'Cover', 'viewable' => true],
                                    ];

                                    $formatIcons = [
                                        'PDF' =>
                                            '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.8,16.8c-0.3,0.3-0.4,0.7-0.4,1.2c0,0.4,0.2,0.8,0.4,1c0.3,0.3,0.7,0.4,1.2,0.4c0.3,0,0.6,0,0.8-0.1V16c-0.1,0-0.3,0-0.5,0 C13.6,16,13.1,16.3,12.8,16.8z"/><path d="M14.5,22h-13c-0.6,0-1-0.4-1-1V3c0-0.6,0.4-1,1-1h5c0.1,0,0.3,0,0.4,0.1L10.2,5c0.1,0.1,0.2,0.1,0.3,0.1h9c0.6,0,1,0.4,1,1v5 h-1.5V7.5h-10C8.7,7.5,8.5,7.3,8.5,7V2.5h-6v17h12V22z"/><path d="M21.3,14h-2.2c-0.2,0-0.4,0.2-0.5,0.3l-1.9,5.6c-0.1,0.2,0.1,0.5,0.4,0.5h1c0.2,0,0.3-0.1,0.4-0.3l0.4-1h2.2l0.2,1 c0,0.2,0.2,0.3,0.4,0.3h1.1c0.3,0,0.5-0.3,0.4-0.5l-1.6-5.6C21.7,14.1,21.5,14,21.3,14z M19.4,17.8l0.6-2h0.1l0.3,2H19.4z"/><path d="M16.3,14.2c-0.2-0.1-0.5-0.2-0.9-0.2c-0.3,0-0.5,0-0.8,0h-2.3c-0.2,0-0.4,0.2-0.4,0.4v5.7c0,0.2,0.2,0.4,0.4,0.4h1 c0.2,0,0.4-0.2,0.4-0.4v-1.6c0.1,0,0.3,0,0.4,0c0.4,0,0.8-0.1,1.2-0.2c0.3-0.1,0.6-0.3,0.9-0.6c0.2-0.2,0.4-0.5,0.6-0.9 c0.1-0.3,0.2-0.8,0.2-1.2c0-0.4-0.1-0.8-0.2-1.1C16.9,14.6,16.6,14.4,16.3,14.2z"/></svg>',
                                        'EPUB' =>
                                            '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M16,2H4C3.4,2,3,2.4,3,3v18c0,0.6,0.4,1,1,1h16c0.6,0,1-0.4,1-1V7L16,2z M19,20H5V4h10v4h4V20z"/><path d="M9,8h2v2H9V8z"/><path d="M13,8h2v2h-2V8z"/><path d="M9,12h2v2H9V12z"/><path d="M13,12h2v2h-2V12z"/><path d="M9,16h6v2H9V16z"/></svg>',
                                        'TXT' =>
                                            '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14,2H4C3.4,2,3,2.4,3,3v18c0,0.6,0.4,1,1,1h16c0.6,0,1-0.4,1-1V7L14,2z M19,20H5V4h8v4h6V20z"/><path d="M7,12h10v2H7V12z"/><path d="M7,8h5v2H7V8z"/><path d="M7,16h10v2H7V16z"/></svg>',
                                        'HTML' =>
                                            '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.5,2h-17C2.7,2,2,2.7,2,3.5v17C2,21.3,2.7,22,3.5,22h17c0.8,0,1.5-0.7,1.5-1.5v-17C22,2.7,21.3,2,20.5,2z M20,20H4V4h16 V20z"/><path d="M8.3,9.2l1.5,1.5L7.4,13l2.4,2.4l-1.5,1.5L4.6,13L8.3,9.2z"/><path d="M15.7,9.2l-1.5,1.5l2.4,2.4l-2.4,2.4l1.5,1.5l3.7-3.9L15.7,9.2z"/><path d="M11.1,17l1.5-0.3l0.4-10.7L11.5,6l-0.4,11L11.1,17z"/></svg>',
                                        'MOBI' =>
                                            '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17,3H7C5.9,3,5,3.9,5,5v14c0,1.1,0.9,2,2,2h10c1.1,0,2-0.9,2-2V5C19,3.9,18.1,3,17,3z M17,19H7V5h10V19z"/><path d="M9.5,15.5h5c0.3,0,0.5-0.2,0.5-0.5v-2c0-0.3-0.2-0.5-0.5-0.5h-5C9.2,12.5,9,12.7,9,13v2C9,15.3,9.2,15.5,9.5,15.5z"/><circle cx="12" cy="9" r="1.5"/></svg>',
                                        'ZIP' =>
                                            '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20,6h-8l-2-2H4C2.9,4,2,4.9,2,6v12c0,1.1,0.9,2,2,2h16c1.1,0,2-0.9,2-2V8C22,6.9,21.1,6,20,6z M20,18H4V6h5.2l2,2H20V18z"/><path d="M11,12h2v2h-2V12z"/><path d="M11,8h2v2h-2V8z"/><path d="M15,12h-2v6h4v-2h-2V12z"/></svg>',
                                        'Cover' =>
                                            '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19,3H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h14c1.1,0,2-0.9,2-2V5C21,3.9,20.1,3,19,3z M19,19H5V5h14V19z"/><circle cx="12" cy="12" r="3"/><path d="M8,10H5V7h3V10z"/><path d="M19,17h-3v-3h3V17z"/></svg>',
                                        'RDF' =>
                                            '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M3,13h2v-2H3V13z M3,17h2v-2H3V17z M3,9h2V7H3V9z M7,13h14v-2H7V13z M7,17h14v-2H7V17z M7,7v2h14V7H7z"/></svg>',
                                        'default' =>
                                            '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14,2H6C4.9,2,4,2.9,4,4v16c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V8L14,2z M16,18H8v-2h8V18z M16,14H8v-2h8V14z M13,9V3.5 L18.5,9H13z"/></svg>',
                                    ];

                                    $readOnlineFormats = [];
                                    $downloadableFormats = [];

                                    foreach ($bookFormats as $formatKey => $url) {
                                        if (!$url) {
                                            continue;
                                        }

                                        if (isset($formatInfo[$formatKey])) {
                                            $info = $formatInfo[$formatKey];

                                            if ($info['viewable']) {
                                                $readOnlineFormats[$formatKey] = [
                                                    'url' => $url,
                                                    'label' => $info['label'],
                                                ];
                                            } else {
                                                $downloadableFormats[$formatKey] = [
                                                    'url' => $url,
                                                    'label' => $info['label'],
                                                ];
                                            }
                                        } else {
                                            $label = 'Unknown';

                                            if (strpos($url, '.epub') !== false) {
                                                $label = 'EPUB';
                                                $isViewable = false;
                                            } elseif (
                                                strpos($url, '.html') !== false ||
                                                strpos($url, '.htm') !== false
                                            ) {
                                                $label = 'HTML';
                                                $isViewable = true;
                                            } elseif (strpos($url, '.txt') !== false) {
                                                $label = 'TXT';
                                                $isViewable = true;
                                            } elseif (strpos($url, '.pdf') !== false) {
                                                $label = 'PDF';
                                                $isViewable = false;
                                            } elseif (
                                                strpos($url, '.kf8') !== false ||
                                                strpos($url, '.mobi') !== false
                                            ) {
                                                $label = 'MOBI';
                                                $isViewable = false;
                                            } elseif (strpos($url, '.zip') !== false) {
                                                $label = 'ZIP';
                                                $isViewable = false;
                                            } elseif (
                                                strpos($url, '.jpg') !== false ||
                                                strpos($url, '.jpeg') !== false
                                            ) {
                                                $label = 'Cover';
                                                $isViewable = true;
                                            } elseif (strpos($url, '.rdf') !== false) {
                                                $label = 'RDF';
                                                $isViewable = false;
                                            } else {
                                                $parts = explode('/', $formatKey);
                                                if (count($parts) > 1) {
                                                    $formatPart = $parts[1];

                                                    if (strpos($formatPart, ';') !== false) {
                                                        $formatPart = trim(explode(';', $formatPart)[0]);
                                                    }

                                                    $formatMap = [
                                                        'x-mobipocket-ebook' => 'MOBI',
                                                        'epub+zip' => 'EPUB',
                                                        'octet-stream' => 'Binary',
                                                        'plain' => 'TXT',
                                                        'html' => 'HTML',
                                                    ];

                                                    $label = isset($formatMap[$formatPart])
                                                        ? $formatMap[$formatPart]
                                                        : strtoupper($formatPart);

                                                    $isViewable = in_array($label, ['HTML', 'TXT']);
                                                }
                                            }

                                            if ($isViewable) {
                                                $readOnlineFormats[$formatKey] = [
                                                    'url' => $url,
                                                    'label' => $label,
                                                ];
                                            } else {
                                                $downloadableFormats[$formatKey] = [
                                                    'url' => $url,
                                                    'label' => $label,
                                                ];
                                            }
                                        }
                                    }

                                    $readOnlineFormats = array_filter($readOnlineFormats, function ($item) {
                                        return $item['label'] !== 'Cover' && $item['label'] !== 'RDF';
                                    });

                                    if (!empty($readOnlineFormats)) {
                                        $htmlFormats = array_filter($readOnlineFormats, function ($item) {
                                            return $item['label'] === 'HTML';
                                        });

                                        $txtFormats = array_filter($readOnlineFormats, function ($item) {
                                            return $item['label'] === 'TXT';
                                        });

                                        $otherReadable = array_filter($readOnlineFormats, function ($item) {
                                            return $item['label'] !== 'HTML' && $item['label'] !== 'TXT';
                                        });

                                        $readOnlineFormats = array_merge($htmlFormats, $txtFormats, $otherReadable);
                                    }
                                @endphp

                                @if (!empty($readOnlineFormats) || !empty($downloadableFormats))
                                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-auto">
                                        <!-- Read Online Section -->
                                        @if (!empty($readOnlineFormats))
                                            <div class="mb-3">
                                                <p class="text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                    Read Online:</p>
                                                <div class="flex flex-wrap gap-2">
                                                    @foreach ($readOnlineFormats as $format => $info)
                                                        @php
                                                            $icon =
                                                                $formatIcons[$info['label']] ?? $formatIcons['default'];
                                                        @endphp
                                                        <a href="{{ $info['url'] }}" target="_blank"
                                                            rel="noopener noreferrer"
                                                            class="flex items-center px-3 py-1.5 text-xs font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors">
                                                            {!! $icon !!}
                                                            <span class="ml-1">{{ $info['label'] }}</span>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Download Section -->
                                        @if (!empty($downloadableFormats))
                                            <div>
                                                <p class="text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                    Download as:</p>
                                                <div class="flex flex-wrap gap-2">
                                                    @foreach ($downloadableFormats as $format => $info)
                                                        @php
                                                            $icon =
                                                                $formatIcons[$info['label']] ?? $formatIcons['default'];
                                                        @endphp
                                                        <a href="{{ $info['url'] }}" target="_blank"
                                                            rel="noopener noreferrer" download
                                                            class="flex items-center px-3 py-1.5 text-xs font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                                            {!! $icon !!}
                                                            <span class="ml-1">{{ $info['label'] }}</span>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @elseif ($book->download_url)
                                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-auto">
                                        <a href="{{ $book->download_url }}" target="_blank"
                                            rel="noopener noreferrer"
                                            class="w-full block py-2 px-3 text-sm font-medium text-center text-gray-700 dark:text-white bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                            Download Original File
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($books->hasPages())
                    <div class="mt-12">
                        {{ $books->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>

</div>
