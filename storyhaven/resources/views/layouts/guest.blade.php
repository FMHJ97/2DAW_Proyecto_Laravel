<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    <style>
        body>div {
            background-image: url('/images/fondo.jpg');
            background-size: cover;
            /* Ajusta la imagen al tamaño de la pantalla */
            background-position: center;
            background-repeat: no-repeat;
            /* Asegura que el fondo cubra toda la pantalla */
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-900">
    <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
        <div class="sm:mt-6">
            <a href="/" class="flex items-center justify-center">
                <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
                <h1 class="mt-6 text-3xl font-semibold text-gray-800">StoryHaven</h1>
            </a>
        </div>

        <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:mb-8 sm:max-w-md sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
