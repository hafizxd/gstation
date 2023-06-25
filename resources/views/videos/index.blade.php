<x-app-layout>
    <div class="text-white">
        <div class="grid grid-cols-3 gap-12 my-10">
            @foreach ($videos as $video)
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
            @endforeach
        </div>
    </div>
</x-app-layout>
