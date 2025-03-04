<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - StoryHaven</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">

    {{-- Tailwind --}}
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    {{-- Flowbite --}}
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        /* Tailwind-inspired utility classes */
        .bg-indigo-50 {
            background-color: #eef2ff;
        }

        .text-indigo-600 {
            color: #4f46e5;
        }

        .text-indigo-900 {
            color: #312e81;
        }

        .text-gray-600 {
            color: #4b5563;
        }

        .text-gray-500 {
            color: #6b7280;
        }

        .font-sans {
            font-family: 'Nunito', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        .font-bold {
            font-weight: 700;
        }

        .font-medium {
            font-weight: 500;
        }

        .font-normal {
            font-weight: 400;
        }

        .text-5xl {
            font-size: 3rem;
            line-height: 1;
        }

        .text-3xl {
            font-size: 1.875rem;
            line-height: 2.25rem;
        }

        .text-xl {
            font-size: 1.25rem;
            line-height: 1.75rem;
        }

        .text-lg {
            font-size: 1.125rem;
            line-height: 1.75rem;
        }

        .text-base {
            font-size: 1rem;
            line-height: 1.5rem;
        }

        .py-12 {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .my-8 {
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .my-6 {
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .mt-6 {
            margin-top: 1.5rem;
        }

        .mb-2 {
            margin-bottom: 0.5rem;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-center {
            justify-content: center;
        }

        .flex-col {
            flex-direction: column;
        }

        .min-h-screen {
            min-height: 100vh;
        }

        .text-center {
            text-align: center;
        }

        .max-w-xl {
            max-width: 36rem;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .p-4 {
            padding: 1rem;
        }

        .p-6 {
            padding: 1.5rem;
        }

        .rounded-full {
            border-radius: 9999px;
        }

        .rounded-lg {
            border-radius: 0.5rem;
        }

        .border {
            border-width: 1px;
        }

        .border-indigo-200 {
            border-color: #c7d2fe;
        }

        .shadow-md {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .transition {
            transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }

        .hover\:bg-indigo-600:hover {
            background-color: #4f46e5;
        }

        .hover\:text-white:hover {
            color: #ffffff;
        }

        .bg-indigo-500 {
            background-color: #6366f1;
        }

        .text-white {
            color: #ffffff;
        }

        .no-underline {
            text-decoration: none;
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .rounded {
            border-radius: 0.25rem;
        }

        .inline-block {
            display: inline-block;
        }

        .opacity-75 {
            opacity: 0.75;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen font-sans text-gray-600 bg-indigo-50">
    <div class="max-w-xl p-6 mx-auto">
        <div class="text-center">
            <!-- Icono de error -->
            <div class="inline-flex items-center justify-center p-4 mx-auto mb-6 bg-indigo-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-indigo-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>

            <!-- Código de error -->
            <h1 class="text-5xl font-bold text-indigo-900">@yield('code', '¡Ups!')</h1>

            <!-- Mensaje de error -->
            <div class="my-6">
                <p class="text-xl font-medium text-indigo-900">@yield('title', 'Algo salió mal')</p>
                <p class="mt-6 text-base">@yield('message', 'La página que estás buscando no está disponible.')</p>
            </div>

            <!-- Imagen decorativa relacionada con historias -->
            <div class="my-8 opacity-75">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-32 h-32 mx-auto text-indigo-500" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>

            <!-- Botón para volver al inicio -->
            <div class="mt-6">
                <a href="{{ url('/') }}"
                    class="inline-block px-4 py-2 font-medium text-white no-underline transition bg-indigo-500 rounded hover:bg-indigo-600">
                    Volver al inicio
                </a>
            </div>
        </div>
    </div>
</body>

</html>
