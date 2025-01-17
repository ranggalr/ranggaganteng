@extends('layouts.app')

@section('content')
<div class="flex flex-wrap md items-center h-screen">
    <div class="bg-white w-full md:w-1/2 h-screen">
        <div class="mx-32">
            <h1 class="text-6xl font-bold mt-16">Tokyo</h1>

            <!-- country region island -->
            <div class="flex mt-16 font-light text-gray-500">
                @guest
                    <div class="pr-4">
                        <a class="text-2xl text-gray-900 font-semibold pt-2" href="{{ route('login') }}">Login</a>
                    </div>
                    <div class="pr-4">
                        <a class="text-2xl text-gray-900 font-semibold pt-2" href="{{ route('register') }}">Register</a>
                    </div>
                @endguest
                @auth
                    <div class="pr-4">
                        <a class="text-2xl text-gray-900 font-semibold pt-2" href="{{ route('dashboard') }}">Dashboard</a>
                    </div>
                @endauth
            </div>

            <!-- description -->
            <div class="description w-full sm: md:w-2/3 mt-16 text-gray-500 text-sm">
                Tokyo, Japan’s busy capital, mixes the ultramodern and the
                traditional, from neon-lit skyscrapers to historic temples. The
                opulent Meiji Shinto Shrine is known for its towering gate and
                surrounding woods. The Imperial Palace sits amid large public
                gardens
            </div>

            <button class="uppercase mt-5 text-sm font-semibold hover:underline">
                read more
            </button>
        </div>
    </div>
    <div class="bg-red-600 w-full md:w-1/2 h-screen">
        <img src="https://source.unsplash.com/7H77FWkK_x4/1600x900" class="h-screen w-full" alt="" />
    </div>
</div>
@endsection
