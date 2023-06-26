<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="mb-3">
            <div class="p-0 h-9 bg-cgray hidden">
                <img class="my-1 ml-1" src="{{ asset('assets/icons/email.svg') }}" alt="">
                <input id="email" type="email" name="email" value="{{ request('email') }}" placeholder="Email" required class="border-none bg-transparent m-0 w-full h-full focus:border-none focus:outline-none focus:ring-0 placeholder-slate-500 text-sm">
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

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="bg-primary w-full py-2 font-medium text-white">Reset Password</button>
        </div>
    </form>
</x-guest-layout>
