<x-layout>
    @section('title', 'Edit Book')
    @section('heading')
    Edit your Book
    @endsection

    <form method="POST" action="{{ route('books.update',$book) }}">
        @csrf
        @method('PATCH')
       <input type="hidden" name="_method" value ="PATCH"> 

        <label for="name">Book Name</label>
        <input type="text" name="name" id="name" value="{{ $book->name }}">
        @error('name')
            {{ $message }}
        @enderror
        <br> <br>

        <label for="description">Book Description</label>
        <input type="text" name="description" id="description" value="{{ $book->description }}">
        @error('description')
            {{ $message }}
        @enderror
        <br><hr>

        <button>Edit</button>
    </form>
    
</x-layout>