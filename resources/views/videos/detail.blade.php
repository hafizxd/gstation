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
                            <input type="submit" value="Unfollow" class="text-red-600 hover:underline-offset hover:cursor-pointer">
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

                    <input type="submit" value="Kirim Alasan & Hapus" class="bg-red-600 py-2 px-3 text-sm text-white hover:cursor-pointer">
                </form>
            </div>
        @endif

        <hr class="my-10">

        <div class="mt-5">
            <h1>Komentar</h1>

            <div class="mb-0">
                <div>
                    <div class="p-6">
                        <form action="{{ route('reply.store', $video->id) }}" method="POST">
                            @csrf

                            <div class="mb-5">
                                <div class="p-0 flex bg-cgray text-black">
                                    <textarea id="reply" name="reply" rows="3" placeholder="Isikan Komentar" required class="border-none bg-transparent m-0 w-full h-full focus:border-none focus:outline-none focus:ring-0 placeholder-slate-600">{{ old('reply') }}</textarea>
                                </div>
                                <x-input-error :messages="$errors->get('reply')" class="mt-2" />
                            </div>

                            <div class="flex justify-end gap-3">
                                <input type="submit" value="Kirim Komentar" class="bg-primary py-2 px-3 text-sm text-white hover:cursor-pointer">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @foreach ($video->replies as $key => $reply)
                <div x-data="{ openNestedCreate: false }" class="mb-5">
                    <div class="px-6 pb-2 flex gap-4">
                        <img class="w-12 h-12 rounded-lg" src="{{ asset('/assets/icons/profile.svg') }}" alt="User avatar">

                        <div class="w-full">
                            <div class="flex justify-between mb-2">
                                <p class="text-xs sm:text-sm font-semibold text-white">
                                    @if ($reply->author->role == 1)
                                        <span class="text-red-500">GM</span>
                                    @endif {{ $reply->author->username }}
                                </p>
                                <small class="text-xs text-gray-500">{{ $reply->created_at->format('d F Y H:i') }}</small>
                            </div>

                            <div class="mb-3">
                                <div class="mb-3">
                                    <div class="font-normal text-xs sm:text-sm text-gray-300">
                                        <p>{!! nl2br(e($reply->body)) !!}</p>
                                    </div>
                                </div>

                                <div x-data class="flex justify-between">
                                    <div class="flex gap-4">
                                        <button @click="openNestedCreate=true" class="text-xs sm:text-sm text-gray-500">Reply</button>
                                        @if ($reply->author->id == auth()->user()->id)
                                            <form action="{{ route('reply.destroy', $reply->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs sm:text-sm text-red-600 hover:underline">Hapus</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="pt-3">
                                @foreach ($reply->nestedReplies as $nest)
                                    <div class="my-0">
                                        <div class="flex gap-4">
                                            <img class="w-12 h-12 rounded-lg" src="{{ asset('/assets/icons/profile.svg') }}" alt="User avatar">

                                            <div class="w-full">
                                                <div class="flex justify-between items-center mb-2">
                                                    <p class="text-xs sm:text-sm font-semibold text-white">
                                                        @if ($nest->author->role == 1)
                                                            <span class="text-red-500">GM</span>
                                                        @endif{{ $nest->author->username }}
                                                    </p>
                                                    <small class="text-xs text-gray-500">{{ $nest->created_at->format('d F Y H:i') }}</small>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="font-normal text-xs sm:text-sm text-gray-300 mb-2">
                                                        <p>{{ $nest->body }}</p>
                                                    </div>

                                                    <div x-data class="flex justify-between">
                                                        <div class="flex gap-4">
                                                            @if ($nest->author->id == auth()->user()->id)
                                                                <form action="{{ route('nested-reply.destroy', $nest->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="text-xs sm:text-sm text-red-600 hover:underline">Hapus</button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div x-show="openNestedCreate">
                                    <div>
                                        <form action="{{ route('nested-reply.store', $reply->id) }}" method="POST">
                                            @csrf

                                            <div class="mb-5">
                                                <div class="p-0 flex bg-cgray text-black">
                                                    <textarea id="nestedReply" name="nestedReply" rows="2" placeholder="Isikan Komentar" required class="text-sm border-none bg-transparent mt-1 w-full h-full focus:border-none focus:outline-none focus:ring-0 placeholder-slate-600">{{ old('nestedReply') }}</textarea>
                                                </div>
                                                <x-input-error :messages="$errors->get('nestedReply')" class="mt-2" />
                                            </div>

                                            <div class="flex justify-end gap-3">
                                                <button @click="openNestedCreate=false" class="text-xs sm:text-sm text-gray-400">Cancel</button>

                                                <input type="submit" value="Kirim" class="bg-primary py-2 px-3 text-sm text-white hover:cursor-pointer">
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
