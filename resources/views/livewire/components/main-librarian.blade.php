<div class="overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-4 py-3">User</th>
                <th scope="col" class="px-4 py-3">Book</th>
                <th scope="col" class="px-4 py-3">Borrowed On</th>
                <th scope="col" class="px-4 py-3">Due Date</th>
                <th scope="col" class="px-4 py-3">Status</th>
                <th scope="col" class="px-4 py-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrowedBooks as $borrowedBook)
            <tr class="border-b dark:border-gray-700">
                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <a href="{{ route('books.index') }}"> <div class="text-lg font-bold">{{  $borrowedBook->user->name  }}</div> </a>
                     <div class="text-sm text-gray-500">{{  $borrowedBook->user->email  }}</div>
                 </th>
                <td class="px-4 py-3">{{ $borrowedBook->book->name }}</td>
                <td class="px-4 py-3">{{ $borrowedBook->created_at->format('Y-m-d') }}</td>
                <td class="px-4 py-3">{{ $borrowedBook->due_date->format('Y-m-d') }}</td>
                <td class="px-4 py-3">
                    @if ($borrowedBook->due_date->isPast())
                        <span class="text-red-500">Overdue</span>
                    @else
                        <span class="text-green-500">On Time</span>
                    @endif
                </td>

                <td class="px-4 py-3 text-center">
                    <div class="flex items-center justify-center space-x-2">
                        <form action="{{ route('borrowed-books.return', $borrowedBook->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to mark this book as returned?');">
                            @csrf
                            <button type="submit" class="text-green-500 hover:text-green-700">Mark as Returned</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
    <div class="flex space-x-4">
        {{ $borrowedBooks->links() }}
    </div>
</nav>