@props(['active'])
<li>
    <a class="{{ $active ? 'text-white bg-primary-700 lg:bg-transparent lg:text-primary-700 dark:text-white' : 
    'text-gray-700 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent'
    }} block py-2 px-4 rounded-lg lg:p-0 transition-colors duration-200 " 
    {{$attributes}}>{{ $slot }}</a>
</li>