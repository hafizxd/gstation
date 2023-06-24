<x-app-layout>
    <div class="text-white">
        <h1 class="font-bold text-2xl">Video Saya</h1>

        <div class="my-10">
            @forelse ($videos as $video)
                <div class="flex justify-between">
                    <div class="flex">
                        <a href="{{ route('video.detail', $video->id) }}">
                            <div class="flex gap-5">
                                <div class="w-56 overflow-hidden bg-white mb-2">
                                    <img src="{{ asset('/storage/uploads/thumbnails/' . $video->thumbnail) }}" alt="" class="min-w-full">
                                </div>
                                <div>
                                    <h4 class="font-medium text-2xl mb-3">{{ $video->title }}</h4>
                                    <p class="font-thin text-sm text-gray-200">{{ date('d F Y H:i:s', strtotime($video->created_at)) }}</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <x-dropdown align="right">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center pr-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-200 hover:text-gray-500 focus:outline-none transition ease-in-out duration-150">
                                <img src="{{ asset('/assets/icons/menu.svg') }}" alt="" class="h-7">
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <form method="POST" action="{{ route('video.destroy', $video->id) }}">
                                @csrf
                                @method('delete')

                                <x-dropdown-link :href="route('video.destroy', $video->id)" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Hapus') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                <hr class="my-5">
            @empty
                <p>Tidak ada data.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
