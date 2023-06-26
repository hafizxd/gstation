<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h1 class="title text-primary text-5xl font-medium mb-5 text-center">
        G<span class="text-gray-200">station</span>
    </h1>
    <form action="{{ route('password.email') }}" method="POST" class="font-['Oxygen_Mono']">
        @csrf

        <div class="mb-3">
            <div class="p-0 h-9 flex bg-cgray">
                <img class="my-1 ml-1" src="{{ asset('assets/icons/email.svg') }}" alt="">
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Email" required class="border-none bg-transparent m-0 w-full h-full focus:border-none focus:outline-none focus:ring-0 placeholder-slate-500 text-sm">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-5">
            <button type="submit" class="bg-primary w-full py-2 font-medium text-white">Kirim Email</button>
        </div>
    </form>
</x-guest-layout>
