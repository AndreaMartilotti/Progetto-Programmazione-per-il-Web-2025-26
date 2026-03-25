{{-- resources/views/layouts/navigation.blade.php --}}
<nav x-data="{
        mobileOpen: false,
        profileOpen: false,
        scrolled: false,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 8;
            });
        }
    }"
    :class="scrolled ? 'shadow-md bg-white' : 'shadow-sm bg-white'"
    class="sticky top-0 z-50 transition-shadow duration-300 border-b border-gray-100">

    <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- ─────────────────────────────────────────
                 LEFT — Logo
            ───────────────────────────────────────── --}}
            <div class="flex-shrink-0">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('logo.png') }}" alt="{{ config('app.name') }}" class="w-8 h-8 object-contain group-hover:scale-105 transition-transform duration-200">
                    <span class="hidden sm:block text-teal-800 font-bold text-base tracking-wide group-hover:text-teal-600 transition-colors duration-200">
                        {{ config('app.name', 'AppName') }}
                    </span>
                </a>
            </div>

            {{-- ─────────────────────────────────────────
                 CENTER — Navigation Links (desktop)
            ───────────────────────────────────────── --}}
            <div class="hidden md:flex items-center gap-2 absolute left-1/2 -translate-x-1/2">

                {{-- HOME --}}
                <a href="{{ route('dashboard') }}" class="relative px-4 py-2 text-xs font-bold tracking-widest transition-colors duration-200 rounded-xl {{ request()->routeIs('dashboard') ? 'text-teal-700 bg-teal-50' : 'text-gray-500 hover:text-teal-600 hover:bg-gray-50' }}">
                    HOME
                    @if(request()->routeIs('dashboard'))
                        <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-4/5 h-0.5 bg-teal-600 rounded-t-full"></span>
                    @endif
                </a>

                {{-- PROGETTI --}}
                <a href="{{ route('projects.index') }}" class="relative px-4 py-2 text-xs font-bold tracking-widest transition-colors duration-200 rounded-xl {{ request()->routeIs('projects.*') ? 'text-teal-700 bg-teal-50' : 'text-gray-500 hover:text-teal-600 hover:bg-gray-50' }}">
                    PROGETTI
                    @if(request()->routeIs('projects.*'))
                        <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-4/5 h-0.5 bg-teal-600 rounded-t-full"></span>
                    @endif
                </a>

                {{-- CALENDARIO --}}
                <a href="{{ route('calendar.index') }}" class="relative px-4 py-2 text-xs font-bold tracking-widest transition-colors duration-200 rounded-xl {{ request()->routeIs('calendar.*') ? 'text-teal-700 bg-teal-50' : 'text-gray-500 hover:text-teal-600 hover:bg-gray-50' }}">
                    CALENDARIO
                    @if(request()->routeIs('calendar.*'))
                        <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-4/5 h-0.5 bg-teal-600 rounded-t-full"></span>
                    @endif
                </a>

                {{-- ABOUT --}}
                <a href="{{ route('about') }}" class="relative px-4 py-2 text-xs font-bold tracking-widest transition-colors duration-200 rounded-xl {{ request()->routeIs('about') ? 'text-teal-700 bg-teal-50' : 'text-gray-500 hover:text-teal-600 hover:bg-gray-50' }}">
                    ABOUT
                    @if(request()->routeIs('about'))
                        <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-4/5 h-0.5 bg-teal-600 rounded-t-full"></span>
                    @endif
                </a>

            </div>

            {{-- ─────────────────────────────────────────
                 RIGHT — Actions (desktop)
            ───────────────────────────────────────── --}}
            <div class="hidden md:flex items-center gap-3">
                @auth
                    {{-- Notification Bell --}}
                    <button type="button" class="relative p-2.5 rounded-full text-gray-400 hover:text-teal-600 hover:bg-teal-50 transition-colors duration-200 focus:outline-none" aria-label="Notifiche">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-2 right-2.5 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                    </button>

                    {{-- Profile Dropdown --}}
                    <div class="relative" x-data="{ profileOpen: false }" @keydown.escape.window="profileOpen = false">
                        <button @click="profileOpen = !profileOpen" type="button" class="flex items-center gap-2 rounded-full focus:outline-none transition pl-2" :aria-expanded="profileOpen">
                            @if (Auth::user()->avatar_path)
                                <img src="{{ asset(Auth::user()->avatar_path) }}" alt="{{ Auth::user()->name }}" class="h-9 w-9 rounded-full object-cover ring-2 ring-gray-100 hover:ring-teal-200 transition-all" />
                            @else
                                <span class="inline-flex items-center justify-center h-9 w-9 rounded-full bg-teal-600 text-white font-bold text-xs ring-2 ring-gray-100 hover:ring-teal-200 transition-all">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </span>
                            @endif
                            <svg :class="profileOpen ? 'rotate-180 text-teal-600' : 'text-gray-400'" class="h-4 w-4 transition-all duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        {{-- Dropdown panel --}}
                        <div x-show="profileOpen" x-transition.opacity.duration.200ms @click.outside="profileOpen = false" style="display: none;"
                             class="absolute right-0 mt-3 w-56 origin-top-right rounded-2xl bg-white shadow-xl border border-gray-100 divide-y divide-gray-50 focus:outline-none overflow-hidden">

                            <div class="px-5 py-4 bg-gray-50/50">
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-0.5">Accesso come</p>
                                <p class="text-sm text-gray-900 font-bold truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            <div class="p-2">
                                @if(in_array(Auth::user()->role, ['founder', 'admin']))
                                    <a href="{{ route('users.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-teal-50 hover:text-teal-700 rounded-xl transition-colors">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                                        Gestione Utenti
                                    </a>
                                @endif
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-teal-50 hover:text-teal-700 rounded-xl transition-colors">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                                    Impostazioni Profilo
                                </a>
                            </div>

                            <div class="p-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center gap-3 px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-red-50 hover:text-red-600 rounded-xl transition-colors">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" /></svg>
                                        Disconnetti
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-gray-500 hover:text-teal-600 transition-colors">Accedi</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold rounded-xl transition-colors shadow-sm">Registrati</a>
                    @endif
                @endauth
            </div>

            {{-- ─────────────────────────────────────────
                 MOBILE — Hamburger Button
            ───────────────────────────────────────── --}}
            <div class="flex md:hidden">
                <button @click="mobileOpen = !mobileOpen" type="button" class="p-2 rounded-xl text-gray-500 hover:text-teal-700 hover:bg-teal-50 transition-colors focus:outline-none">
                    <svg x-show="!mobileOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" /></svg>
                    <svg x-show="mobileOpen" style="display: none;" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- ─────────────────────────────────────────
         MOBILE — Slide-down Menu
    ───────────────────────────────────────── --}}
    <div x-show="mobileOpen" x-transition.opacity style="display: none;" class="md:hidden border-t border-gray-100 bg-white absolute w-full shadow-xl rounded-b-[2rem] overflow-hidden">
        <div class="px-4 py-4 space-y-1">
            <a href="{{ route('dashboard') }}" @click="mobileOpen = false" class="flex items-center px-4 py-3 rounded-xl text-sm font-bold tracking-widest transition-colors {{ request()->routeIs('dashboard') ? 'bg-teal-50 text-teal-700' : 'text-gray-500 hover:bg-gray-50 hover:text-teal-600' }}">HOME</a>
            <a href="{{ route('projects.index') }}" @click="mobileOpen = false" class="flex items-center px-4 py-3 rounded-xl text-sm font-bold tracking-widest transition-colors {{ request()->routeIs('projects.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-500 hover:bg-gray-50 hover:text-teal-600' }}">PROGETTI</a>
            <a href="{{ route('calendar.index') }}" @click="mobileOpen = false" class="flex items-center px-4 py-3 rounded-xl text-sm font-bold tracking-widest transition-colors {{ request()->routeIs('calendar.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-500 hover:bg-gray-50 hover:text-teal-600' }}">CALENDARIO</a>
            <a href="{{ route('about') }}" @click="mobileOpen = false" class="flex items-center px-4 py-3 rounded-xl text-sm font-bold tracking-widest transition-colors {{ request()->routeIs('about') ? 'bg-teal-50 text-teal-700' : 'text-gray-500 hover:bg-gray-50 hover:text-teal-600' }}">ABOUT</a>
        </div>

        @auth
            <div class="border-t border-gray-100 p-4 bg-gray-50/50">
                <div class="flex items-center gap-3 mb-4 px-2">
                    @if (Auth::user()->profile_photo_url)
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="h-10 w-10 rounded-full object-cover ring-2 ring-white shadow-sm" />
                    @else
                        <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-teal-600 text-white font-bold shadow-sm ring-2 ring-white">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                    @endif
                    <div>
                        <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <div class="space-y-1">
                    @if(in_array(Auth::user()->role, ['founder', 'admin']))
                        <a href="{{ route('users.index') }}" @click="mobileOpen = false" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-gray-600 hover:bg-white transition-colors">
                            <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                            Gestione Utenti
                        </a>
                    @endif

                    <a href="{{ route('profile.edit') }}" @click="mobileOpen = false" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-gray-600 hover:bg-white transition-colors">
                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                        Profilo
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-red-600 hover:bg-red-50 transition-colors">
                            <svg class="h-4 w-4 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" /></svg>
                            Esci
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="p-4 flex gap-3 bg-gray-50/50 border-t border-gray-100">
                <a href="{{ route('login') }}" class="flex-1 text-center px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-gray-600 text-sm font-bold shadow-sm">Accedi</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="flex-1 text-center px-4 py-2.5 rounded-xl bg-teal-600 text-white text-sm font-bold shadow-sm">Registrati</a>
                @endif
            </div>
        @endauth
    </div>
</nav>
