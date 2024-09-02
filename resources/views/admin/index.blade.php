<x-layout>
    @section('title', 'Books')
    @section('heading')
    Admins Page 
    @auth
       :  {{ Auth::user()->name }}
    @endauth
    @guest
        : Guest
    @endguest
    @endsection


    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">

            <div class>
                <a href="{{ route('books.index') }}" class="inline-flex items-center font-medium  text-primary-600 dark:text-primary-500 hover:underline">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M9.707 3.293a1 1 0 010 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 01-1.414 1.414l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </a>
             </div>

            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
              <livewire:admin-search />
    
            </div>
        </div>
        </section>
</x-layout>


