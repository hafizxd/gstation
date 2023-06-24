<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<div x-cloak x-data="sidebar()" class="relative flex items-start ">
    <div class="fixed top-15 z-40 transition-all duration-300">
        <div class="flex justify-end">
            <button @click="sidebarOpen = !sidebarOpen" :class="{ 'hover:bg-stone-700': !sidebarOpen, 'hover:bg-gray-700': sidebarOpen }" class="transition-all duration-300 w-10 p-1 mx-3 my-2 rounded-full focus:outline-none">
                <svg viewBox="0 0 20 20" class="w-8 h-8 fill-current" :class="{ 'text-white': !sidebarOpen, 'text-gray-300': sidebarOpen }">
                    <path x-show="!sidebarOpen" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    <path x-show="sidebarOpen" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>

    <div x-cloak wire:ignore :class="{ 'w-60 border-white border-r': sidebarOpen, 'w-0': !sidebarOpen }" class="fixed top-15 left-0 z-30 block w-60 h-full min-h-screen overflow-y-auto text-gray-900 transition-all duration-300 ease-in-out bg-stone-950 shadow-lg overflow-x-hidden">

        <div class="flex flex-col items-stretch justify-between h-full">
            <div class="flex flex-col flex-shrink-0 w-full pt-16">

                <nav>
                    <div class="flex-grow md:block md:overflow-y-auto overflow-x-hidden" :class="{ 'opacity-1': sidebarOpen, 'opacity-0': !sidebarOpen }">
                        <a class="flex items-center justify-center px-4 py-3 mb-3 bg-stone-300 hover:bg-stone-500 focus:bg-stone-500 hover:text-gray-900 focus:outline-none focus:ring {{ request()->is('/') ? 'bg-white' : '' }}" href="{{ route('video.index') }}">
                            <span class="mx-4">Beranda</span>
                            <img class="w-5 h-5 fill-current" src="{{ asset('assets/icons/home.svg') }}" alt="">
                        </a>

                        <a class="flex items-center justify-center px-4 py-3 mb-3 bg-stone-300 hover:bg-stone-500 focus:bg-stone-500 hover:text-gray-900 focus:outline-none focus:ring {{ request()->is('videos/create') ? 'bg-white' : '' }}" href="{{ route('video.create') }}">
                            <span class="mx-4">Upload</span>
                            <img class="w-5 h-5 fill-current" src="{{ asset('assets/icons/upload.svg') }}" alt="">
                        </a>

                        <a class="flex items-center justify-center px-4 py-3 mb-3 bg-stone-300 hover:bg-stone-500 focus:bg-stone-500 hover:text-gray-900 focus:outline-none focus:ring {{ request()->is('users/followings') ? 'bg-white' : '' }}" href="{{ route('user.following.index') }}">
                            <span class="mx-4">Following</span>
                            <img class="w-5 h-5 fill-current" src="{{ asset('assets/icons/following.svg') }}" alt="">
                        </a>

                    </div>

                </nav>

            </div>
            <div>
                <a title="Logout" href="{{ route('logout') }}" class="block px-4 py-3" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                    <svg class="text-gray-400 fill-current w-7 h-7" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-label="door-leave" viewBox="0 0 32 32" title="door-leave">
                        <g>
                            <path d="M27.708,15.293c0.39,0.39 0.39,1.024 0,1.414l-4,4c-0.391,0.391 -1.024,0.391 -1.415,0c-0.39,-0.39 -0.39,-1.024 0,-1.414l2.293,-2.293l-11.586,0c-0.552,0 -1,-0.448 -1,-1c0,-0.552 0.448,-1 1,-1l11.586,0l-2.293,-2.293c-0.39,-0.39 -0.39,-1.024 0,-1.414c0.391,-0.391 1.024,-0.391 1.415,0l4,4Z">
                            </path>
                            <path
                                d="M11.999,8c0.001,0 0.001,0 0.002,0c1.699,-0.001 2.859,0.045 3.77,0.25c0.005,0.001 0.01,0.002 0.015,0.003c0.789,0.173 1.103,0.409 1.291,0.638c0,0 0,0.001 0,0.001c0.231,0.282 0.498,0.834 0.679,2.043c0,0.001 0,0.002 0.001,0.003c0.007,0.048 0.014,0.097 0.021,0.147c0.072,0.516 0.501,0.915 1.022,0.915c0.584,0 1.049,-0.501 0.973,-1.08c-0.566,-4.332 -2.405,-4.92 -7.773,-4.92c-7,0 -8,1 -8,10c0,9 1,10 8,10c5.368,0 7.207,-0.588 7.773,-4.92c0.076,-0.579 -0.389,-1.08 -0.973,-1.08c-0.521,0 -0.95,0.399 -1.022,0.915c-0.007,0.05 -0.014,0.099 -0.021,0.147c-0.001,0.001 -0.001,0.002 -0.001,0.003c-0.181,1.209 -0.448,1.762 -0.679,2.044l0,0c-0.188,0.229 -0.502,0.465 -1.291,0.638c-0.005,0.001 -0.01,0.002 -0.015,0.003c-0.911,0.204 -2.071,0.25 -3.77,0.25c-0.001,0 -0.001,0 -0.002,0c-1.699,0 -2.859,-0.046 -3.77,-0.25c-0.005,-0.001 -0.01,-0.002 -0.015,-0.003c-0.789,-0.173 -1.103,-0.409 -1.291,-0.638l0,0c-0.231,-0.282 -0.498,-0.835 -0.679,-2.043c0,-0.001 0,-0.003 -0.001,-0.005c-0.189,-1.247 -0.243,-2.848 -0.243,-5.061c0,0 0,0 0,0c0,-2.213 0.054,-3.814 0.243,-5.061c0.001,-0.002 0.001,-0.004 0.001,-0.005c0.181,-1.208 0.448,-1.76 0.679,-2.042c0,0 0,-0.001 0,-0.001c0.188,-0.229 0.502,-0.465 1.291,-0.638c0.005,-0.001 0.01,-0.002 0.015,-0.003c0.911,-0.205 2.071,-0.251 3.77,-0.25Z">
                            </path>
                        </g>
                    </svg>
                </a>
            </div>
        </div>

        <script>
            function sidebar() {
                return {
                    sidebarOpen: false,
                    sidebarProductMenuOpen: false,
                    openSidebar() {
                        this.sidebarOpen = true
                    },
                    closeSidebar() {
                        this.sidebarOpen = false
                    },
                    sidebarProductMenu() {
                        if (this.sidebarProductMenuOpen === true) {
                            this.sidebarProductMenuOpen = false
                            window.localStorage.setItem('sidebarProductMenuOpen', 'close');
                        } else {
                            this.sidebarProductMenuOpen = true
                            window.localStorage.setItem('sidebarProductMenuOpen', 'open');
                        }
                    },
                    checkSidebarProductMenu() {
                        if (window.localStorage.getItem('sidebarProductMenuOpen')) {
                            if (window.localStorage.getItem('sidebarProductMenuOpen') === 'open') {
                                this.sidebarProductMenuOpen = true
                            } else {
                                this.sidebarProductMenuOpen = false
                                window.localStorage.setItem('sidebarProductMenuOpen', 'close');
                            }
                        }
                    },
                }
            }
        </script>
    </div>

</div>
