<nav x-data="{ open: false }" class="bg-[#0b0b18]/50 backdrop-blur-xl border-b border-white/5 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-xl font-black italic tracking-tighter text-white">
                        E-TIXIS.
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-xs font-bold tracking-widest uppercase">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="flex items-center gap-4 bg-white/5 p-1.5 pr-4 rounded-full border border-white/10 transition-all hover:border-purple-500/30">
                    <!-- Role Badge -->
                    <div class="flex items-center gap-2 px-3 py-1 bg-[#1a1a2e] rounded-full border border-purple-500/20">
                        <span class="w-1.5 h-1.5 bg-purple-500 rounded-full animate-pulse"></span>
                        <span class="text-[9px] font-black text-purple-400 uppercase tracking-[0.2em]">User</span>
                    </div>

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-bold text-white/70 hover:text-white transition ease-in-out duration-150 focus:outline-none gap-3">
                                <span>{{ Auth::user()->name }}</span>
                                
                                <!-- Profile Photo Frame -->
                                <div class="relative">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-purple-600 to-fuchsia-600 p-[2px]">
                                        <div class="w-full h-full rounded-full bg-[#0b0b18] flex items-center justify-center overflow-hidden">
                                            {{-- Ganti dengan <img src="..."> jika ada foto --}}
                                            <span class="text-xs font-black text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-500 border-2 border-[#0b0b18] rounded-full"></div>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="text-xs font-bold uppercase tracking-widest">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="text-xs font-bold uppercase tracking-widest text-red-400 hover:text-red-500">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-white/50 hover:text-white hover:bg-white/5 focus:outline-none transition duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#0b0b18] border-t border-white/5">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-white/5">
            <div class="px-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-purple-600 flex items-center justify-center font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-bold text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-white/40">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-white/60">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-red-400">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>