@extends('movies.layouts.main')

@section('body')
    <div class="h-screen md:flex">

        {{-- Left Section --}}
        <div
            class="relative overflow-hidden md:flex w-1/2 bg-gradient-to-tr from-teal-800 bg-sky to-sky-700 i justify-around items-center hidden">
            <div>
                <img src="{{ url('assets/pngwing.png') }}" width="500">
            </div>
            <div class="absolute -bottom-32 -left-40 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -bottom-40 -left-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -top-40 -right-0 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -top-20 -right-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
        </div>

        {{-- Right Section --}}
        <div class="flex md:w-1/2 justify-center py-10 items-center bg-white">
            <form class="bg-white w-3/5" action="{{ route('auth.actionLogin') }}" method="POST">
                @csrf

                @if (session()->has('error'))
                    <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 mb-2" role="alert">
                        <p class="font-bold">Error</p>
                        <p>{{ session('error') }}</p>
                    </div>
                @elseif(session()->has('success'))
                    <div class="bg-teal-100 border-l-4 border-teal-500 text-teal-900 p-4 mb-2" role="alert">
                        <p class="font-bold">Success</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <div class="absolute top-5 right-1">
                    <div class="flex justify-end">
                        <a href="{{ '/' }}" type="button"
                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md mr-4">X</a>
                    </div>
                </div>


                <h1 class="text-gray-800 font-bold text-2xl mb-1 text-center">Hello! let's get started!</h1>
                <p class="text-sm font-normal text-gray-600 mb-7 text-center">Welcome Back</p>

                <div class="flex flex-col mb-4">
                    <div class="flex items-center border-2 py-2 px-3 rounded-2xl @error('email') border-red-500 @enderror">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                        <input class="pl-2 outline-none border-none w-full" type="email" name="email"
                            value="{{ old('email') }}" placeholder="Email Address" autofocus />
                    </div>

                    @error('email')
                        <span class="text-sm text-red-600"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="flex flex-col mb-4">
                    <div
                        class="flex items-center border-2 py-2 px-3 rounded-2xl @error('password') border-red-500 @enderror">
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

                    <div class="flex items-center mt-4">
                        <div class="relative">
                            <input type="checkbox" id="Check"
                                class="w-4 h-4 border-gray-300 border-2 rounded focus:ring-blue-500">
                            <label for="Check"
                                class="ml-2 text-sm font-inter hover:text-blue-500 text-gray-700 cursor-pointer">Remember</label>
                        </div>
                    </div>

                </div>

                <button type="submit"
                    class="block w-full bg-sky-600 mt-4 py-2 rounded-2xl text-white font-semibold mb-2">Login
                </button>

                <div class="flex mt-4 md:justify-between">
                    <a href="" class="text-sm text-gray-700 hover:text-blue-500">Forgot Password? </a>
                    <a href="{{ route('auth.register') }}" class="text-sm text-gray-700 hover:text-blue-500">Create
                        account!</a>
                </div>

            </form>

        </div>
    </div>
@endsection
