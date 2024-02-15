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
  <link href="{{ '\css\profile\soft-ui-dashboard-tailwind.css?v=1.0.5' }}" rel="stylesheet" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="w-4/5 md:w-3/5 mx-auto font-sans antialiased font-normal text-base leading-default text-slate-500">

  @if ($errors->any())
    <div class="fixed right-1 top-1 rounded-lg bg-red-500 p-4 z-30 text-center">
      {!! implode('', $errors->all('<div class="text-bold text-white">:message</div>')) !!}
    </div>
  @endif

  @if (session('success'))
    <div class="fixed text-bold text-white right-1 top-1 rounded-lg bg-green-500 p-4 z-30 text-center">
      {{ session('success') }}
    </div>
  @elseif(session('error'))
    <div class="fixed text-bold text-white right-1 top-1 rounded-lg bg-red-500 p-4 z-30 text-center">
      {{ session('error') }}
    </div>
  @endif

  <div class="ease-soft-in-out relative h-full p-2 bg-gray-100 transition-all duration-200">
    <nav
      class="absolute z-20 flex flex-wrap items-center mt-5 justify-between w-full px-6 py-2 text-white transition-all shadow-none duration-250 ease-soft-in lg:flex-nowrap lg:justify-start"
      navbar-profile navbar-scroll="true">
      <div class="flex items-center justify-between w-full px-6 py-1 mx-auto flex-wrap-inherit">
        <nav>
          <!-- breadcrumb -->
          <ol class="flex flex-wrap pt-1 pl-2 pr-4 mr-12 bg-transparent rounded-lg sm:mr-16">
            <li class="leading-normal text-sm">
              <a class="opacity-50" href="{{ route('main.home') }}">Home</a>
            </li>
            <li class="text-sm pl-2 capitalize leading-normal before:float-left before:pr-2 before:content-['/']"
              aria-current="page">Profile</li>
          </ol>
          <h6 class="mb-2 ml-2 font-bold text-white capitalize">My Profile</h6>
        </nav>
        </ul>
      </div>
    </nav>

    <form action="{{ route('main.profile.update', auth()->user()->username) }}" method="POST"
      enctype="multipart/form-data">
      @csrf

      <div class="w-full px-6 mx-auto">
        <div class="relative flex items-center p-0 mt-6 overflow-hidden bg-center bg-cover min-h-75 rounded-2xl"
          style="background-image: url('/assets/profile/curved-images/curved14.jpg'); background-position-y: 50%">
          <span
            class="absolute inset-y-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-sky-700 to-sky-500 opacity-60">
          </span>
        </div>
        <div
          class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 -mt-16 overflow-hidden break-words border-0 shadow-blur rounded-2xl bg-white/80 bg-clip-border backdrop-blur-2xl backdrop-saturate-200">
          <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-auto max-w-full px-3">
              <div
                class="text-base ease-soft-in-out h-18.5 w-18.5 relative inline-flex items-center justify-center rounded-full overflow-hidden shadow-lg text-white transition-all duration-200">
                <img
                  src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : '/assets/guest.jpeg' }}"
                  alt="profile_image" class="w-full shadow-soft-sm rounded-xl" />
              </div>
            </div>
            <div class="flex-none w-auto max-w-full px-3 my-auto">
              <div class="h-full">
                <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                <p class="mb-0 font-semibold leading-normal text-sm">{{ auth()->user()->role }}</p>
                <div class="flex items-center justify-end flex-wrap pt-1 pr-10 mr-12">
                  <label class="block">
                    <span class="sr-only">Choose profile photo</span>
                    <input type="file" name="image" class="block w-full text-sm text-slate-500" />
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="w-full p-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
          <div class="w-full max-w-full px-3 xl:w-4/12">
          </div>
          <div class="w-full max-w-full px-3 lg-max:mt-6">
            <div
              class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border py-4">
              <div class="flex-auto p-4">
                <div class="flex flex-col md:flex-row">
                  {{-- username --}}
                  <div class="flex flex-col w-full md:mr-1">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                      </svg>

                      <input class="pl-2 focus:ring-0 focus:ring-offset-0 outline-none border-none w-full"
                        type="text" name="username" placeholder="Username"
                        value="{{ old('username', auth()->user()->username) }}" />
                    </div>
                  </div>
                  {{-- end username --}}

                  {{-- full name --}}
                  <div class="flex flex-col w-full">
                    <label for="fullname" class="block text-sm font-medium text-gray-700">Full
                      name</label>
                    <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                          clip-rule="evenodd" />
                      </svg>

                      <input class="focus:ring-0 focus:ring-offset-0 pl-2 outline-none border-none w-full"
                        type="text" name="name" placeholder="Full name"
                        value="{{ old('name', auth()->user()->name) }}" />
                    </div>
                  </div>
                  {{-- end full name --}}
                </div>

                <div class="flex flex-col md:flex-row mt-1">
                  {{-- email input --}}
                  <div class="flex flex-col w-full md:mr-1">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                      </svg>

                      <input class="focus:ring-0 focus:ring-offset-0 pl-2 outline-none border-none w-full"
                        type="text" name="email" placeholder="Email" id="email"
                        value="{{ old('email', auth()->user()->email) }}" />
                    </div>
                  </div>

                  {{-- end email --}}

                  {{-- phone input --}}
                  <div class="flex flex-col w-full">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                      </svg>

                      <input class="focus:ring-0 focus:ring-offset-0 pl-2 outline-none border-none w-full"
                        type="tel" name="phone" placeholder="Phone" id="phone"
                        value="{{ old('phone', auth()->user()->phone) }}" />
                    </div>
                  </div>
                </div>
                {{-- end phone --}}

                <div class="flex md:flex-row flex-col mb-4">
                  {{-- address input --}}
                  <div class="flex flex-col w-full md:mr-1">
                    <label for="address">Address</label>
                    <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                      <textarea id="address" name="address"
                        class="border-none focus:ring-0 focus:ring-offset-0 outline-none p-2 form-control w-full @error('address') is-invalid @enderror"
                        rows="3">{{ old('address', auth()->user()->address) }}</textarea>
                    </div>
                  </div>
                </div>
                {{-- enddress --}}
                <div class="flex md:flex-row flex-col w-full gap-4 md:gap-0">
                  {{-- password input --}}
                  <div class="flex flex-col w-full md:mr-1">
                    <label for="password">Current Password</label>
                    <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                          d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                          clip-rule="evenodd" />
                      </svg>

                      <input class="focus:ring-0 focus:ring-offset-0 pl-2 outline-none border-none w-full"
                        type="password" name="password" placeholder="Password" />
                    </div>
                  </div>
                  {{-- end password input --}}

                  <div class="flex flex-col w-full md:mr-1">
                    <label for="password">Password</label>
                    <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                          d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                          clip-rule="evenodd" />
                      </svg>

                      <input class="focus:ring-0 focus:ring-offset-0 pl-2 outline-none border-none w-full"
                        type="password" name="new_password" placeholder="New Password" />
                    </div>
                  </div>

                  {{-- neew password confirmation input --}}
                  <div class="flex flex-col w-full md:ml-1">
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                          d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                          clip-rule="evenodd" />
                      </svg>

                      <input class="focus:ring-0 focus:ring-offset-0 pl-2 outline-none border-none w-full"
                        type="password" name="password_confirmation" placeholder="Confirm Password" />
                    </div>
                  </div>
                  {{-- password confirmation --}}

                </div>
                <div class="flex mt-6">
                  <button type="submit"
                    class="bg-movieapp-500 text-gray-50 font-inter py-2 px-4 rounded-lg shadow-md mr-2">
                    Save
                  </button>
                  <button type="reset"
                    class="bg-transparent bg-gray-400 text-gray-50 font-inter py-2 px-4 rounded-lg shadow-lg">
                    Reset
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

</body>
<!-- plugin for scrollbar  -->
<script src="{{ '\js\profile\plugins\perfect-scrollbar.min.js' }}" async></script>
<!-- main script file  -->
<script src="{{ '\js\profile\soft-ui-dashboard-tailwind.js?v=1.0.5' }}"></script>

</html>
