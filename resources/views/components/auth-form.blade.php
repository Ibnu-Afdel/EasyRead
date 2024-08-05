
<div>
<label for="{{ $for }}" {{ $attributes->merge(['class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white']) }}> {{ $slot }}</label>
<input id="{{ $for }}" name="{{ $name }}"  {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required=""']) }}">
<div class="text-sm text-red-500">
@error($name)
    {{ $message }}
@enderror
</div>
</div>