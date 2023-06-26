<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h1 class="title text-primary text-5xl font-medium mb-5 text-center">
        G<span class="text-gray-200">station</span>
    </h1>
    <form action="{{ route('login') }}" method="POST" class="font-['Oxygen_Mono']">
        @csrf

        {{-- <x-text-input  class="block mt-1 w-full" autocomplete="username" /> --}}
        <div class="mb-3">
            <div class="p-0 h-9 flex bg-cgray">
                <img class="my-1 ml-1" src="{{ asset('assets/icons/user.svg') }}" alt="">
                <input id="username" type="text" name="username" value="{{ old('username') }}" placeholder="Username" required class="border-none bg-transparent m-0 w-full h-full focus:border-none focus:outline-none focus:ring-0 placeholder-slate-500 text-sm">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-3">
            <div class="p-0 h-9 flex bg-cgray">
                <img class="my-1 ml-1" src="{{ asset('assets/icons/password.svg') }}" alt="">
                <input id="password" type="password" name="password" value="{{ old('password') }}" placeholder="Password" required class="border-none bg-transparent m-0 w-full h-full focus:border-none focus:outline-none focus:ring-0 placeholder-slate-500 text-sm">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="grid grid-cols-2 mt-5 gap-3">
            <button type="submit" class="bg-primary w-full py-2 font-medium text-white">Login</button>
            <a href="{{ route('register') }}" class="bg-cgray w-full text-center align-middle py-2">Register</a>
        </div>
    </form>

    <div class="my-5 text-center">
        <a href="{{ route('password.request') }}" class="text-stone-400 text-md">Lupa password</a>
    </div>
</x-guest-layout>
