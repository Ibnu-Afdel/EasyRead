<nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
    <div class="flex flex-wrap items-center justify-between mx-auto max-w-screen-xl">
        <div class="flex items-center">
            <a href="/" class="flex items-center">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">
                    ReadEasy
                </span>
            </a>
        </div>

        <!-- Mobile menu button -->
        <div class="flex items-center lg:hidden">
            @auth
                <form method="POST" action="{{ route('logout') }}" class="mr-2">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="_method" value="DELETE">
                    <x-auth-button>Log Out</x-auth-button>
                </form>
            @endauth

            <button id="mobile-menu-toggle" data-collapse-toggle="mobile-menu" type="button"
                class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="mobile-menu" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg id="menu-icon" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
                <svg id="close-icon" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <!-- Navigation menu - desktop and mobile -->
        <div class="hidden w-full lg:flex lg:w-auto lg:order-1 justify-center" id="mobile-menu">
            <ul
                class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0 p-4 lg:p-0 bg-gray-50 lg:bg-transparent dark:bg-gray-800 rounded-lg border border-gray-200 lg:border-0 dark:border-gray-700">
                <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                <x-nav-link href="/books" :active="request()->is('books')">Books</x-nav-link>
                <x-nav-link href="{{ route('api.books.index') }}" :active="request()->is('api/books*')">Gutendex API</x-nav-link>
                @can('create', 'App\Models\Book')
                    <x-nav-link href="/admin" :active="request()->is('admin')">Admin Page</x-nav-link>
                @endcan
                @can('is-librarian')
                    <x-nav-link href="/librarian" :active="request()->is('librarian')">Librarian Page</x-nav-link>
                @endcan
                @guest
                    <div class="lg:hidden mt-4 flex flex-col space-y-2">
                        <x-auth-link href="{{ route('register') }}">Register</x-auth-link>
                        <x-auth-link href="{{ route('login') }}">Log In</x-auth-link>
                    </div>
                @endguest
            </ul>
        </div>

        <div class="hidden lg:flex items-center lg:order-2">
            @guest
                <x-auth-link href="{{ route('register') }}">Register</x-auth-link>
                <x-auth-link href="{{ route('login') }}">Log In</x-auth-link>
            @endguest

            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="_method" value="DELETE">
                    <x-auth-button>Log Out</x-auth-button>
                </form>
            @endauth
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                menuIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });
        }
    });
</script>
