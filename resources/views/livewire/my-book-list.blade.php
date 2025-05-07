<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-2xl font-semibold text-gray-700 mb-6">Your Reading Library</h3>

                @if (session()->has('message'))
                    <div
                        class="mb-4 p-4 rounded-lg {{ session('message_type') === 'error' ? 'bg-red-200 text-red-700' : 'bg-green-200 text-green-700' }}">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="mb-6 flex flex-wrap gap-4 items-center">
                    <div>
                        <label for="filterStatus" class="block text-sm font-medium text-gray-700">Filter by
                            Status:</label>
                        <select wire:model.live="filterStatus" id="filterStatus"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="">All</option>
                            <option value="reading">Reading</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div>
                        <label for="sortBy" class="block text-sm font-medium text-gray-700">Sort By:</label>
                        <select wire:model.live="sortBy" id="sortBy"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="pivot_updated_at_desc">Recently Updated</option>
                            <option value="pivot_started_at_desc">Recently Started</option>
                            <option value="pivot_finished_at_desc">Recently Finished</option>
                            <option value="title_asc">Title (A-Z)</option>
                            <option value="title_desc">Title (Z-A)</option>
                            <option value="author_asc">Author (A-Z)</option>
                            <option value="author_desc">Author (Z-A)</option>
                        </select>
                    </div>
                </div>

                @if ($myBooks->isEmpty())
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6-2.292m0 0A9.043 9.043 0 0 1 9 7.5a9.018 9.018 0 0 0-3 1.372A8.967 8.967 0 0 1 3 9m18 0a8.967 8.967 0 0 0-3-1.372A9.018 9.018 0 0 1 15 7.5a9.043 9.043 0 0 0-3-1.458m0 14.25v-5.625c0-.621.504-1.125 1.125-1.125h1.75c.621 0 1.125.504 1.125 1.125v5.625m0 0A9.004 9.004 0 0 1 12 21a9.004 9.004 0 0 1-3-1.708m0 0v-5.625c0-.621-.504-1.125-1.125-1.125H6.125c-.621 0-1.125.504-1.125 1.125v5.625m0 0A9.004 9.004 0 0 0 3 21a9.004 9.004 0 0 0 3-1.708M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">Your bookshelf is empty.</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Start adding books by clicking "View Details / Read" on the main <a
                                href="{{ route('books.index') }}" class="text-indigo-600 hover:text-indigo-800">books
                                page</a>.
                        </p>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($myBooks as $book)
                            <div class="bg-gray-50 rounded-lg shadow-md overflow-hidden flex flex-col">
                                <a href="{{ route('api.books.show', $book) }}">
                                    @if ($book->cover_url)
                                        <img src="{{ $book->cover_url }}" alt="Cover for {{ $book->title }}"
                                            class="w-full h-56 object-cover" {{-- onerror="this.onerror=null; this.src='https://placehold.co/400x560/cccccc/969696?text=No+Cover';"> --}}>
                                    @else
                                        <div
                                            class="w-full h-56 bg-gray-200 flex items-center justify-center text-gray-400">
                                            <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M2.003 5.884L10 2.5l7.997 3.384A1 1 0 0019 7V17a1 1 0 01-1 1H2a1 1 0 01-1-1V7a1 1 0 011.003-1.116zM17 16V7l-7-3.043L3 7v9h14zM5 14h10V9H5v5z" />
                                            </svg>
                                        </div>
                                    @endif
                                </a>
                                <div class="p-4 flex flex-col flex-grow">
                                    <h4 class="font-semibold text-md text-gray-800 truncate hover:text-indigo-600">
                                        <a href="{{ route('api.books.show', $book) }}">{{ $book->title }}</a>
                                    </h4>
                                    <p class="text-xs text-gray-500 mb-1 truncate">By:
                                        {{ $book->author ?: 'Unknown Author' }}</p>
                                    <p
                                        class="text-sm capitalize font-medium mb-2 p-1 rounded
                                        @if ($book->pivot->status == 'reading') bg-blue-100 text-blue-700 @else bg-green-100 text-green-700 @endif">
                                        Status: {{ str_replace('_', ' ', $book->pivot->status) }}
                                    </p>
                                    @if ($book->pivot->started_at)
                                        <p class="text-xs text-gray-500">Started:
                                            {{ \Carbon\Carbon::parse($book->pivot->started_at)->format('M d, Y') }}</p>
                                    @endif
                                    @if ($book->pivot->status == 'completed' && $book->pivot->finished_at)
                                        <p class="text-xs text-gray-500">Finished:
                                            {{ \Carbon\Carbon::parse($book->pivot->finished_at)->format('M d, Y') }}
                                        </p>
                                    @endif

                                    <div class="mt-auto pt-3 space-y-2">
                                        @if ($book->pivot->status == 'reading')
                                            <button wire:click="markAsCompleted({{ $book->id }})"
                                                wire:loading.attr="disabled"
                                                class="w-full py-2 px-3 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 transition-colors">
                                                Mark as Completed
                                            </button>
                                        @elseif($book->pivot->status == 'completed')
                                            <button wire:click="markAsReading({{ $book->id }})"
                                                wire:loading.attr="disabled"
                                                class="w-full py-2 px-3 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 transition-colors">
                                                Move to Reading
                                            </button>
                                        @endif
                                        <button wire:click="removeFromMyBooks({{ $book->id }})"
                                            wire:confirm="Are you sure you want to remove '{{ $book->title }}' from your books?"
                                            wire:loading.attr="disabled"
                                            class="w-full py-2 px-3 text-sm font-medium text-center text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-100 transition-colors">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if ($myBooks->hasPages())
                        <div class="mt-8">
                            {{ $myBooks->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
