<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/my.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="../../node_modules/flowbite/dist/flowbite.min.js"></script>

</head>
<body class="font-nunito antialiased">
<div
    class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/home') }}"
                   class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto lg:px-8 flex justify-center">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="max-width: 1000px;">

                <div
                    class="pt-4 max-w-7xl mx-auto sm:flex-1 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg animate-fade-in">
                    <br><br>
                    <img class="mx-auto mb-8"
                         src="https://leverageedublog.s3.ap-south-1.amazonaws.com/blog/wp-content/uploads/2019/10/23165643/Bank-Manager.jpg"
                         alt="MyBank Logo" width="400">
                    <div class="pt-4">
                        <h1 class="text-4xl font-bold mb-4 font-semibold">Welcome to MyBank Internet Banking</h1>
                        <p class="text-lg">Stay connected with your finances anytime, anywhere.</p>
                    </div>

                    <div class="pt-4">
                        <h2 class="text-2xl font-bold mb-4">Latest News</h2>
                        <p class="text-base">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>

                    <div class="mt-8">
                        <p class="text-sm text-gray-600">Disclaimer: This is a fictitious internet banking application.
                            All news and information displayed on this page are for demonstration purposes only and
                            should not be taken seriously. <span class="italic">Stay safe and enjoy exploring!</span>
                        </p>
                    </div>
                    <br>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>
