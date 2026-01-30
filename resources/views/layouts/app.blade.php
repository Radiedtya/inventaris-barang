<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full font-sans antialiased">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-[#F8FAFC] text-[#1E293B]">
    <div id="app">
        @include('layouts.partials.navbar')

        <div class="flex min-h-screen bg-[#F8FAFC]" x-data="{ sidebarOpen: true }">
            @include('layouts.partials.sidebar')

            <div class="flex-1 flex flex-col">
                @include('layouts.partials.header')

                <main class="p-8">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>

</html>