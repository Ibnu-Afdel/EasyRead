<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'ReadEasy')</title>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{  route('books.index') }}">Books</a>
    </nav>
    <h1>@yield('heading')</h1>
    <hr>
    {{ $slot }}
</body>
</html>