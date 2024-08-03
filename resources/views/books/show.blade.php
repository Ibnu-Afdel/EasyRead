<x-layout>
    @section('title', 'Show Book')
    @section('heading')

    {{ $book->name }}
    
    @endsection
    <br>
    {{ $book->description }} <br> <br>

    <a href="{{ route('books.edit', $book) }}">Edit</a>

    <form method="POST" action="{{ route('books.destroy',$book) }}">
        @csrf
        @method('DELETE')
        <input type="hidden" name="_method" value="DELETE">

        <button>Delete</button>
    </form>
    
</x-layout>