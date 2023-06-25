<x-app-layout>
    <div class="text-white">
        <div class="my-10">
            <div class="flex flex-col items-center mb-20">
                <div class="w-24 overflow-hidden mb-3">
                    <img src="{{ asset('/assets/icons/profile.svg') }}" alt="" class="min-w-full">
                </div>
                <h4 class="font-medium text-xl">
                    @if ($user->role == 1)
                        <span class="text-red-500">GM</span>
                    @endif {{ $user->username }}
                </h4>
                <h4 class="font-medium text-lg">{{ $user->email }}</h4>

                @if ($user->id != auth()->user()->id)
                    <form action="{{ route('user.toggle-follow', $user->id) }}" method="POST" class="my-5">
                        @csrf
                        @if (!auth()->user()->followings()->where('users.id', $user->id)->exists())
                            <input type="submit" value="Follow" class="text-yellow-400 hover:underline-offset hover:cursor-pointer">
                        @else
                            <input type="submit" value="Unfollow" class="text-red-500 hover:underline-offset hover:cursor-pointer">
                        @endif
                    </form>
                @endif
            </div>

            <h1 class="font-bold text-2xl">Video User {{ $user->username }}</h1>

            <div class="grid grid-cols-3 gap-12 my-10">
                @forelse ($user->videos as $video)
                    <a href="{{ route('video.detail', $video->id) }}">
                        <div class="flex flex-col justify-stretch">
                            <div class="h-32 overflow-hidden bg-white mb-2">
                                <img src="{{ asset('/storage/uploads/thumbnails/' . $video->thumbnail) }}" alt="" class="min-h-full">
                            </div>
                            <h4 class="font-medium text-lg">{{ $video->title }}</h4>
                            <p class="font-thin text-sm text-gray-200">
                                @if ($video->user->role == 1)
                                    <span class="text-red-500">GM</span>
                                @endif {{ $video->user->username }}
                            </p>
                        </div>
                    </a>
                @empty
                    <p>Tidak ada data.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
