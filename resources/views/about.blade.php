<x-layout>
    @section('title', 'About')
    @section('heading')
    About Us
    @endsection

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">About EasyRead</h1>
            <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">Your ultimate destination for a seamless book borrowing and buying experience.</p>
            <div class="px-4 mx-auto text-center md:max-w-screen-md lg:max-w-screen-lg lg:px-36">
                <p class="mb-6 text-lg font-medium text-gray-700 dark:text-gray-300">
                    At EasyRead, we provide a rich and diverse collection of books, both free and premium, ensuring that every book lover finds something to enjoy. Our platform is more than just a library; it's a community of readers who share a passion for books.
                </p>
                <p class="mb-6 text-lg font-medium text-gray-700 dark:text-gray-300">
                    Becoming a member is simple—just sign in and you're in! Members can enjoy exclusive gatherings, fostering a sense of community and enabling connections with fellow book enthusiasts.
                </p>
                <p class="mb-6 text-lg font-medium text-gray-700 dark:text-gray-300">
                    For those who are active and engaged, we offer the opportunity to be promoted to librarians. Librarians enjoy a host of benefits, including rewards, exclusive gathering attendance, free premium books, and commissions on the sale of premium books.
                </p>
                <p class="mb-6 text-lg font-medium text-gray-700 dark:text-gray-300">
                    EasyRead is dedicated to providing a seamless and enriching experience for book lovers everywhere. Join us today and become part of a community that celebrates the joy of reading.
                </p>
                <div class="flex flex-col mb-8 lg:mb-16 space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('books.index') }}" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                        Start Exploring Books
                        <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                    <a href="https://t.me/IbnuAfdelDevDiary" target="_blank" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        Join Our Telegram
                        <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>  
                </div>

                <div class="px-4 mx-auto text-center md:max-w-screen-md lg:max-w-screen-lg lg:px-36">
                    <span class="font-semibold text-gray-400 uppercase">Ibnu Afdel's Socials</span>
                    <div class="flex flex-wrap justify-center items-center mt-8 text-gray-500 sm:justify-between">

                        <a href="https://youtube.com" class="mr-5 mb-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400 flex items-center">
                            <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.498 6.186a2.997 2.997 0 00-2.113-2.116C19.584 3.5 12 3.5 12 3.5s-7.584 0-9.385.57A2.997 2.997 0 00.502 6.186C0 8.063 0 12 0 12s0 3.937.502 5.814a2.997 2.997 0 002.113 2.116C4.416 20.5 12 20.5 12 20.5s7.584 0 9.385-.57a2.997 2.997 0 002.113-2.116C24 15.937 24 12 24 12s0-3.937-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" fill="currentColor"/>
                            </svg>
                            <span class="ml-2 text-lg font-semibold">YouTube</span>
                        </a>
                        
                        <a href="https://t.me/IbnuAfdelDevDiary" class="mr-5 mb-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400 flex items-center">
                            <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 0C5.371 0 0 5.371 0 12C0 18.629 5.371 24 12 24C18.629 24 24 18.629 24 12C24 5.371 18.629 0 12 0ZM17.462 7.377L15.894 16.37C15.783 16.963 15.414 17.128 14.896 16.845L12.083 14.764L10.786 16.02C10.665 16.141 10.563 16.243 10.321 16.243L10.501 13.345L15.267 8.741C15.494 8.533 15.223 8.419 14.935 8.627L8.63 12.615L5.783 11.759C5.204 11.589 5.189 11.182 5.931 10.879L16.857 6.57C17.343 6.381 17.744 6.653 17.462 7.377Z" fill="currentColor"/>
                            </svg>
                            <span class="ml-2 text-lg font-semibold">Telegram</span>
                        </a>

                        <a href="https://github.com" class="mr-5 mb-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400 flex items-center">
                            <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 .297C5.373.297 0 5.67 0 12.297c0 5.297 3.438 9.8 8.205 11.388.6.112.82-.26.82-.577 0-.285-.01-1.04-.015-2.04-3.338.726-4.042-1.61-4.042-1.61-.546-1.387-1.332-1.757-1.332-1.757-1.09-.746.082-.73.082-.73 1.204.084 1.838 1.237 1.838 1.237 1.07 1.835 2.807 1.305 3.492.997.107-.775.42-1.305.764-1.604-2.665-.302-5.466-1.333-5.466-5.93 0-1.31.47-2.382 1.235-3.223-.124-.302-.536-1.522.117-3.176 0 0 1.008-.322 3.303 1.23.957-.266 1.983-.399 3.003-.403 1.02.004 2.047.137 3.006.403 2.293-1.552 3.298-1.23 3.298-1.23.655 1.654.243 2.874.12 3.176.768.841 1.235 1.913 1.235 3.223 0 4.61-2.804 5.624-5.475 5.92.43.373.824 1.103.824 2.222 0 1.606-.014 2.897-.014 3.293 0 .322.218.694.825.576C20.565 22.092 24 17.591 24 12.297 24 5.67 18.627.297 12 .297z" fill="currentColor"/>
                            </svg>
                            <span class="ml-2 text-lg font-semibold">GitHub</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
