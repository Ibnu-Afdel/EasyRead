<div>

    <div class="container mx-auto px-4 py-8">
        @if (session()->has('message'))
            <div
                class="mb-6 p-4 rounded-lg {{ session('message_type') === 'error' ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }}">
                {{ session('message') }}
            </div>
        @endif

        <div class="mb-8">
            <input type="text" wire:model.live.debounce.500ms="search"
                class="w-full px-5 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-shadow"
                placeholder="Search by title, author, description, subjects, or Gutenberg ID...">
        </div>

        @if ($books->isEmpty() && trim($search) !== '')
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 10h.01" />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">No
                    books found for "{{ $search }}"</h3>
                <p class="mt-1 text-sm text-gray-500">Try searching for
                    something else or clear the search.</p>
            </div>
        @elseif ($books->isEmpty())
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">No
                    books available</h3>
                <p class="mt-1 text-sm text-gray-500">Please check back
                    later or try importing some books.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-8">
                @foreach ($books as $book)
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col transition-all duration-300 ease-in-out hover:shadow-2xl">
                        @if ($book->cover_url)
                            <div class="w-full h-56 overflow-hidden">
                                <img src="{{ $book->cover_url }}" alt="Cover for {{ $book->title }}"
                                    class="w-full h-full object-cover" {{-- onerror="this.onerror=null; this.src='https://placehold.co/400x560/cccccc/969696?text=No+Cover';" --}}>
                            </div>
                        @else
                            <div class="w-full h-56 bg-gray-200 flex items-center justify-center text-gray-400">
                                <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M2.003 5.884L10 2.5l7.9973.384A1 1 0 0019 7V17a1 1 0 01-1 1H2a1 1 0 01-1-1V7a1 1 0 011.003-1.116zM17 16V7l-7-3.043L3 7v9h14zM5 14h10V9H5v5z" />
                                </svg>
                                <span class="sr-only">No Cover
                                    Available</span>
                            </div>
                        @endif

                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="font-semibold text-lg text-gray-800 truncate" title="{{ $book->title }}">
                                {{ $book->title }}
                            </h3>
                            <p class="text-xs text-gray-500 mb-2 truncate" title="{{ $book->author }}">
                                By: {{ $book->author ?: 'Unknown Author' }}
                            </p>
                            <p class="text-sm text-gray-600 line-clamp-3 mb-3 flex-grow min-h-[60px]">

                                {{ \Illuminate\Support\Str::limit(
                                    $book->description ?:
                                    'No description
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    available.',
                                    100,
                                ) }}
                            </p>
                            <div class="text-xs text-gray-500 mb-1">
                                <span class="font-semibold">Language:</span>
                                {{ \Illuminate\Support\Str::title($book->language) ?: 'N/A' }}
                            </div>
                            <div class="text-xs text-gray-500 mb-3">
                                <span class="font-semibold">Downloads:</span>
                                {{ number_format($book->download_count) ?: 0 }}
                            </div>

                            @if (!empty($book->subjects))
                                @php
                                    $subjectList = is_array($book->subjects)
                                        ? $book->subjects
                                        : explode(',', (string) $book->subjects);
                                @endphp
                                <div class="mb-3 text-xs">
                                    <span class="font-semibold">Subjects:</span>
                                    <span class="space-x-1">
                                        @foreach (collect($subjectList)->map(fn($s) => trim($s))->filter()->take(3) as $subject)
                                            <span
                                                class="inline-block bg-gray-200 rounded-full px-2 py-0.5 text-gray-700">{{ $subject }}</span>
                                        @endforeach
                                        @if (collect($subjectList)->count() > 3)
                                            <span class="text-gray-500">...</span>
                                        @endif
                                    </span>
                                </div>
                            @endif

                            <div class="mt-auto pt-3 border-t border-gray-200 space-y-2">
                                <button wire:click="read({{ $book->id }})"
                                    class="w-full py-2 px-3 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 transition-colors">
                                    View Details / Read
                                </button>

                                {{-- Download Options --}}
                                @if ($book->available_formats && is_array($book->available_formats) && count($book->available_formats) > 0)
                                    <div class="pt-1">
                                        <p class="text-xs font-semibold text-gray-700 mb-1 text-center">Download as:</p>
                                        <div class="flex flex-wrap gap-1 justify-center">
                                            @foreach ($book->available_formats as $format => $url)
                                                @if ($url)
                                                    <a href="{{ $url }}" target="_blank"
                                                        rel="noopener noreferrer"
                                                        class="flex-grow basis-1/4 max-w-max py-1 px-2 text-xs font-medium text-center text-gray-900 bg-gray-100 rounded-md border border-gray-300 hover:bg-gray-200 focus:ring-2 focus:outline-none focus:ring-gray-200 transition-colors">
                                                        {{ strtoupper($format) }}
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @elseif ($book->download_url)
                                    <div class="pt-1">
                                        <p class="text-xs font-semibold text-gray-700 mb-1 text-center">Download:</p>
                                        <a href="{{ $book->download_url }}" target="_blank" rel="noopener noreferrer"
                                            class="w-full block py-2 px-3 text-sm font-medium text-center text-gray-900 bg-gray-100 rounded-lg border border-gray-300 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-200 transition-colors">
                                            Access Original File
                                        </a>
                                    </div>
                                @else
                                    <div class="pt-1">
                                        <span
                                            class="block w-full text-center py-2 px-3 text-sm font-medium text-gray-400 bg-gray-50 rounded-lg border border-gray-200">
                                            No Download Available
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($books->hasPages())
                <div class="mt-10">
                    {{ $books->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
