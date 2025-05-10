<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>{{ $title ?? 'ReadEasy' }}</title>
</head>

<body class="bg-white dark:bg-gray-900 text-white">
    <header>
        <x-nav />
    </header>
    {{ $slot }}
</body>

</html>
