<x-layout>
    @section('title', 'Create Book')
    @section('heading')
    Create your Book
    @endsection

    <form method="POST" action="{{ route('books.store') }}">
        @csrf

        <label for="name">Book Name</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">
        @error('name')
            {{ $message }}
        @enderror
        <br> <br>

        <label for="description">Book Description</label>
        <input type="text" name="description" id="description" value="{{ old('description') }}">
        @error('description')
            {{ $message }}
        @enderror
        <br><hr>

        <button>Create</button>
    </form>
    
</x-layout>