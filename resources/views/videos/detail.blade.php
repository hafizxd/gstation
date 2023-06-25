<x-app-layout>
    <div class="text-white mb-24">
        <div class="mb-5">
            <div class="h-96 flex justify-center bg-stone-700">
                <video controls class="h-full">
                    <source src="{{ asset('/storage/uploads/videos/' . $video->video) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <div class="mt-8 flex justify-between items-center">
                <h1 class="text-3xl font-bold">{{ $video->title }}</h1>
                <div class="px-5">
                    <form action="{{ route('favorite.toggle', $video->id) }}" method="POST">
                        @csrf
                        @if (!$video->favoritedBy()->where('users.id', auth()->user()->id)->exists())
                            <input type="submit" value="Tambahkan ke Favorit" class="bg-primary py-2 px-3 text-sm text-white hover:cursor-pointer">
                        @else
                            <input type="submit" value="Hapus dari Favorit" class="bg-red-500 py-2 px-3 text-sm text-white hover:cursor-pointer">
                        @endif
                    </form>
                </div>
            </div>

            <div class="mt-2 flex gap-3">
                <h6 class="text-md font-light text-gray-300">
                    @if ($video->user->role == 1)
                        <span class="text-red-500">GM</span>
                    @endif {{ $video->user->username }}
                </h6>
                @if ($video->user->id != auth()->user()->id)
                    <form action="{{ route('user.toggle-follow', $video->user->id) }}" method="POST">
                        @csrf
                        @if (!auth()->user()->followings()->where('users.id', $video->user->id)->exists())
                            <input type="submit" value="Follow" class="text-yellow-400 hover:underline-offset hover:cursor-pointer">
                        @else
                            <input type="submit" value="Unfollow" class="text-red-500 hover:underline-offset hover:cursor-pointer">
                        @endif
                    </form>
                @endif
            </div>

            <p class="mt-5 text-sm font-extralight text-gray-300">{!! nl2br($video->description) !!}</p>
        </div>


        @if (auth()->user()->role == 1)
            <hr class="my-10">

            <div class="flex justify-center">
                <form action="{{ route('video.destroy-by-admin', $video->id) }}" method="POST" class="w-96 flex flex-col justify-center">
                    <h1 class="text-center mb-5 text-lg">Hapus Video</h1>

                    @csrf
                    @method('DELETE')

                    {{-- Deskripsi --}}
                    <div class="mb-5">
                        <div class="p-0 flex bg-cgray text-black">
                            <textarea id="reason" name="reason" rows="5" placeholder="Masukkan Alasan" required class="border-none bg-transparent m-0 w-full h-full focus:border-none focus:outline-none focus:ring-0 placeholder-slate-600">{{ old('description') }}</textarea>
                        </div>
                        <x-input-error :messages="$errors->get('reason')" class="mt-2" />
                    </div>

                    <input type="submit" value="Kirim Alasan & Hapus" class="bg-red-500 py-2 px-3 text-sm text-white hover:cursor-pointer">
                </form>
            </div>
        @endif
    </div>
</x-app-layout>
