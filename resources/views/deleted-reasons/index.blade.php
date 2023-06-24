<x-app-layout>
    <div class="text-white">
        <h1 class="font-bold text-2xl">Pemberitahuan</h1>

        <div class="my-10">
            @forelse ($reasons as $reason)
                <div class="mb-5">
                    <h4 class="font-medium text-2xl mb-1">Pemberitahuan Video Dihapus</h4>
                    <p class="text-xs text-stone-400 mb-3">{{ date('d F Y H:i:s', strtotime($reason->created_at)) }}</p>
                    <p class="font-thin text-sm text-gray-200">{{ $reason->reason }}</p>
                </div>

                <hr class="my-5">
            @empty
                <p>Tidak ada data.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
