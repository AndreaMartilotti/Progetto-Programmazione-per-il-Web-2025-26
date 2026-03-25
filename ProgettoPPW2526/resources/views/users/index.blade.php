{{-- resources/views/users/index.blade.php --}}
<x-app-layout>
<div class="min-h-screen bg-gray-100 px-4 py-8 sm:px-6 lg:px-8 flex flex-col items-center">

    {{-- MEGA BUBBLE CONTENITORE --}}
    <div class="w-full max-w-[90rem] bg-white rounded-[2rem] shadow-xl border border-gray-200 overflow-hidden flex flex-col">

        {{-- 1. HEADER --}}
        <div class="px-8 pt-6 pb-0 border-b border-gray-200 bg-white sticky top-0 z-20">

            <div class="flex items-start justify-between gap-6 mb-6">
                <div>
                    <div class="flex items-center gap-2.5 mb-1">
                        <div class="w-7 h-7 rounded-lg bg-teal-600 flex items-center justify-center">
                            <svg class="h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold text-gray-900 tracking-tight leading-none">Gestione Utenti</h1>
                    </div>
                    <p class="text-xs text-gray-400 ml-9.5">Approva i nuovi iscritti e gestisci i permessi del team.</p>
                </div>
            </div>

            {{-- STAT COUNTER --}}
            <div class="flex flex-col md:flex-row -mx-8 border-t border-gray-100">
                {{-- Totale --}}
                <div class="flex-1 flex items-center gap-4 px-8 py-4 border-b md:border-b-0 md:border-r border-gray-100">
                    <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center shrink-0">
                        <svg class="h-5 w-5 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900 leading-none">{{ $activeUsers->count() + $pendingUsers->count() + $bannedUsers->count() }}</p>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">Utenti Totali</p>
                    </div>
                </div>

                {{-- In Attesa --}}
                <div class="flex-1 flex items-center gap-4 px-8 py-4 border-b md:border-b-0 md:border-r border-gray-100 {{ $pendingUsers->count() > 0 ? 'bg-amber-50/50' : '' }}">
                    <div class="w-10 h-10 rounded-xl {{ $pendingUsers->count() > 0 ? 'bg-amber-100' : 'bg-gray-50' }} flex items-center justify-center shrink-0">
                        <svg class="h-5 w-5 {{ $pendingUsers->count() > 0 ? 'text-amber-600' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <p class="text-2xl font-bold {{ $pendingUsers->count() > 0 ? 'text-amber-600' : 'text-gray-900' }} leading-none">{{ $pendingUsers->count() }}</p>
                            @if($pendingUsers->count() > 0)
                                <span class="inline-flex h-2 w-2 rounded-full bg-amber-500 animate-pulse"></span>
                            @endif
                        </div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">In Attesa</p>
                    </div>
                </div>

                {{-- Bannati --}}
                <div class="flex-1 flex items-center gap-4 px-8 py-4">
                    <div class="w-10 h-10 rounded-xl {{ $bannedUsers->count() > 0 ? 'bg-red-50' : 'bg-gray-50' }} flex items-center justify-center shrink-0">
                        <svg class="h-5 w-5 {{ $bannedUsers->count() > 0 ? 'text-red-500' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-bold {{ $bannedUsers->count() > 0 ? 'text-red-600' : 'text-gray-900' }} leading-none">{{ $bannedUsers->count() }}</p>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">Bannati</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. BODY --}}
        <div class="flex-grow bg-gray-100 overflow-y-auto">

            {{-- FLASH MESSAGES --}}
            @if(session('success'))
                <div class="mx-8 mt-6 flex items-center gap-3 px-4 py-3 bg-emerald-50 border border-emerald-200 rounded-2xl">
                    <svg class="h-4 w-4 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-sm font-semibold text-emerald-800">{{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="mx-8 mt-6 flex items-center gap-3 px-4 py-3 bg-red-50 border border-red-200 rounded-2xl">
                    <svg class="h-4 w-4 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <p class="text-sm font-semibold text-red-800">{{ session('error') }}</p>
                </div>
            @endif

            {{-- COMMON LOGIC PER PERMESSI --}}
            @php
                $currentUserRole = Auth::user()->role;
            @endphp

            {{-- SEZIONE A: NUOVE RICHIESTE (PENDING) --}}
            <div class="px-8 py-6 border-b border-gray-200">
                <div class="flex items-center gap-2 mb-4">
                    <span class="h-2 w-2 rounded-full bg-amber-500 ring-2 ring-amber-100 {{ $pendingUsers->count() > 0 ? 'animate-pulse' : '' }}"></span>
                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Nuove Richieste <span class="ml-1.5 text-gray-400 font-semibold normal-case tracking-normal">({{ $pendingUsers->count() }})</span></p>
                </div>

                @if($pendingUsers->isEmpty())
                    <div class="flex flex-col items-center justify-center py-12 text-center bg-white rounded-2xl border-2 border-dashed border-gray-200">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center mb-3">
                            <svg class="h-6 w-6 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="text-sm font-bold text-gray-600 mb-1">Nessuna richiesta in attesa</h3>
                        <p class="text-xs text-gray-400">Tutti gli utenti sono stati approvati.</p>
                    </div>
                @else
                    <div class="bg-white rounded-2xl border border-amber-200 shadow-sm overflow-hidden">
                        @foreach($pendingUsers as $user)
                            <div class="relative flex items-center justify-between gap-4 px-5 py-4 {{ !$loop->last ? 'border-b border-amber-100' : '' }} hover:bg-amber-50/40 transition-colors group">
                                <div class="absolute left-0 top-3 bottom-3 w-1 bg-amber-400 rounded-r-full"></div>

                                <div class="flex items-center gap-3.5 min-w-0 pl-3">
                                    @if($user->profile_photo_url)
                                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-full object-cover shrink-0 ring-2 ring-white shadow-sm">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-amber-500 text-white flex items-center justify-center text-sm font-bold shrink-0 ring-2 ring-white shadow-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                    @endif

                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2 mb-0.5">
                                            <p class="text-sm font-bold text-gray-900 truncate">{{ $user->name }}</p>
                                        </div>
                                        <p class="text-xs text-gray-400 truncate">{{ $user->email }}</p>
                                        <p class="text-[10px] text-gray-400 mt-0.5">Registrato {{ $user->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2 shrink-0">
                                    <form action="{{ route('users.approve', $user->id) }}" method="POST" class="inline">
                                        @csrf @method('PUT')
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-1">
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Approva
                                        </button>
                                    </form>
                                    <form action="{{ route('users.ban', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Rifiutare e bannare {{ addslashes($user->name) }}?');">
                                        @csrf @method('PUT')
                                        <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-gray-200 bg-white text-gray-400 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-red-500">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ─────────────────────────────────────────────────
                 SEZIONE B: UTENTI ATTIVI
            ───────────────────────────────────────────────── --}}
            <div class="px-8 py-6 border-b border-gray-200">
                <div class="flex items-center gap-2 mb-4">
                    <span class="h-2 w-2 rounded-full bg-emerald-500 ring-2 ring-emerald-100"></span>
                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Utenti Attivi <span class="ml-1.5 text-gray-400 font-semibold normal-case tracking-normal">({{ $activeUsers->count() }})</span></p>
                </div>

                @if($activeUsers->isEmpty())
                    <div class="flex flex-col items-center justify-center py-12 text-center bg-white rounded-2xl border-2 border-dashed border-gray-200">
                        <div class="w-12 h-12 rounded-2xl bg-gray-50 flex items-center justify-center mb-3">
                            <svg class="h-6 w-6 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                        </div>
                        <h3 class="text-sm font-bold text-gray-600 mb-1">Nessun utente attivo</h3>
                        <p class="text-xs text-gray-400">Gli utenti approvati appariranno qui.</p>
                    </div>
                @else
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

                        {{-- Table header (Flexbox) --}}
                        <div class="flex items-center gap-4 px-5 py-3 bg-gray-100 border-b border-gray-200">
                            <div class="flex-1 text-[10px] font-bold text-gray-600 uppercase tracking-widest">Utente</div>
                            <div class="w-1/3 max-w-[250px] text-[10px] font-bold text-gray-600 uppercase tracking-widest hidden sm:block">Email</div>
                            <div class="w-24 text-[10px] font-bold text-gray-600 uppercase tracking-widest">Ruolo</div>
                            <div class="w-10 text-right"></div> {{-- Spazio per il bottone --}}
                        </div>

                        {{-- Righe utenti (Flexbox) --}}
                        @foreach($activeUsers as $user)
                            @php
                                $roleConfig = match($user->role ?? 'user') {
                                    'founder' => ['label' => 'Founder',       'class' => 'bg-purple-100 text-purple-700'],
                                    'admin'   => ['label' => 'Admin',         'class' => 'bg-sky-100 text-sky-700'],
                                    default   => ['label' => 'Collaboratore', 'class' => 'bg-gray-100 text-gray-600'],
                                };

                                $isSelf = $user->id === Auth::id();
                                $canBan = false;

                                if (!$isSelf) {
                                    if ($currentUserRole === 'founder') {
                                        $canBan = true;
                                    } elseif ($currentUserRole === 'admin' && !in_array($user->role, ['founder', 'admin'])) {
                                        $canBan = true;
                                    }
                                }
                            @endphp
                            <div class="flex items-center gap-4 px-5 py-3.5 {{ !$loop->last ? 'border-b border-gray-100' : '' }} hover:bg-gray-50 transition-colors group">

                                {{-- Avatar + Nome (Prende tutto lo spazio disponibile con flex-1) --}}
                                <div class="flex-1 flex items-center gap-3 min-w-0 pr-2">
                                    @if($user->profile_photo_url)
                                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="w-8 h-8 rounded-full object-cover shrink-0 ring-2 ring-white shadow-sm">
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-teal-600 text-white flex items-center justify-center text-xs font-bold shrink-0 ring-2 ring-white shadow-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                    @endif
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold text-gray-900 truncate group-hover:text-teal-700 transition-colors">
                                            {{ $user->name }}
                                            @if($isSelf)<span class="text-[10px] font-bold text-gray-400 ml-1">(tu)</span>@endif
                                        </p>
                                        <p class="text-[10px] text-gray-400">Dal {{ $user->created_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="w-1/3 max-w-[250px] min-w-0 hidden sm:block">
                                    <p class="text-xs text-gray-500 truncate">{{ $user->email }}</p>
                                </div>

                                {{-- Badge Ruolo --}}
                                <div class="w-24 shrink-0">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold {{ $roleConfig['class'] }}">{{ $roleConfig['label'] }}</span>
                                </div>

                                {{-- Bottone Banna (Fissato all'estrema destra con justify-end) --}}
                                <div class="w-10 shrink-0 flex justify-end">
                                    @if(!$canBan)
                                        <span title="{{ $isSelf ? 'Non puoi bannare te stesso' : 'Permessi insufficienti' }}" class="inline-flex items-center justify-center w-8 h-8 rounded-xl border border-gray-100 bg-gray-50 text-gray-300 cursor-not-allowed">
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                        </span>
                                    @else
                                        <form action="{{ route('users.ban', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Sei sicuro di voler bannare {{ addslashes($user->name) }}?');">
                                            @csrf @method('PUT')
                                            <button type="submit" title="Banna utente" class="inline-flex items-center justify-center w-8 h-8 rounded-xl border border-gray-200 bg-white text-gray-400 hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-red-500">
                                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- SEZIONE C: UTENTI BANNATI --}}
            <div class="px-8 py-6">
                <div class="flex items-center gap-2 mb-4">
                    <span class="h-2 w-2 rounded-full bg-gray-300"></span>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Bannati <span class="ml-1.5 font-semibold normal-case tracking-normal">({{ $bannedUsers->count() }})</span></p>
                </div>

                @if($bannedUsers->isEmpty())
                    <div class="flex items-center justify-center py-8 text-center bg-white rounded-2xl border-2 border-dashed border-gray-200">
                        <p class="text-xs text-gray-400 font-medium">Nessun utente bannato.</p>
                    </div>
                @else
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                        @foreach($bannedUsers as $user)
                            <div class="flex items-center justify-between gap-4 px-5 py-4 {{ !$loop->last ? 'border-b border-gray-100' : '' }} hover:bg-gray-50 transition-colors group">
                                <div class="flex items-center gap-3 min-w-0">
                                    @if($user->profile_photo_url)
                                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="w-8 h-8 rounded-full object-cover shrink-0 ring-2 ring-white shadow-sm opacity-50 grayscale">
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-gray-400 text-white flex items-center justify-center text-xs font-bold shrink-0 ring-2 ring-white shadow-sm opacity-70">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                    @endif
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2 mb-0.5">
                                            <p class="text-sm font-semibold text-gray-500 truncate">{{ $user->name }}</p>
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-bold bg-red-600 text-white uppercase tracking-wider shrink-0">Bannato</span>
                                        </div>
                                        <p class="text-[10px] text-gray-400 truncate">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="shrink-0">
                                    <form action="{{ route('users.restore', $user->id) }}" method="POST" class="inline">
                                        @csrf @method('PUT')
                                        <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 border border-gray-200 bg-white text-gray-600 text-xs font-bold rounded-xl hover:border-teal-300 hover:text-teal-700 hover:bg-teal-50 transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-teal-500">
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"/></svg> Riabilita
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
</x-app-layout>
