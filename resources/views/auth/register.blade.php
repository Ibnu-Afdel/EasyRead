<x-layout>
    @section('title', 'Register')
    @section('heading')
    Register
    @endsection

    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="{{ route('home') }}" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                EasyRead    
            </a>
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Create an account
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('register.store') }}" >
                        @csrf
                        <x-auth-form for="name" name="name" >Your Name</x-auth-form>
                        <x-auth-form for="email" name="email" type="email" >Your Email</x-auth-form>
                        <x-auth-form for="password" name="password" type="password" >Your Password</x-auth-form>
                        <x-auth-form for="password_confirmation" name="password_confirmation" type="password">Confirm you  password</x-auth-form>
                        <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create an account</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Already have an account? <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
      </section>
    
</x-layout>
