<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>@yield('title', 'ReadEasy')</title>
</head>

<body class="bg-white dark:bg-gray-900 text-white">
    <header>
        <x-nav />
    </header>
    {{ $slot }}
</body>

</html>
