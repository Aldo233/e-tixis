<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Profile Settings') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#090917] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-8 bg-gradient-to-r from-purple-900/40 to-pink-900/40 border border-white/10 rounded-2xl shadow-xl flex items-center gap-6">
                <div class="h-24 w-24 rounded-full bg-gradient-to-tr from-purple-600 to-pink-500 flex items-center justify-center text-3xl font-bold text-white shadow-lg">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-white">{{ Auth::user()->name }}</h3>
                    <p class="text-purple-300 text-sm">Account Member</p>
                    <div class="mt-2 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-500/20 text-green-400 border border-green-500/30">
                        ● Active Status
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 space-y-6">
                    
                    <div class="p-6 bg-[#111022] border border-white/5 shadow-2xl sm:rounded-2xl">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="p-6 bg-[#111022] border border-white/5 shadow-2xl sm:rounded-2xl">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="p-6 bg-[#111022] border border-white/5 shadow-2xl sm:rounded-2xl">
                        <h4 class="text-white font-semibold mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Account Summary
                        </h4>
                        <div class="space-y-4 text-sm">
                            <div class="flex justify-between text-gray-400">
                                <span>Joined Date</span>
                                <span class="text-white">{{ Auth::user()->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-400">
                                <span>Role</span>
                                <span class="text-purple-400 font-mono">{{ Auth::user()->role ?? 'User' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-red-900/10 border border-red-500/20 shadow-2xl sm:rounded-2xl">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        input {
            background-color: #1a192f !important;
            border-color: rgba(255,255,255,0.1) !important;
            color: white !important;
        }
        input:focus {
            border-color: #a855f7 !important;
            ring-color: #a855f7 !important;
        }
        label {
            color: #9ca3af !important;
        }
        h2, h3 {
            color: white !important;
        }
        p {
            color: #9ca3af !important;
        }
    </style>
</x-app-layout>