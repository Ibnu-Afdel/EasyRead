<x-layout>
    @section('title', 'Books')
    @section('heading')
    All Books 
    @auth
       :  {{ Auth::user()->name }}
    @endauth
    @guest
        : Guest
    @endguest
    @endsection
    
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
                <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Our Books</h2>
                <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400"> Your Free Library Online </p>
            </div> 
            <div class="grid gap-8 lg:grid-cols-2">
                @forelse ($books as $book )

                <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 flex">
                    @if($book->BookCover)
                        <img src="{{ asset( $book->BookCover) }}" 
                             alt="{{ $book->name }}" 
                             class="h-40 w-40 object-cover rounded-lg mr-4 mb-4 mt-4" 
                             style="object-position: center;">
                    @endif
                    <div class="flex flex-col justify-between flex-1">
                        <div>
                            <div class="flex justify-between items-center mb-5 text-gray-500">
                                <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                    <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"></path><path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z"></path></svg>
                                    Article
                                </span>
                                <span class="text-sm">{{ $book->created_at->diffForHumans() }}</span>
                            </div>
                            <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                <a href="#">{{ $book->name }}</a>
                            </h2>
                            <p class="mb-5 font-light text-gray-500 dark:text-gray-400">
                                {{ Illuminate\Support\Str::limit($book->description, 255) }}
                            </p>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-4">
                                <img class="w-7 h-7 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" alt="Jese Leos avatar" />
                                <span class="font-medium dark:text-white">
                                    {{ $book->user->name }}
                                </span>
                            </div>
                            <a href="{{ route('books.show', $book) }}" class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                                Read more
                                <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </a>
                        </div>
                    </div>
                </article>
                @empty
                No Book Available !
            @endforelse
            </div>  
        </div>
      </section>

</x-layout>