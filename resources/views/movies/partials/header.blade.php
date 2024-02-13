<nav class="bg-white sticky top-0 drop-shadow-lg z-20">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!--
            Icon when menu is closed.

            Menu open: "hidden", Menu closed: "block"
          -->
                    <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!--
            Icon when menu is open.

            Menu open: "block", Menu closed: "hidden"
          -->
                    <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex flex-shrink-0 font-inter text-lg font-bold uppercase items-center">
                    Sea Cinema |
                </div>
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-movieapp-600 hover:text-white" -->
                        <a href="{{ route('main.home') }}"
                            class="{{ Request::is('/') ? 'bg-movieapp-500 text-white' : 'text-gray-700 hover:bg-movieapp-600 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium"
                            aria-current="page">Top Movies</a>
                        <a href="{{ route('main.movies') }}"
                            class="{{ Request::is('movies') ? 'bg-movieapp-500 text-white' : 'text-gray-700 hover:bg-movieapp-600 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">All
                            Movies</a>
                        <a href="{{ route('main.upcoming') }}"
                            class="{{ Request::is('upcoming') ? 'bg-movieapp-500 text-white' : 'text-gray-700 hover:bg-movieapp-600 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Upcoming</a>
                        <a href="{{ route('main.nowplaying') }}"
                            class="{{ Request::is('nowplaying') ? 'bg-movieapp-500 text-white' : 'text-gray-700 hover:bg-movieapp-600 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Now Playing</a>
                            
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

                @auth
                    <button type="button"
                        class="relative rounded-full bg-gray-300 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                        <span class="absolute -inset-1.5"></span>
                        <span class="sr-only">View notifications</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                    </button>

                    <!-- Profile dropdown -->
                    <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName"
                        class="flex items-center ml-3 text-sm pe-1 font-medium text-gray-900 rounded-full hover:text-blue-600 md:me-0 focus:ring-4 focus:ring-gray-100"
                        type="button">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 me-2 rounded-full"
                            src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : '/assets/guest.jpeg' }}"
                            alt="user photo">
                        {{ auth()->user()->username }}
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdownAvatarName"
                        class="z-20 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                        <div class="px-4 py-3 text-sm text-gray-900">
                            <div class="font-medium ">{{ auth()->user()->name }}</div>
                            <div class="truncate">{{ auth()->user()->email }}</div>
                        </div>

                        <ul class="py-2 text-sm text-gray-700"
                            aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">
                            @can('admin')
                                <li>
                                    <a href="{{ route('dashboard.index') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-movieapp-600 hover:text-white">Dashboard</a>
                                </li>
                            @endcan
                            <li>
                                <a href="{{ 'profile' }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-movieapp-600 hover:text-white">Profile</a>
                            </li>
                        </ul>

                        <div class="py-2">
                            <a href="{{ route('auth.logout') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-500">
                                Sign out</a>
                        </div>
                    </div>
                @else
                    <a href="{{ route('auth.login') }}"
                        class="uppercase bg-sky-500 rounded-md text-white group-hover:drop-shadow-lg px-5 py-2 duration-200 font-inter">Login</a>
                @endauth

            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="#" class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium"
                aria-current="page">Top Movies</a>
            <a href="#"
                class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">All
                Movies</a>
            <a href="{{ route('main.nowplaying') }}"
                class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Now Playing</a>
        </div>
    </div>
</nav>
