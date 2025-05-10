<div>
    <div class="bg-gray-50 dark:bg-gray-900 min-h-screen py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-10 text-center">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Your Reading Library</h1>
                <p class="text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto mb-6">
                    Track your reading progress and manage your personal collection of books.
                </p>
                <div class="flex justify-center">
                    <a href="{{ route('api.books.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-300 shadow-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Book Library
                    </a>
                </div>
            </div>

            <!-- Notification Messages -->
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

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl p-6">
                <!-- Filter Controls -->
                <div class="mb-8 flex flex-wrap gap-4 items-center">
                    <div class="w-full md:w-auto">
                        <label for="filterStatus"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter by
                            Status:</label>
                        <div class="relative">
                            <select wire:model.live="filterStatus" id="filterStatus"
                                class="block w-full pl-3 pr-10 py-2.5 text-base border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg shadow-sm">
                                <option value="">All Books</option>
                                <option value="reading">Currently Reading</option>
                                <option value="completed">Completed</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-auto">
                        <label for="sortBy"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sort By:</label>
                        <div class="relative">
                            <select wire:model.live="sortBy" id="sortBy"
                                class="block w-full pl-3 pr-10 py-2.5 text-base border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg shadow-sm">
                                <option value="pivot_updated_at_desc">Recently Updated</option>
                                <option value="pivot_started_at_desc">Recently Started</option>
                                <option value="pivot_finished_at_desc">Recently Finished</option>
                                <option value="title_asc">Title (A-Z)</option>
                                <option value="title_desc">Title (Z-A)</option>
                                <option value="author_asc">Author (A-Z)</option>
                                <option value="author_desc">Author (Z-A)</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                            </div>
                        </div>
                    </div>
                </div>

                @if ($myBooks->isEmpty())
                    <div
                        class="text-center py-16 bg-gray-50 dark:bg-gray-700 rounded-xl border border-gray-200 dark:border-gray-600">
                        <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6-2.292m0 0A9.043 9.043 0 0 1 9 7.5a9.018 9.018 0 0 0-3 1.372A8.967 8.967 0 0 1 3 9m18 0a8.967 8.967 0 0 0-3-1.372A9.018 9.018 0 0 1 15 7.5a9.043 9.043 0 0 0-3-1.458m0 14.25v-5.625c0-.621.504-1.125 1.125-1.125h1.75c.621 0 1.125.504 1.125 1.125v5.625m0 0A9.004 9.004 0 0 1 12 21a9.004 9.004 0 0 1-3-1.708m0 0v-5.625c0-.621-.504-1.125-1.125-1.125H6.125c-.621 0-1.125.504-1.125 1.125v5.625m0 0A9.004 9.004 0 0 0 3 21a9.004 9.004 0 0 0 3-1.708M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">Your Bookshelf is Empty
                        </h3>
                        <p class="mt-2 text-base text-gray-500 dark:text-gray-400 max-w-md mx-auto">
                            Start building your personal library by adding books from the
                            <a href="{{ route('api.books.index') }}"
                                class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium">book
                                collection</a>.
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('api.books.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Browse Books
                            </a>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach ($myBooks as $book)
                            <div
                                class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden flex flex-col h-full group hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700">
                                <!-- Book Cover & Status Badge -->
                                <div class="relative overflow-hidden aspect-[3/4]">
                                    <a href="{{ route('api.books.show', $book) }}">
                                        @if ($book->cover_url)
                                            <img src="{{ $book->cover_url }}" alt="Cover for {{ $book->title }}"
                                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                        @else
                                            <div
                                                class="w-full h-full bg-gradient-to-br from-blue-400 to-indigo-600 flex items-center justify-center">
                                                <svg class="w-24 h-24 text-white/50" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M2.003 5.884L10 2.5l7.997 3.384A1 1 0 0019 7V17a1 1 0 01-1 1H2a1 1 0 01-1-1V7a1 1 0 011.003-1.116zM17 16V7l-7-3.043L3 7v9h14zM5 14h10V9H5v5z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </a>

                                    <!-- Status Badge -->
                                    <div
                                        class="absolute top-3 right-3 px-2.5 py-1.5 rounded-md shadow-sm
                                        @if ($book->pivot->status == 'reading') bg-blue-600 text-white @else bg-green-600 text-white @endif">
                                        <div class="flex items-center text-xs font-medium">
                                            @if ($book->pivot->status == 'reading')
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                                    </path>
                                                </svg>
                                            @else
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            @endif
                                            {{ ucfirst($book->pivot->status) }}
                                        </div>
                                    </div>

                                    <!-- Overlay with quick actions -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end justify-center p-4">
                                        <a href="{{ route('api.books.show', $book) }}"
                                            class="px-3 py-1.5 bg-white text-gray-900 text-sm font-medium rounded-lg transition-colors flex items-center mx-1 hover:bg-gray-100">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                            View Details
                                        </a>
                                    </div>
                                </div>

                                <!-- Book Info -->
                                <div class="p-5 flex flex-col flex-grow">
                                    <h4
                                        class="font-semibold text-lg text-gray-800 dark:text-white mb-1 line-clamp-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                        <a href="{{ route('api.books.show', $book) }}">{{ $book->title }}</a>
                                    </h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                        By: {{ $book->author ?: 'Unknown Author' }}
                                    </p>

                                    <!-- Reading Progress -->
                                    <div class="space-y-2 mb-4">
                                        @if ($book->pivot->started_at)
                                            <div class="flex items-center text-xs text-gray-600 dark:text-gray-400">
                                                <svg class="w-4 h-4 mr-1.5 text-blue-500 dark:text-blue-400"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                Started:
                                                {{ \Carbon\Carbon::parse($book->pivot->started_at)->format('M d, Y') }}
                                            </div>
                                        @endif

                                        @if ($book->pivot->status == 'completed' && $book->pivot->finished_at)
                                            <div class="flex items-center text-xs text-gray-600 dark:text-gray-400">
                                                <svg class="w-4 h-4 mr-1.5 text-green-500 dark:text-green-400"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Finished:
                                                {{ \Carbon\Carbon::parse($book->pivot->finished_at)->format('M d, Y') }}
                                            </div>

                                            @if ($book->pivot->started_at)
                                                <div
                                                    class="flex items-center text-xs text-gray-600 dark:text-gray-400">
                                                    <svg class="w-4 h-4 mr-1.5 text-purple-500 dark:text-purple-400"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Read in:
                                                    {{ \Carbon\Carbon::parse($book->pivot->started_at)->diffInDays(\Carbon\Carbon::parse($book->pivot->finished_at)) }}
                                                    days
                                                </div>
                                            @endif
                                        @endif
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="mt-auto pt-3 space-y-2">
                                        @if ($book->pivot->status == 'reading')
                                            <button wire:click="markAsCompleted({{ $book->id }})"
                                                wire:loading.attr="disabled"
                                                class="w-full py-2 px-3 text-sm font-medium text-center text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 rounded-lg focus:ring-2 focus:ring-green-300 transition-all duration-300 flex items-center justify-center">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Mark as Completed
                                            </button>
                                        @elseif($book->pivot->status == 'completed')
                                            <button wire:click="markAsReading({{ $book->id }})"
                                                wire:loading.attr="disabled"
                                                class="w-full py-2 px-3 text-sm font-medium text-center text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 rounded-lg focus:ring-2 focus:ring-blue-300 transition-all duration-300 flex items-center justify-center">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                                    </path>
                                                </svg>
                                                Move to Reading
                                            </button>
                                        @endif

                                        <button wire:click="removeFromMyBooks({{ $book->id }})"
                                            wire:confirm="Are you sure you want to remove '{{ $book->title }}' from your books?"
                                            wire:loading.attr="disabled"
                                            class="w-full py-2 px-3 text-sm font-medium text-center text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors flex items-center justify-center">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                            Remove from Library
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
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
