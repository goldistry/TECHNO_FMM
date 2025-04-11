<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('assets/logo2425-white.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Find My Major')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #fd7205;
            --blue: #0066ff;
            --blue-dark: #0056c9;
            --green: #7f9c53;
            --beige: #f8f1e5;
            --light-beige: #fffdf9;
            --light-green: #a8c778;
            --light-orange:#ff933c;
        }

        body {
            font-family: 'Jost', sans-serif;
            background-color: var(--beige);
        }
    </style>

    @yield('head')
</head>
<body class="min-h-screen overflow-x-hidden">
    <div class="min-h-screen">
        @yield('content')
    </div>
</body>
</html>