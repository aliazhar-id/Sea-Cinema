@extends('movies.layouts.main')

@section('body')
    <div class="h-screen md:flex">
        {{-- Left Section --}}
        <div
            class="relative overflow-hidden md:flex w-1/2 bg-gradient-to-tr from-sky-800 bg-sky to-teal-700 i justify-around items-center hidden">
            <div>
                <img src="{{ url('assets/pngwing.png') }}" width="500">
            </div>
            <div class="absolute -bottom-32 -right-40 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -bottom-40 -right-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -top-40 -left-0 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -top-20 -left-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
        </div>

        {{-- Right Section --}}
        <div class="flex md:w-1/2 justify-center py-10 mx-5 items-center bg-white">
            <form class="bg-white w-full md:max-w-screen-sm" action="{{ route('auth.actionRegister') }}" method="POST">
                @csrf

                <div class="absolute top-5 right-1">
                    <div class="flex justify-end">
                        <a href="{{ '/' }}" type="button"
                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md mr-4">X</a>
                    </div>
                </div>

                <h1 class="text-gray-800 font-bold text-2xl mb-1 text-center">Hello! let's get started</h1>
                <p class="text-sm font-normal text-gray-600 mb-7 text-center">Sign Up to continue.</p>

                <div class="flex md:flex-row gap-4 md:gap-0 flex-col mb-4">
                    {{-- fullname input --}}
                    <div class="flex flex-col w-full md:w-1/2 md:mr-2">
                        <div
                            class="flex items-center border-2 py-2 px-3 rounded-2xl @error('name') border-red-500 @enderror">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
                            </svg>

                            <input class="pl-2 outline-none border-none w-full" type="text" name="name"
                                placeholder="Full name" />
                        </div>

                        @error('name')
                            <span class="text-sm text-red-600"> {{ $message }} </span>
                        @enderror
                    </div>

                    {{-- username input --}}
                    <div class="flex flex-col w-full md:w-1/2 md:mr-1">
                        <div
                            class="flex items-center border-2 py-2 px-3 rounded-2xl @error('username') border-red-500 @enderror">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                            </svg>

                            <input class="pl-2 outline-none border-none w-full" type="text" name="username"
                                placeholder="Username" />
                        </div>

                        @error('username')
                            <span class="text-sm text-red-600"> {{ $message }} </span>
                        @enderror
                    </div>

                </div>

                <div class="flex md:flex-row gap-4 md:gap-0 flex-col mb-4">
                    {{-- email input --}}
                    <div class="flex flex-col w-full md:w-1/2 md:mr-1">
                        <div
                            class="flex items-center border-2 py-2 px-3 rounded-2xl @error('email') border-red-500 @enderror">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>

                            <input class="pl-2 outline-none border-none w-full" type="text" name="email"
                                placeholder="Email Address" />
                        </div>

                        @error('email')
                            <span class="text-sm text-red-600"> {{ $message }} </span>
                        @enderror
                    </div>

                    {{-- date of birth input --}}
                    <div class="flex flex-col w-full md:w-1/2 md:ml-1">
                        <div
                            class="flex items-center border-2 py-2 px-3 rounded-2xl @error('dob') border-red-500 @enderror">
                            <input type="date" name="dob"
                                class="pl-2 outline-none border-none w-full py-2 px-3 text-gray-400 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="dob">
                        </div>

                        @error('dob')
                            <span class="text-sm text-red-600"> {{ $message }} </span>
                        @enderror
                    </div>

                </div>

                <div class="flex md:flex-row gap-4 md:gap-0 flex-col mb-4">
                    {{-- address input --}}
                    <div class="flex flex-col w-full md:w-1/2 md:mr-1">
                        <div
                            class="flex items-center border-2 py-2 px-3 rounded-2xl @error('address') border-red-500 @enderror">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>

                            <input class="pl-2 outline-none border-none w-full" type="text" name="address"
                                placeholder="Address" />
                        </div>

                        @error('address')
                            <span class="text-sm text-red-600"> {{ $message }} </span>
                        @enderror
                    </div>

                    {{-- phone input --}}
                    <div class="flex flex-col w-full md:w-1/2 md:ml-1">
                        <div
                            class="flex items-center border-2 py-2 px-3 rounded-2xl @error('phone') border-red-500 @enderror">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>

                            <input class="pl-2 outline-none border-none w-full" type="tel" name="phone"
                                placeholder="Phone" />
                        </div>

                        @error('phone')
                            <span class="text-sm text-red-600"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>

                <div class="flex md:flex-row flex-col w-full gap-4 md:gap-0">
                    {{-- password input --}}
                    <div class="flex flex-col w-full md:w-1/2 md:mr-1">
                        <div
                            class="flex items-center border-2 py-2 px-3 rounded-2xl  @error('password') border-red-500 @enderror">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd" />
                            </svg>

                            <input class="pl-2 outline-none border-none w-full" type="password" name="password"
                                placeholder="Password" />
                        </div>

                        @error('password')
                            <span class="text-sm text-red-600"> {{ $message }} </span>
                        @enderror
                    </div>

                    {{-- password confirmation input --}}
                    <div class="flex flex-col w-full md:w-1/2 md:ml-1">
                        <div
                            class="flex items-center border-2 py-2 px-3 rounded-2xl @error('password_confirmation') border-red-500 @enderror">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd" />
                            </svg>

                            <input class="pl-2 outline-none border-none w-full" type="password"
                                name="password_confirmation" placeholder="Confirm Password" />
                        </div>

                        @error('password_confirmation')
                            <span class="text-sm text-red-600"> {{ $message }} </span>
                        @enderror
                    </div>

                </div>

                <button type="submit"
                    class="block hover:brightness-75 duration-300 w-full bg-sky-600 mt-4 py-2 rounded-2xl text-white font-semibold mb-2">
                    Register
                </button>
                <div class="flex mt-4 md:justify-between">
                    <a href="" class="text-sm text-gray-700 hover:text-blue-500">Forgot Password? </a>
                    <a href="{{ route('auth.login') }}" class="text-sm text-gray-700 hover:text-blue-500">Already have an
                        account? Join!</a>
                </div>
            </form>
        </div>
    </div>
@endsection
