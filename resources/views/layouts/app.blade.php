<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <x-jet-banner />
    <div class="min-h-screen bg-gray-100 md:flex ">
        <div class="md:flex flex-col md:flex-row w-full relative ">
            <div class="fixed z-10">
                @livewire('sidebar')
            </div>
            <div class=" w-full md:ml-auto  ">

                <div class=" bg-green-300 h-64   ">
                    <div class="hidden md:flex">

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <x-jet-banner />
    <div class="min-h-screen bg-gray-100 md:flex ">
        <div class="md:flex flex-col md:flex-row w-full ">
            <div class="fixed">
                @livewire('sidebar')
            </div>
            <div class=" md:w-3/4 md:ml-auto">
                <div class="hidden md:flex justify-between mx-5 mt-4  ">
                    <header>
                        {{ $header }}
                    </header>
                    @livewire('profile-button')
                </div>
                <main class="container w-full md:pt-0 sm:pt-20">
                    {!!$slot!!}
                </main>
            </div>
                        <div class="flex justify-between px-5 pt-4 z-10 w-full ">
                            <header class="z-10 ml-72">
                                {{ $header }}
                            </header>
                            @livewire('profile-button')
                        </div>
                    </div>
                </div>
                    <main class="container w-full md:pt-0   sm:pt-20">
<div class="mx-auto ">
    {!!$slot!!}
</div>
                    </main>
                </div>
        </div>

    </div>
    @stack('modals')

    @livewireScripts
</body>

</html>
