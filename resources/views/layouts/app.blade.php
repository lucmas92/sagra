<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <!-- Styles -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    @yield('page-css')

    @livewireStyles

</head>
<body>
<div id="app" class="bg-gray-100 font-sans leading-normal tracking-normal">
    <!-- This example requires Tailwind CSS v2.0+ -->

    @auth
    @endauth
    <div class="flex md:flex-row-reverse flex-wrap">

        <!--Main Content-->
        <div class="w-full lg:w-5/6 bg-gray-100">

            <nav class="bg-gray-800">
                <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                    <div class="relative flex items-center justify-between h-16">
                        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                            <div class="flex-shrink-0 flex items-center">
                                <img class="block lg:hidden h-8 w-auto"
                                     src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow">
                                <img class="hidden lg:block h-8 w-auto"
                                     src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg"
                                     alt="Workflow">
                            </div>
                            <div class="hidden sm:block sm:ml-6">
                                <div class="flex space-x-4">
                                    @auth
                                        <a class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                                           href="{{ route('home') }}">
                                            {{ config('app.name', 'Laravel') }}
                                        </a>
                                    @else
                                        <a class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                                           href="{{ url('/') }}">
                                            {{ config('app.name', 'Laravel') }}
                                        </a>
                                    @endauth
                                    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4"
                                       href="{{route('new_receipts')}}">NUOVA RICEVUTA</a>
                                </div>
                            </div>
                        </div>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

                            <!-- Profile dropdown -->
                            <div x-data={show:false} class="ml-3 relative">
                                <div>
                                    <button type="button" x-on:click.prevent="show=!show"
                                            class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                                            id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="h-8 w-8 rounded-full"
                                             src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                             alt="">
                                    </button>
                                </div>
                                <div x-show="show"
                                     class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                     role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                     tabindex="-1">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                       role="menuitem" tabindex="-1" id="user-menu-item-2">
                                        Sign out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="container bg-gray-100 pt-6 px-6" style="height:100%; min-height: calc(-4rem + 100vh)">
                @yield('content')
            </div>
        </div>
        @auth
            <div class="w-full lg:w-1/6 bg-gray-900 lg:bg-gray-900 px-2 text-center fixed bottom-0 lg:pt-8 lg:top-0 lg:left-0 h-16 lg:h-screen lg:border-r-4 lg:border-gray-600">
                <div class="lg:relative mx-auto lg:float-right lg:px-6">
                    <ul class="list-reset flex flex-row lg:flex-col text-center lg:text-left">
                        <li class="mr-3 flex-1">
                            <a href="{{route('home')}}"
                               class="block py-1 lg:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-pink-600">
                                <i class="fas fa-link pr-0 lg:pr-3 text-pink-500"></i><span
                                        class="pb-1 lg:pb-0 text-xs lg:text-base text-white lg:font-bold block lg:inline-block">Dashboard</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{route('receipts')}}"
                               class="block py-1 lg:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-pink-500 border-b-2 border-gray-800 lg:border-gray-900 hover:border-pink-500">
                                <i class="fas fa-link pr-0 lg:pr-3"></i><span
                                        class="pb-1 lg:pb-0 text-xs lg:text-base text-gray-600 lg:text-gray-400 block lg:inline-block">Ricevute</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{route('menu')}}"
                               class="block py-1 lg:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-pink-500 border-b-2 border-gray-800 lg:border-gray-900 hover:border-pink-500">
                                <i class="fas fa-link pr-0 lg:pr-3"></i><span
                                        class="pb-1 lg:pb-0 text-xs lg:text-base text-gray-600 lg:text-gray-400 block lg:inline-block">Menu</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{route('products')}}"
                               class="block py-1 lg:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-pink-500 border-b-2 border-gray-800 lg:border-gray-900 hover:border-pink-500">
                                <i class="fas fa-link pr-0 lg:pr-3"></i><span
                                        class="pb-1 lg:pb-0 text-xs lg:text-base text-gray-600 lg:text-gray-400 block lg:inline-block">Prodotti</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{route('meals')}}"
                               class="block py-1 lg:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-pink-500 border-b-2 border-gray-800 lg:border-gray-900 hover:border-pink-500">
                                <i class="fas fa-link pr-0 lg:pr-3"></i><span
                                        class="pb-1 lg:pb-0 text-xs lg:text-base text-gray-600 lg:text-gray-400 block lg:inline-block">Pasti</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{route('departments')}}"
                               class="block py-1 lg:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-pink-500 border-b-2 border-gray-800 lg:border-gray-900 hover:border-pink-500">
                                <i class="fas fa-link pr-0 lg:pr-3"></i><span
                                        class="pb-1 lg:pb-0 text-xs lg:text-base text-gray-600 lg:text-gray-400 block lg:inline-block">Reparti</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{route('discounts')}}"
                               class="block py-1 lg:py-3 pl-1 align-middle text-gray-800 no-underline hover:text-pink-500 border-b-2 border-gray-800 lg:border-gray-900 hover:border-pink-500">
                                <i class="fas fa-link pr-0 lg:pr-3"></i><span
                                        class="pb-1 lg:pb-0 text-xs lg:text-base text-gray-600 lg:text-gray-400 block lg:inline-block">Sconti</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

    </div>
    @endauth
    </main>
</div>
@livewireScripts
@yield('page-script')


</body>
</html>
