<div class="container mx-auto px-4 py-8 max-w-7xl">
    @if (session()->has('message'))
        <div
            class="mb-6 p-4 rounded-lg shadow-sm {{ session('message_type') === 'error' ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }} animate-fade-in-down">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    @if (session('message_type') === 'error')
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    @else
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    @endif
                </svg>
                {{ session('message') }}
            </div>
        </div>
    @endif

    <div
        class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-700">
        <div class="relative">
            @if ($book->cover_url)
                <div class="w-full h-72 bg-gradient-to-b from-transparent to-black relative overflow-hidden">
                    <img src="{{ $book->cover_url }}" alt="Cover for {{ $book->title }}"
                        class="w-full h-full object-cover opacity-50">
                </div>
                <div class="absolute inset-x-0 bottom-0 p-8 text-white">
                    <h1 class="text-4xl font-bold mb-2 drop-shadow-lg">{{ $book->title }}</h1>
                    <p class="text-xl drop-shadow-md">By: {{ $book->author ?: 'Unknown Author' }}</p>
                </div>
            @else
                <div
                    class="w-full h-72 bg-gradient-to-r from-blue-500 to-indigo-600 relative overflow-hidden flex items-center justify-center">
                    <svg class="w-32 h-32 text-white/50" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M2.003 5.884L10 2.5l7.997 3.384A1 1 0 0019 7V17a1 1 0 01-1 1H2a1 1 0 01-1-1V7a1 1 0 011.003-1.116zM17 16V7l-7-3.043L3 7v9h14zM5 14h10V9H5v5z" />
                    </svg>
                    <div class="absolute inset-x-0 bottom-0 p-8 text-white">
                        <h1 class="text-4xl font-bold mb-2 drop-shadow-lg">{{ $book->title }}</h1>
                        <p class="text-xl drop-shadow-md">By: {{ $book->author ?: 'Unknown Author' }}</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="md:flex">
            <div
                class="md:w-1/3 p-6 bg-gray-50 dark:bg-gray-900 border-r border-gray-200 dark:border-gray-700 flex flex-col">
                <!-- Book info card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5 mb-6">
                    <div class="flex flex-wrap gap-4 mb-4">
                        <div
                            class="flex items-center px-3 py-1.5 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-full text-sm">
                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z">
                                </path>
                            </svg>
                            {{ $Str::title($book->language) ?: 'N/A' }}
                        </div>
                        <div
                            class="flex items-center px-3 py-1.5 bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-full text-sm">
                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd"
                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            {{ number_format($book->download_count) ?: '0' }} views
                        </div>
                        @if ($book->media_type)
                            <div
                                class="flex items-center px-3 py-1.5 bg-purple-50 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 rounded-full text-sm">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 01-1.581.814L10 14.584l-4.419 2.23A1 1 0 014 16V4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                {{ $book->media_type }}
                            </div>
                        @endif
                        <div
                            class="flex items-center px-3 py-1.5 bg-yellow-50 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 rounded-full text-sm">
                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1v-3a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            ID: {{ $book->gutenberg_id }}
                        </div>
                    </div>
                </div>

                <!-- Cover image for mobile view -->
                <div class="md:hidden mb-6">
                    @if ($book->cover_url)
                        <img src="{{ $book->cover_url }}" alt="Cover for {{ $book->title }}"
                            class="rounded-lg shadow-lg w-full h-auto object-cover">
                    @else
                        <div
                            class="w-full h-60 bg-gradient-to-r from-blue-400 to-indigo-500 flex items-center justify-center text-white rounded-lg">
                            <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M2.003 5.884L10 2.5l7.997 3.384A1 1 0 0019 7V17a1 1 0 01-1 1H2a1 1 0 01-1-1V7a1 1 0 011.003-1.116zM17 16V7l-7-3.043L3 7v9h14zM5 14h10V9H5v5z" />
                            </svg>
                            <span class="sr-only">No Cover Available</span>
                        </div>
                    @endif
                </div>

                <div class="mt-auto pt-4">
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
                                '<svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12.8,16.8c-0.3,0.3-0.4,0.7-0.4,1.2c0,0.4,0.2,0.8,0.4,1c0.3,0.3,0.7,0.4,1.2,0.4c0.3,0,0.6,0,0.8-0.1V16c-0.1,0-0.3,0-0.5,0 C13.6,16,13.1,16.3,12.8,16.8z"/><path d="M14.5,22h-13c-0.6,0-1-0.4-1-1V3c0-0.6,0.4-1,1-1h5c0.1,0,0.3,0,0.4,0.1L10.2,5c0.1,0.1,0.2,0.1,0.3,0.1h9c0.6,0,1,0.4,1,1v5 h-1.5V7.5h-10C8.7,7.5,8.5,7.3,8.5,7V2.5h-6v17h12V22z"/><path d="M21.3,14h-2.2c-0.2,0-0.4,0.2-0.5,0.3l-1.9,5.6c-0.1,0.2,0.1,0.5,0.4,0.5h1c0.2,0,0.3-0.1,0.4-0.3l0.4-1h2.2l0.2,1 c0,0.2,0.2,0.3,0.4,0.3h1.1c0.3,0,0.5-0.3,0.4-0.5l-1.6-5.6C21.7,14.1,21.5,14,21.3,14z M19.4,17.8l0.6-2h0.1l0.3,2H19.4z"/><path d="M16.3,14.2c-0.2-0.1-0.5-0.2-0.9-0.2c-0.3,0-0.5,0-0.8,0h-2.3c-0.2,0-0.4,0.2-0.4,0.4v5.7c0,0.2,0.2,0.4,0.4,0.4h1 c0.2,0,0.4-0.2,0.4-0.4v-1.6c0.1,0,0.3,0,0.4,0c0.4,0,0.8-0.1,1.2-0.2c0.3-0.1,0.6-0.3,0.9-0.6c0.2-0.2,0.4-0.5,0.6-0.9 c0.1-0.3,0.2-0.8,0.2-1.2c0-0.4-0.1-0.8-0.2-1.1C16.9,14.6,16.6,14.4,16.3,14.2z"/></svg>',
                            'EPUB' =>
                                '<svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M16,2H4C3.4,2,3,2.4,3,3v18c0,0.6,0.4,1,1,1h16c0.6,0,1-0.4,1-1V7L16,2z M19,20H5V4h10v4h4V20z"/><path d="M9,8h2v2H9V8z"/><path d="M13,8h2v2h-2V8z"/><path d="M9,12h2v2H9V12z"/><path d="M13,12h2v2h-2V12z"/><path d="M9,16h6v2H9V16z"/></svg>',
                            'TXT' =>
                                '<svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M14,2H4C3.4,2,3,2.4,3,3v18c0,0.6,0.4,1,1,1h16c0.6,0,1-0.4,1-1V7L14,2z M19,20H5V4h8v4h6V20z"/><path d="M7,12h10v2H7V12z"/><path d="M7,8h5v2H7V8z"/><path d="M7,16h10v2H7V16z"/></svg>',
                            'HTML' =>
                                '<svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M20.5,2h-17C2.7,2,2,2.7,2,3.5v17C2,21.3,2.7,22,3.5,22h17c0.8,0,1.5-0.7,1.5-1.5v-17C22,2.7,21.3,2,20.5,2z M20,20H4V4h16 V20z"/><path d="M8.3,9.2l1.5,1.5L7.4,13l2.4,2.4l-1.5,1.5L4.6,13L8.3,9.2z"/><path d="M15.7,9.2l-1.5,1.5l2.4,2.4l-2.4,2.4l1.5,1.5l3.7-3.9L15.7,9.2z"/><path d="M11.1,17l1.5-0.3l0.4-10.7L11.5,6l-0.4,11L11.1,17z"/></svg>',
                            'MOBI' =>
                                '<svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17,3H7C5.9,3,5,3.9,5,5v14c0,1.1,0.9,2,2,2h10c1.1,0,2-0.9,2-2V5C19,3.9,18.1,3,17,3z M17,19H7V5h10V19z"/><path d="M9.5,15.5h5c0.3,0,0.5-0.2,0.5-0.5v-2c0-0.3-0.2-0.5-0.5-0.5h-5C9.2,12.5,9,12.7,9,13v2C9,15.3,9.2,15.5,9.5,15.5z"/><circle cx="12" cy="9" r="1.5"/></svg>',
                            'ZIP' =>
                                '<svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M20,6h-8l-2-2H4C2.9,4,2,4.9,2,6v12c0,1.1,0.9,2,2,2h16c1.1,0,2-0.9,2-2V8C22,6.9,21.1,6,20,6z M20,18H4V6h5.2l2,2H20V18z"/><path d="M11,12h2v2h-2V12z"/><path d="M11,8h2v2h-2V8z"/><path d="M15,12h-2v6h4v-2h-2V12z"/></svg>',
                            'Cover' =>
                                '<svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M19,3H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h14c1.1,0,2-0.9,2-2V5C21,3.9,20.1,3,19,3z M19,19H5V5h14V19z"/><circle cx="12" cy="12" r="3"/><path d="M8,10H5V7h3V10z"/><path d="M19,17h-3v-3h3V17z"/></svg>',
                            'RDF' =>
                                '<svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M3,13h2v-2H3V13z M3,17h2v-2H3V17z M3,9h2V7H3V9z M7,13h14v-2H7V13z M7,17h14v-2H7V17z M7,7v2h14V7H7z"/></svg>',
                            'default' =>
                                '<svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M14,2H6C4.9,2,4,2.9,4,4v16c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V8L14,2z M16,18H8v-2h8V18z M16,14H8v-2h8V14z M13,9V3.5 L18.5,9H13z"/></svg>',
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
                                } elseif (strpos($url, '.html') !== false || strpos($url, '.htm') !== false) {
                                    $label = 'HTML';
                                    $isViewable = true;
                                } elseif (strpos($url, '.txt') !== false) {
                                    $label = 'TXT';
                                    $isViewable = true;
                                } elseif (strpos($url, '.pdf') !== false) {
                                    $label = 'PDF';
                                    $isViewable = false;
                                } elseif (strpos($url, '.kf8') !== false || strpos($url, '.mobi') !== false) {
                                    $label = 'MOBI';
                                    $isViewable = false;
                                } elseif (strpos($url, '.zip') !== false) {
                                    $label = 'ZIP';
                                    $isViewable = false;
                                } elseif (strpos($url, '.jpg') !== false || strpos($url, '.jpeg') !== false) {
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

                        $onlineReadUrl = null;
                        $isPdf = false;
                        $isHtml = false;
                        $isTxt = false;

                        if (!empty($readOnlineFormats)) {
                            $firstFormat = reset($readOnlineFormats);
                            $onlineReadUrl = $firstFormat['url'];
                            $onlineReadFormatLabel = $firstFormat['label'];

                            $isPdf = $onlineReadFormatLabel === 'PDF';
                            $isHtml = $onlineReadFormatLabel === 'HTML';
                            $isTxt = $onlineReadFormatLabel === 'TXT';
                        }
                    @endphp

                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-5">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z">
                                </path>
                            </svg>
                            Available Formats
                        </h3>

                        @if (!empty($downloadableFormats) || !empty($readOnlineFormats))
                            <div class="space-y-5">
                                @if (!empty($readOnlineFormats))
                                    <div class="mb-5">
                                        <h4
                                            class="text-sm font-medium text-gray-600 dark:text-gray-300 mb-3 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-blue-500" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                <path fill-rule="evenodd"
                                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Read Online:
                                        </h4>
                                        <div class="grid grid-cols-1 gap-2">
                                            @foreach ($readOnlineFormats as $format => $info)
                                                <a href="{{ $info['url'] }}" target="_blank" rel="noopener noreferrer"
                                                    class="flex items-center justify-between px-4 py-3 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 rounded-lg shadow-sm hover:shadow transform transition-all duration-200 hover:-translate-y-0.5">
                                                    <span class="flex items-center">
                                                        {!! $formatIcons[$info['label']] ?? $formatIcons['default'] !!}
                                                        Read {{ $info['label'] }}
                                                    </span>
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if (!empty($downloadableFormats))
                                    <div>
                                        <h4
                                            class="text-sm font-medium text-gray-600 dark:text-gray-300 mb-3 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Download as:
                                        </h4>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                            @foreach ($downloadableFormats as $format => $info)
                                                <a href="{{ $info['url'] }}" target="_blank" rel="noopener noreferrer"
                                                    download
                                                    class="flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg shadow-sm hover:shadow transition-all duration-200">
                                                    <span class="flex items-center">
                                                        {!! $formatIcons[$info['label']] ?? $formatIcons['default'] !!}
                                                        {{ $info['label'] }}
                                                    </span>
                                                    <svg class="w-4 h-4 text-gray-500" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @elseif($book->download_url)
                            <a href="{{ $book->download_url }}" wire:click.prevent="downloadBook"
                                class="flex items-center justify-center w-full py-3 px-4 text-base font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Download Book
                            </a>
                        @else
                            <div
                                class="flex items-center justify-center text-gray-500 dark:text-gray-400 py-4 border border-dashed border-gray-300 dark:border-gray-600 rounded-lg">
                                <svg class="w-6 h-6 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <p>No download formats available for this book.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="md:w-2/3 p-6 md:p-8 bg-white dark:bg-gray-800">
                @if ($book->description)
                    <div class="mb-8">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Description
                        </h2>
                        <div
                            class="prose prose-sm sm:prose lg:prose-lg max-w-none text-gray-600 dark:text-gray-300 bg-gray-50 dark:bg-gray-700/50 p-6 rounded-xl shadow-sm">
                            {!! nl2br(e($book->description)) !!}
                        </div>
                    </div>
                @endif

                <div class="grid md:grid-cols-2 gap-8 mb-8">
                    @if (!empty($book->subjects))
                        @php
                            $subjectListShow = is_array($book->subjects)
                                ? $book->subjects
                                : explode(',', (string) $book->subjects);
                        @endphp
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Subjects
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach (collect($subjectListShow)->map(fn($s) => trim($s))->filter() as $subject)
                                    <span
                                        class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-xs font-medium px-2.5 py-1 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors cursor-default">
                                        {{ $subject }}
                                    </span>
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
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Bookshelves
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach (collect($bookshelfListShow)->map(fn($s) => trim($s))->filter() as $bookshelf)
                                    <span
                                        class="bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 text-xs font-medium px-2.5 py-1 rounded-full hover:bg-indigo-200 dark:hover:bg-indigo-800/30 transition-colors cursor-default">
                                        {{ $bookshelf }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="mt-6">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                            <path fill-rule="evenodd"
                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Read Online
                    </h2>

                    @if ($onlineReadUrl)
                        @if ($isPdf)
                            <div class="bg-yellow-100 dark:bg-yellow-800/20 border-l-4 border-yellow-500 dark:border-yellow-600 text-yellow-700 dark:text-yellow-300 p-4 mb-4 rounded-r-lg"
                                role="alert">
                                <div class="flex">
                                    <svg class="w-5 h-5 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1v-3a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <div>
                                        <p class="font-bold">PDF Viewing Note</p>
                                        <p>Depending on the source server's settings and your browser, it might download
                                            instead
                                            of displaying below. Use the "Download PDF" button for direct access.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl shadow-md p-2 overflow-hidden">
                                <iframe src="{{ $onlineReadUrl }}" class="w-full h-[80vh] border-0 rounded-lg"
                                    title="Book Content Viewer (PDF)"></iframe>
                            </div>
                        @elseif ($isHtml)
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl shadow-md p-2 overflow-hidden">
                                <iframe src="{{ $onlineReadUrl }}" class="w-full h-[80vh] border-0 rounded-lg"
                                    style="background-color: #FEF9E7; color: #333333;"
                                    title="Book Content Viewer (HTML)"></iframe>
                            </div>
                        @elseif ($isTxt)
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl shadow-md p-2 overflow-hidden">
                                <iframe src="{{ $onlineReadUrl }}" class="w-full h-[80vh] border-0 rounded-lg"
                                    style="background-color: #FEF9E7; color: #333333;"
                                    title="Book Content Viewer (Text)"></iframe>

                            </div>
                        @else
                            <div class="bg-blue-100 dark:bg-blue-800/20 border-l-4 border-blue-500 dark:border-blue-600 text-blue-700 dark:text-blue-300 p-4 mb-4 rounded-r-lg"
                                role="alert">
                                <div class="flex">
                                    <svg class="w-5 h-5 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1v-3a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <div>
                                        <p class="font-bold">Online Reading Note</p>
                                        <p>Attempting to display content. If it doesn't load correctly, please use a
                                            download
                                            option.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl shadow-md p-2 overflow-hidden">
                                <iframe src="{{ $onlineReadUrl }}" class="w-full h-[80vh] border-0 rounded-lg"
                                    style="background-color: #FEF9E7; color: #333333;"
                                    title="Book Content Viewer"></iframe>

                            </div>
                        @endif
                    @else
                        <div
                            class="flex items-center justify-center p-8 bg-gray-50 dark:bg-gray-700 rounded-xl text-gray-500 dark:text-gray-400">
                            <svg class="w-12 h-12 mr-3 text-gray-300 dark:text-gray-600" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                            <div>
                                <p class="text-lg font-semibold">No content available for online reading</p>
                                <p>Try a download option if available to access this book</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 text-center">
        <a href="{{ route('api.books.index') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 bg-white dark:bg-gray-800 dark:text-blue-400 border border-blue-300 dark:border-blue-600 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                    clip-rule="evenodd"></path>
            </svg>
            Back to Book List
        </a>
    </div>
</div>
