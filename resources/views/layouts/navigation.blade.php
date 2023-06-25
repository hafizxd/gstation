<nav x-data="{ open: false }" class="bg-stone-950">
    <div class="border-b border-gray-400">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('video.index') }}">
                            {{-- <x-application-logo class="block h-9 w-auto fill-current text-gray-800" /> --}}
                            <h1 class="title text-primary text-3xl font-bold text-center">
                                G<span class="text-gray-200">station</span>
                            </h1>
                        </a>
                    </div>
                </div>

                <form action="{{ route('video.index') }}" method="GET" class="p-0 w-full my-4 mx-8 flex bg-gray-300">
                    <input id="search" type="text" name="search" value="{{ request()->get('search') }}" placeholder="Search" class="pl-5 border-none bg-transparent m-0 w-full h-full focus:border-none focus:outline-none focus:ring-0 placeholder-slate-500 text-sm">
                    <button type="submit">
                        <img src="{{ asset('/assets/icons/search.svg') }}" class="mr-2" width="25" alt="">
                    </button>
                </form>

                <!-- Settings Dropdown -->
                <div class="flex items-center">
                    <x-dropdown align="right">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center pr-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-200 hover:text-gray-500 focus:outline-none transition ease-in-out duration-150">
                                <img src="{{ asset('/assets/icons/profile.svg') }}" alt="" class="h-16">
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="flex justify-start items-center gap-3 text-white mb-2 px-2">
                                <img src="{{ asset('/assets/icons/profile(1).svg') }}" alt="" class="h-9">
                                <h5>
                                    @if (auth()->user()->role == 1)
                                        <span class="text-red-500">GM</span>
                                    @endif {{ auth()->user()->username }}
                                </h5>
                            </div>
                            <hr>

                            <x-dropdown-link :href="route('user.detail', auth()->user()->id)">
                                {{ __('My Profile') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Change Username') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile.password.edit')">
                                {{ __('Change Password') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('video.mine')">
                                {{ __('Video Saya') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('favorite.index')">
                                {{ __('Favorite Saya') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('deleted-reason.index')">
                                {{ __('Pemberitahuan') }}
                            </x-dropdown-link>

                            <hr>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>
</nav>
