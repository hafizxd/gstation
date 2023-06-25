<x-app-layout>
    <div class="text-white">
        <div class="my-10">
            @forelse ($users as $user)
                <div class="flex">
                    <a href="{{ route('user.detail', $user->id) }}">
                        <div class="flex items-center gap-5">
                            <div class="w-24 overflow-hidden">
                                <img src="{{ asset('/assets/icons/profile.svg') }}" alt="" class="min-w-full">
                            </div>
                            <div>
                                <h4 class="font-medium text-xl">
                                    @if ($user->role == 1)
                                        <span class="text-red-500">GM</span>
                                    @endif {{ $user->username }}
                                </h4>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <p>Tidak ada data.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
