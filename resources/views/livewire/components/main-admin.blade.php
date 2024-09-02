<div class="overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-4 py-3">Title</th>
                <th scope="col" class="px-4 py-3 w-1/3">Description</th>
                <th scope="col" class="px-4 py-3">Placeholder</th>
                <th scope="col" class="px-4 py-3">Role</th>
                <th scope="col" class="px-4 py-3">Actions</th>
                <th scope="col" class="px-4 py-3">Price</th>
                
            </tr>
        </thead>
        @forelse ($books as $book)
        <tbody>
            <tr class="border-b dark:border-gray-700">
                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   <a href="{{ route('books.show', $book->id) }}"> <div class="text-lg font-bold">{{ $book->name }}</div> </a>
                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                </th>
                
                <td class="px-4 py-3 w-1/3">{{ Illuminate\Support\Str::limit($book->description, 255) }}</td>
                <td class="px-4 py-3"> 
                    @if($book->BookCover)
                    <img src="{{ asset( $book->BookCover) }}" 
                         alt="{{ $book->name }}" 
                         class="h-40 w-40 object-cover rounded-lg mr-4 mb-4 mt-4" 
                         style="object-position: center;">
                    @else
                    <p>No Book Cover</p>
                    @endif    
                </td>
                <td class="px-4 py-3">{{ $user->role }}</td>
                <td class="px-4 py-3 text-center">
                    <div class="flex justify-center space-x-2">
                        <a href="{{ route('books.edit', $book->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    </div>
                </td>
                <td class="px-4 py-3">Free</td>
            </tr>
        </tbody>
        @empty
        <tbody>
            <tr>
                <td colspan="6" class="px-4 py-3 text-center">No book available</td>
            </tr>
        </tbody>
        @endforelse
    </table>

    <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
        <div class="flex space-x-4">
            {{ $books->links() }}
        </div>
    </nav>
</div>