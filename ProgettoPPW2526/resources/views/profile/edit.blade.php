{{-- resources/views/profile/edit.blade.php --}}
<x-app-layout>
<div class="min-h-screen bg-gray-100 px-4 py-8 sm:px-6 lg:px-8 flex flex-col items-center">

    <div class="w-full max-w-4xl flex flex-col gap-6">

        {{-- HEADER --}}
        <div class="bg-white rounded-[2rem] shadow-xl border border-gray-200 overflow-hidden px-8 py-6">
            <nav class="flex items-center gap-1.5 text-xs text-gray-400 mb-3">
                <a href="{{ route('dashboard') }}" class="hover:text-teal-600 transition-colors font-medium">Dashboard</a>
                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                <span class="text-gray-600 font-medium">Impostazioni Profilo</span>
            </nav>

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-teal-50 flex items-center justify-center shrink-0 border border-teal-100">
                    <svg class="h-6 w-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight leading-none">Il tuo Profilo</h1>
                    <p class="text-xs text-gray-400 mt-1">Gestisci le tue informazioni personali, la sicurezza e l'avatar.</p>
                </div>
            </div>
        </div>

        {{-- INFO & AVATAR --}}
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-200">
            @include('profile.partials.update-profile-information-form')
        </div>

        {{-- PASSWORD --}}
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-200">
            @include('profile.partials.update-password-form')
        </div>

        {{-- DELETE ACCOUNT --}}
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-red-100">
            @include('profile.partials.delete-user-form')
        </div>

    </div>
</div>
</x-app-layout>
