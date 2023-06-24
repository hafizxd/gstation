<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h1 class="title text-primary text-5xl font-medium mb-5 text-center">
        G<span class="text-gray-200">station</span>
    </h1>
    <form action="{{ route('register') }}" method="POST" class="font-['Oxygen_Mono']">
        @csrf

        <div class="mb-3">
            <div class="p-0 h-9 flex bg-cgray">
                <img class="my-1 ml-1" src="{{ asset('assets/icons/email.svg') }}" alt="">
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required class="border-none bg-transparent m-0 w-full h-full focus:border-none focus:outline-none focus:ring-0 placeholder-slate-500 text-sm">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

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

        <div class="flex flex-col gap-3 mt-5 items-center">
            <button type="submit" class="bg-primary py-2 px-8 font-medium text-white mb-2">Register</button>
            <p class="text-stone-500">Sudah punya akun?</p>
            <div>
                <a class="w-full h-full bg-cgray py-2 px-8" href="{{ route('login') }}">
                    Login
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
