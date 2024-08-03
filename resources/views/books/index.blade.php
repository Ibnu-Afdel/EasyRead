<x-layout>
    @section('title', 'Books')
    @section('heading')
    All Books
    @endsection

    <a href="{{ route('books.create') }}">Create</a> <br><br>

    @forelse ($books as $book )
       <p> - <a href="{{ route('books.show', $book) }}"> <b>{{ $book->name }} </b></a></p>
    @empty
        no book
    @endforelse


</x-layout>