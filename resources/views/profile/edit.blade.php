<x-app-layout>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-5">
            <div class="p-0 h-12 flex bg-cgray">
                <input id="username" type="text" name="username" value="{{ auth()->user()->username }}" placeholder="Masukkan Username Baru" required class="border-none bg-transparent m-0 w-full h-full focus:border-none focus:outline-none focus:ring-0 placeholder-slate-600">
            </div>
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        {{-- Button --}}
        <div class="flex justify-end">
            <button type="submit" class="bg-primary py-2 px-8 font-medium text-white mb-2">Update</button>
        </div>
    </form>
</x-app-layout>
