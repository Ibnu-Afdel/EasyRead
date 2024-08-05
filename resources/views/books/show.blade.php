<x-layout>
    @section('title', 'Show Book')
    @section('heading')

    {{ $book->name }}
    
    @endsection

     <div class="ml-20 mt-10 ">
        <a href="{{ route('books.index') }}" class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M9.707 3.293a1 1 0 010 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 01-1.414 1.414l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
        </a>
     </div>

    <article class="p-6 mt-4 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 mx-auto" style="max-width: 90%;">
        <div class="flex justify-between items-center mb-5 text-gray-500">
            {{-- above title --}}
            <div class="flex items-center space-x-4">
                <img class="w-7 h-7 rounded-full" src="{{ $book->user->profile_image_url }}" alt="{{ $book->user->name }} avatar" />
                <span class="font-medium dark:text-white">{{ $book->user->name }}</span>
            </div>
            <span class="text-sm">{{ $book->created_at->diffForHumans() }}</span>
        </div>
        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $book->name }}</h2>
        
        @if($book->BookCover)
            <div class="flex">
                <img src="{{ asset($book->BookCover) }}" 
                     alt="{{ $book->BookCover }}" 
                     class="w-60 h-60 object-cover rounded-lg mr-4 mb-4 mt-4"
                     style="object-position: center;">
                <p class="font-light text-gray-500 dark:text-gray-400">{{ $book->description }}</p>
            </div>
        @else
            <p class="mb-5 font-light text-gray-500 dark:text-gray-400">{{ $book->description }}</p>
        @endif
            <div>
                <button form="borrow-book" type="submit" class=" font-bold text-yellow-400 hover:underline" onclick="return confirm('Are you sure you want to borrow this book?');" >Borrow</button>
            </div>
        
        <div class="flex justify-between items-center mt-4">
            <div class="flex items-center space-x-4">
                <a href="{{ route('books.index') }}" class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                    Back
                </a>
                @can('update', 'App\Models\Book')
                <a href="{{ route('books.edit', $book) }}" class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                    Edit
                    <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.414 2.586a2 2 0 010 2.828l-1.586 1.586-2.828-2.828L14.586 2.586a2 2 0 012.828 0zM4 13.414V17h3.586l9.293-9.293-3.586-3.586L4 13.414z"></path>
                    </svg>
                </a>
                <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center font-medium text-red-600 dark:text-red-500 hover:underline">
                        Delete
                    </button>
                </form>
                @endcan
            </div>
            @if($book->created_at != $book->updated_at)
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    Updated at {{ $book->updated_at->format('F j, Y') }}
                </span>
            @endif
        </div>
    </article>
    
    
    <form  class="hidden" id="borrow-book" action="{{ route('books.borrow', $book) }}" method="POST">
        @csrf
    </form>
</x-layout>













