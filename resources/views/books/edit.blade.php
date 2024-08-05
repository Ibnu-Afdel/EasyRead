<x-layout>
    @section('title', 'Edit Book')
    @section('heading')
    Edit your Book
    @endsection

    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow dark:bg-gray-800 mt-10">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Add a New Book</h2>
        <form action="{{ route('books.update',$book) }}" method="POST" enctype="multipart/form-data" >
            @csrf
            @method('PATCH')
            <input type="hidden" name="_method" value ="PATCH">
            <div class="mb-4">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Book Name</label>
                <input value="{{ $book->name }}" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <x-error name='name' />
            </div>
            <div class="mb-4">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <textarea name="description" id="description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $book->description }}</textarea>
                <x-error name='description' />
                <div class="mt-2"> 
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="BookCover">Upload file</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="BookCover" type="file" name="BookCover">
                    </div>
                    <x-error name='book_cover' />
            </div>
            <a href="{{ url()->previous() }}" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" >back</a>
            <button type="submit" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Edit</button>
        </form>
    </div>
    
</x-layout>