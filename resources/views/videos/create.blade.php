<x-app-layout>
    <style>
        #FileUpload.active {
            // When files dragged over
            // @apply shadow-outline-blue border-blue-300;
            box-shadow: 0 0 0 3px rgba(164, 202, 254, 0.45);
            border-color: #a4cafe;
        }
    </style>

    <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Video Upload --}}
        <div class="flex flex-col flex-grow mb-5">
            <div x-data="{ files: null }" id="FileUpload" class="block w-full py-6 px-3 relative bg-cgray appearance-none border-solid hover:shadow-outline-gray">
                <input type="file" name="video" accept="video/*" multiple class="absolute inset-0 z-50 m-0 p-0 w-full h-full outline-none opacity-0" x-on:change="files = $event.target.files; console.log($event.target.files);" x-on:dragover="$el.classList.add('active')" x-on:dragleave="$el.classList.remove('active')" x-on:drop="$el.classList.remove('active')">
                <template x-if="files !== null">
                    <div class="flex flex-col space-y-1">
                        <template x-for="(_,index) in Array.from({ length: files.length })">
                            <div class="flex flex-row items-center space-x-2">
                                <template x-if="files[index].type.includes('video/')"><i class="far fa-file-video fa-fw"></i></template>
                                <span class="font-medium text-gray-900" x-text="files[index].name">Uploading</span>
                                <span class="text-xs self-end text-gray-500" x-text="filesize(files[index].size)">...</span>
                            </div>
                        </template>
                    </div>
                </template>
                <template x-if="files === null">
                    <div class="flex flex-col space-y-3 items-center justify-center">
                        {{-- <i class="fas fa-cloud-upload-alt fa-3x text-currentColor"></i> --}}
                        <img width="35" src="{{ asset('/assets/icons/upload.svg') }}" alt="">
                        <p class="text-black text-lg">Drag and drop a video here to upload</p>
                        <a href="javascript:void(0)" class="flex items-center mx-auto py-2 px-6 text-white text-center font-medium border border-transparent outline-none bg-primary">Select File</a>
                    </div>
                </template>
            </div>
            <x-input-error :messages="$errors->get('video')" class="mt-2" />
        </div>

        {{-- Judul --}}
        <div class="mb-5">
            <div class="p-0 h-12 flex bg-cgray">
                <input id="title" type="text" name="title" value="{{ old('title') }}" placeholder="Masukkan Judul" required class="border-none bg-transparent m-0 w-full h-full focus:border-none focus:outline-none focus:ring-0 placeholder-slate-600">
            </div>
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        {{-- Deskripsi --}}
        <div class="mb-5">
            <div class="p-0 flex bg-cgray">
                <textarea id="description" name="description" rows="5" placeholder="Masukkan Deskripsi" required class="border-none bg-transparent m-0 w-full h-full focus:border-none focus:outline-none focus:ring-0 placeholder-slate-600">{{ old('description') }}</textarea>
            </div>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        {{-- Thumbnail Upload --}}
        <div class="flex flex-col flex-grow mb-5">
            <div x-data="{ files: null }" id="FileUpload" class="w-1/3 py-6 px-3 relative bg-cgray appearance-none border-solid hover:shadow-outline-gray">
                <input type="file" name="thumbnail" accept="image/*" multiple class="absolute inset-0 z-50 m-0 p-0 w-full h-full outline-none opacity-0" x-on:change="files = $event.target.files; console.log($event.target.files);" x-on:dragover="$el.classList.add('active')" x-on:dragleave="$el.classList.remove('active')" x-on:drop="$el.classList.remove('active')">
                <template x-if="files !== null">
                    <div class="flex flex-col space-y-1">
                        <template x-for="(_,index) in Array.from({ length: files.length })">
                            <div class="flex flex-row items-center space-x-2">
                                <template x-if="files[index].type.includes('image/')"><i class="far fa-file-image fa-fw"></i></template>
                                <span class="font-medium text-gray-900" x-text="files[index].name">Uploading</span>
                                <span class="text-xs self-end text-gray-500" x-text="filesize(files[index].size)">...</span>
                            </div>
                        </template>
                    </div>
                </template>
                <template x-if="files === null">
                    <div class="flex flex-col space-y-3 items-center justify-center">
                        {{-- <i class="fas fa-cloud-upload-alt fa-3x text-currentColor"></i> --}}
                        <img width="35" src="{{ asset('/assets/icons/upload.svg') }}" alt="">
                        <p class="text-black text-lg">Upload Thumbnail</p>
                        <a href="javascript:void(0)" class="flex items-center mx-auto py-2 px-6 text-white text-center font-medium border border-transparent outline-none bg-primary">Select File</a>
                    </div>
                </template>
            </div>
            <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
        </div>

        {{-- Button --}}
        <div class="flex justify-end">
            <button type="submit" class="bg-primary py-2 px-8 font-medium text-white mb-2">Upload</button>
        </div>
    </form>
</x-app-layout>
