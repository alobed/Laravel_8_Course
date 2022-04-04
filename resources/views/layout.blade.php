<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Blog</title>
    <link rel="stylesheet" href="/app.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>

@auth
    <form method="POST" action="/logout" class="text-xs">
        @csrf
        <button type="submit">Log Out</button>
    </form>
@endauth

@auth
    <span>Welcom Back {{ auth()->user()->usernamse }}</span>
@else
    <a href="/register">Register</a>
    <a href="/login">Login</a>
@endauth

<x-flash/>

@yield('content')
</body>

</html>
