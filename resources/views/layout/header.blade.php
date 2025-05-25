<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/fe4dcc102d.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
</head>
<header x-data="{ open: false }">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <nav class="bg-white border-b border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">

            <!-- Logo -->
            <img src="{{ asset('img/logo.png') }}" class="h-6 sm:h-9" alt="Apotek Rajawali Logo" />

            <!-- Right Section: Login + Get Started + Hamburger -->
            <div class="flex items-center lg:order-2">


                <!-- Hamburger Button (Mobile only) -->
                <button @click="open = !open" type="button"
                    class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <i :class="open ? 'fas fa-xmark text-xl' : 'fas fa-bars text-xl'"></i>
                </button>

            </div>

            <!-- Menu Navigation (Desktop) -->
            <div class="hidden lg:flex lg:items-center lg:space-x-6 font-medium">
                <a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'text-primary-700 font-semibold' : 'text-gray-700 hover:text-primary-700' }}">
                    Home
                </a>
                <a href="{{ route('profiles') }}"
                    class="{{ request()->routeIs('profiles') ? 'text-primary-700 font-semibold' : 'text-gray-700 hover:text-primary-700' }}">
                    Profile
                </a>
                <a href="{{ route('product') }}"
                    class="{{ request()->routeIs('product') ? 'text-primary-700 font-semibold' : 'text-gray-700 hover:text-primary-700' }}">
                    Product
                </a>
                <a href="{{ route('contact') }}"
                    class="{{ request()->routeIs('contact') ? 'text-primary-700 font-semibold' : 'text-gray-700 hover:text-primary-700' }}">
                    Contact
                </a>
            </div>

            <!-- Menu Navigation (Mobile - dropdown) -->
            <div class="w-full lg:hidden mt-4" x-show="open" @click.away="open = false" id="mobile-menu">
                <ul class="flex flex-col font-medium space-y-2">
                    <li>
                        <a href="{{ route('home') }}"
                            class="{{ request()->routeIs('home') ? 'text-white bg-primary-700' : 'text-gray-700 hover:text-primary-700' }} block py-2 px-4 rounded">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profiles') }}"
                            class="{{ request()->routeIs('profiles') ? 'text-white bg-primary-700' : 'text-gray-700 hover:text-primary-700' }} block py-2 px-4 rounded">
                            Profiles
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('product') }}"
                            class="{{ request()->routeIs('product') ? 'text-white bg-primary-700' : 'text-gray-700 hover:text-primary-700' }} block py-2 px-4 rounded">
                            Product
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}"
                            class="{{ request()->routeIs('contact') ? 'text-white bg-primary-700' : 'text-gray-700 hover:text-primary-700' }} block py-2 px-4 rounded">
                            Contact
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
