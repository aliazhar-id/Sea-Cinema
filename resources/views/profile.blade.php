<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sea Cinema | Profile</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Main Styling -->
    <link href="{{ 'page_profile\css\soft-ui-dashboard-tailwind.css?v=1.0.5' }}" rel="stylesheet" />
</head>

<body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">
    <div class="ease-soft-in-out relative h-full max-h-screen bg-gray-50 transition-all duration-200">
        <nav class="absolute z-20 flex flex-wrap items-center justify-between w-full px-6 py-2 text-white transition-all shadow-none duration-250 ease-soft-in lg:flex-nowrap lg:justify-start"
            navbar-profile navbar-scroll="true">
            <div class="flex items-center justify-between w-full px-6 py-1 mx-auto flex-wrap-inherit">
                <nav>
                    <!-- breadcrumb -->
                    <ol class="flex flex-wrap pt-1 pl-2 pr-4 mr-12 bg-transparent rounded-lg sm:mr-16">
                        <li class="leading-normal text-sm">
                            <a class="opacity-50" href="{{ '/' }}">Home</a>
                        </li>
                        <li class="text-sm pl-2 capitalize leading-normal before:float-left before:pr-2 before:content-['/']"
                            aria-current="page">Profile</li>
                    </ol>
                    <h6 class="mb-2 ml-2 font-bold text-white capitalize">My Profile</h6>
                </nav>

                <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                    <div class="flex items-center md:ml-auto md:pr-4">

                    </div>
                    <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                        <li class="flex items-center pl-4 xl:hidden">
                            <a href="javascript:;" class="block p-0 text-white transition-all ease-soft-in-out text-sm"
                                sidenav-trigger>
                                <div class="w-4.5 overflow-hidden">
                                    <i
                                        class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                    <i
                                        class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                    <i class="ease-soft relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                </div>
                            </a>
                        </li>
                        <li class="flex items-center px-4">
                            <a href="#" class="p-0 text-white transition-all text-sm ease-soft-in-out">
                                <i fixed-plugin-button-nav class="cursor-pointer fa fa-cog" aria-hidden="true"></i>
                                <!-- fixed-plugin-button-nav  -->
                            </a>
                        </li>

                        <!-- notifications -->

                        <li class="relative flex items-center pr-2">
                            <p class="hidden transform-dropdown-show"></p>
                            <a dropdown-trigger href="#"
                                class="block p-0 text-white transition-all text-sm ease-nav-brand"
                                aria-expanded="false">
                                <i class="cursor-pointer fa fa-bell" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="w-full px-6 mx-auto">
            <div class="relative flex items-center p-0 mt-6 overflow-hidden bg-center bg-cover min-h-75 rounded-2xl"
                style="background-image: url('page_profile/img/curved-images/curved14.jpg'); background-position-y: 50%">
                <span
                    class="absolute inset-y-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-sky-700 to-sky-500 opacity-60">
                </span>
            </div>
            <div
                class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 -mt-16 overflow-hidden break-words border-0 shadow-blur rounded-2xl bg-white/80 bg-clip-border backdrop-blur-2xl backdrop-saturate-200">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex-none w-auto max-w-full px-3">
                        <div
                            class="text-base ease-soft-in-out h-18.5 w-18.5 relative inline-flex items-center justify-center rounded-xl text-white transition-all duration-200">
                            <img src="{{ 'page_profile/img/bruce-mars.jpg' }}" alt="profile_image"
                                class="w-full shadow-soft-sm rounded-xl" />
                        </div>
                    </div>
                    <div class="flex-none w-auto max-w-full px-3 my-auto">
                        <div class="h-full">
                            <h5 class="mb-1">Dohn Joe</h5>
                            <p class="mb-0 font-semibold leading-normal text-sm">Admin</p>
                        </div>
                    </div>
                    <form class="flex items-center justify-end flex-wrap pt-1 pr-10 mr-12">
                        <label class="block">
                            <span class="sr-only">Choose profile photo</span>
                            <input type="file" class="block w-full text-sm text-slate-500" />
                        </label>
                    </form>
                </div>
            </div>
        </div>
        <div class="w-full p-6 mx-auto">
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 xl:w-4/12">
                </div>
                <div class="w-full max-w-full px-3 lg-max:mt-6">
                    <div
                        class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                            <div class="flex flex-wrap -mx-3">
                                <div class="flex items-center w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                                    <h6 class="mb-0">My Account</h6>
                                </div>
                            </div>
                        </div>

                        <div class="flex-auto p-4">
                            <div class="p-6">
                                <form class="mt-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        {{-- full name --}}
                                        <div class="flex flex-col w-full md:w-1/2 md:mr-2">
                                            <label for="fullname" class="block text-sm font-medium text-gray-700">Full
                                                name</label>
                                            <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                        clip-rule="evenodd" />
                                                </svg>

                                                <input class="pl-2 outline-none border-none w-full" type="text"
                                                    name="name" placeholder="Full name"
                                                    value="{{ old('name', auth()->user()->name) }}" />
                                            </div>
                                        </div>
                                        {{-- end full name --}}

                                        {{-- username --}}
                                        <div class="flex flex-col w-full md:w-1/2 md:mr-1">
                                            <label for="username"
                                                class="block text-sm font-medium text-gray-700">Username</label>
                                            <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                                                </svg>

                                                <input class="pl-2 outline-none border-none w-full" type="text"
                                                    name="username" placeholder="Username" disabled
                                                    value="{{ old('username', auth()->user()->username) }}" />
                                            </div>
                                        </div>
                                        {{-- end username --}}

                                        {{-- email input --}}
                                        <div class="flex flex-col w-full md:w-1/2 md:mr-1">
                                            <label for="email"
                                                class="block text-sm font-medium text-gray-700">Email</label>
                                            <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                                </svg>

                                                <input class="pl-2 outline-none border-none w-full" type="text"
                                                    name="email" placeholder="Email Address"
                                                    value="{{ old('email', auth()->user()->email) }}" />
                                            </div>
                                        </div>
                                        {{-- end email --}}

                                        {{-- date of birth input --}}
                                        <div class="flex flex-col w-full md:w-1/2 md:ml-1">
                                            <label for="dob">Date of Birth</label>
                                            <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                                                <input type="date" name="dob"
                                                    class="pl-2 outline-none border-none w-full py-2 px-3 text-gray-400 leading-tight focus:outline-none focus:shadow-outline"
                                                    placeholder="dob">
                                            </div>
                                        </div>
                                        {{-- end date --}}
                                    </div>

                                    <div class="flex md:flex-row gap-4 md:gap-0 flex-col mb-4">
                                        {{-- address input --}}
                                        <div class="flex flex-col w-full md:w-1/2 md:mr-1">
                                            <label for="address">Address</label>
                                            <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                                                <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror" rows="3">{{ old('address', auth()->user()->address) }}</textarea>
                                            </div>
                                        </div>
                                        {{-- enddress --}}

                                        {{-- phone input --}}
                                        <div class="flex flex-col w-full md:w-1/2 md:ml-1">
                                            <label for="phone">Phone</label>
                                            <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>

                                                <input class="pl-2 outline-none border-none w-full" type="tel"
                                                    name="phone" placeholder="Phone"
                                                    value="{{ old('phone', auth()->user()->phone) }}" />
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end phone --}}

                                    <div class="flex md:flex-row flex-col w-full gap-4 md:gap-0">
                                        {{-- password input --}}
                                        <div class="flex flex-col w-full md:w-1/2 md:mr-1">
                                            <label for="password">Password</label>
                                            <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                        clip-rule="evenodd" />
                                                </svg>

                                                <input class="pl-2 outline-none border-none w-full" type="password"
                                                    name="password" placeholder="Password" />
                                            </div>
                                        </div>
                                        {{-- end password input --}}

                                        {{-- password confirmation input --}}
                                        <div class="flex flex-col w-full md:w-1/2 md:ml-1">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                        clip-rule="evenodd" />
                                                </svg>

                                                <input class="pl-2 outline-none border-none w-full" type="password"
                                                    name="password_confirmation" placeholder="Confirm Password" />
                                            </div>
                                        </div>
                                        {{-- password confirmation --}}

                                    </div>
                            </div>
                        </div>
                    </div>

</body>
<!-- plugin for scrollbar  -->
<script src="{{ 'page_profile\js\plugins\perfect-scrollbar.min.js' }}" async></script>
<!-- main script file  -->
<script src="{{ 'page_profile\js\soft-ui-dashboard-tailwind.js?v=1.0.5' }}"></script>

</html>
