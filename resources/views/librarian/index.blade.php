<x-layout>
    @section('title', 'Borrowed Books')
    @section('heading')
    Librarian Page 
    @auth
       :  {{ Auth::user()->name }}
    @endauth
    @guest
        : Guest
    @endguest
    @endsection

    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
               <livewire:librarian-search /> 
               
            </div>
        </div>
    </section>
</x-layout>
