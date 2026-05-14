<x-app-layout>
    <div class="min-h-screen bg-[#0d0d16] font-sans text-white relative">
        
        <div class="absolute top-8 left-10 z-50">
            <a href="{{ route('dashboard') }}" class="group flex items-center gap-3 bg-[#161625] hover:bg-purple-600/20 px-6 py-3 rounded-2xl border border-white/10 transition-all duration-300">
                <svg class="w-5 h-5 text-purple-500 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="text-xs font-black uppercase tracking-[0.2em] italic">Kembali ke Beranda</span>
            </a>
        </div>

        <div class="p-10 pt-24 max-w-6xl mx-auto space-y-8">
            
            <div class="relative overflow-hidden p-10 bg-gradient-to-r from-[#2a1b4d] via-[#4d1b4a] to-[#7a3b1b] rounded-[2.5rem] border border-white/10 shadow-2xl flex items-center gap-8 group">
                <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/5 rounded-full blur-3xl group-hover:bg-purple-500/10 transition-all duration-700"></div>
                
                <div class="relative h-32 w-32 rounded-full bg-[#5d3b8e]/50 border-4 border-white/10 flex items-center justify-center text-5xl font-black text-white shadow-2xl transform group-hover:scale-105 transition-transform">
                    {{ substr(Auth::user()->name, 0, 1) }}{{ substr(strrchr(Auth::user()->name, ' '), 1, 1) }}
                </div>
                <div class="relative">
                    <h2 class="text-4xl font-black text-white italic tracking-tighter uppercase">{{ Auth::user()->name }}</h2>
                    <div class="flex items-center gap-3 mt-2">
                        <span class="px-3 py-1 bg-white/10 text-white/70 text-[10px] font-black rounded-lg border border-white/10 uppercase tracking-widest">Account Member</span>
                        <div class="flex items-center gap-1.5 px-3 py-1 bg-green-500/10 border border-green-500/20 rounded-lg text-green-400 text-[10px] font-black">
                            <div class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></div>
                            ACTIVE STATUS
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-8">
                    <div class="p-8 bg-[#161625] border border-white/5 rounded-[2.5rem] shadow-2xl">
                        <div class="flex items-center gap-3 mb-8">
                            <div class="h-8 w-1 bg-purple-500 rounded-full"></div>
                            <h4 class="text-white font-black italic uppercase tracking-widest text-sm">Update Info</h4>
                        </div>
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <div class="p-8 bg-[#161625] border border-white/5 rounded-[2.5rem] shadow-2xl">
                        <div class="flex items-center gap-3 mb-8">
                            <div class="h-8 w-1 bg-pink-500 rounded-full"></div>
                            <h4 class="text-white font-black italic uppercase tracking-widest text-sm">Security</h4>
                        </div>
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="p-8 bg-[#161625] border border-white/5 rounded-[2.5rem] shadow-2xl">
                        <h4 class="text-white font-black italic uppercase tracking-widest text-xs mb-6 opacity-50">Account Summary</h4>
                        <div class="space-y-5">
                            <div class="flex justify-between items-center text-[10px] font-black">
                                <span class="text-gray-500 tracking-widest uppercase">Joined Date</span>
                                <span class="text-white italic">{{ Auth::user()->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center text-[10px] font-black">
                                <span class="text-gray-500 tracking-widest uppercase">System Role</span>
                                <span class="text-purple-500 italic">USER</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-8 bg-red-950/10 border border-red-500/10 rounded-[2.5rem] shadow-2xl group">
                        <h4 class="text-red-500 font-black italic uppercase tracking-widest text-xs mb-4">Danger Zone</h4>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        label { 
            font-size: 0.8rem !important; 
            font-weight: 900 !important;
            color: #64748b !important; 
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 0.8rem !important;
            display: block;
        }

        input { 
            font-size: 1rem !important; 
            padding: 1rem 1.2rem !important;
            background-color: #0d0d16 !important;
            border: 1.5px solid rgba(255,255,255,0.05) !important;
            color: white !important;
            border-radius: 15px !important;
            width: 100% !important;
            font-weight: 700 !important;
        }

        input:focus {
            border-color: #9333ea !important;
            box-shadow: 0 0 20px rgba(147, 51, 234, 0.1) !important;
            outline: none !important;
        }

        /* Tombol Save Pink/Ungu */
        button[type="submit"]:not(.bg-red-600) {
            background: linear-gradient(90deg, #9333ea, #db2777) !important;
            padding: 0.8rem 2rem !important;
            border-radius: 12px !important;
            font-weight: 900 !important;
            font-size: 0.8rem !important;
            text-transform: uppercase !important;
            letter-spacing: 2px !important;
            color: white !important;
            border: none !important;
            box-shadow: 0 5px 15px rgba(219, 39, 119, 0.2) !important;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(219, 39, 119, 0.3) !important;
        }

        /* Bersihkan sisa Laravel */
        .bg-white { background-color: transparent !important; }
        .shadow { box-shadow: none !important; }
    </style>
</x-app-layout>