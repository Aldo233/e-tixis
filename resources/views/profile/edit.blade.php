<x-app-layout>
    <div class="flex min-h-screen bg-[#0d0d16] font-sans">
        
        <aside class="w-64 fixed inset-y-0 left-0 z-50 bg-[#12121f] border-r border-white/5">
            @include('layouts.navigation')
        </aside>

        <div class="flex-1 ml-64 bg-[#0d0d16]">
            
            <nav class="bg-[#12121f]/90 backdrop-blur-md sticky top-0 z-40 border-b border-white/5 py-4 px-10 flex justify-between items-center shadow-xl">
                <div class="flex items-center gap-4">
                    <span class="text-white font-black text-xl tracking-tighter uppercase italic">e-TIXIS</span>
                </div>
                
                <div class="flex items-center gap-4">
                    <p class="text-gray-400 font-bold text-xs uppercase tracking-widest">{{ Auth::user()->name }}</p>
                    <div class="h-9 w-9 rounded-full bg-gradient-to-tr from-purple-600 to-pink-500 border-2 border-white/10 shadow-lg"></div>
                </div>
            </nav>

            <div class="p-10 max-w-7xl mx-auto space-y-8">
                <h1 class="text-3xl font-black text-white italic tracking-tight mb-6">Profile</h1>

                <div class="relative overflow-hidden p-10 bg-gradient-to-r from-[#2a1b4d] via-[#4d1b4a] to-[#7a3b1b] rounded-[2rem] border border-white/10 shadow-2xl flex items-center gap-8">
                    <div class="h-32 w-32 rounded-full bg-[#5d3b8e]/50 border-4 border-white/10 flex items-center justify-center text-5xl font-black text-white shadow-2xl">
                        {{ substr(Auth::user()->name, 0, 1) }}{{ substr(strrchr(Auth::user()->name, ' '), 1, 1) }}
                    </div>
                    <div>
                        <h2 class="text-4xl font-black text-white italic tracking-tighter">{{ Auth::user()->name }}</h2>
                        <span class="mt-2 px-4 py-1 bg-white/10 text-white/70 text-[10px] font-black rounded-full border border-white/20 uppercase tracking-widest">USER</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2 space-y-8">
                        <div class="p-8 bg-[#161625] border border-white/5 rounded-[2rem] shadow-2xl">
                            <div class="flex items-center gap-2 mb-8 text-white font-black italic uppercase tracking-widest">
                                <span>Profile Information</span>
                                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </div>
                            @include('profile.partials.update-profile-information-form')
                        </div>

                        <div class="p-8 bg-[#161625] border border-white/5 rounded-[2rem] shadow-2xl">
                            <div class="flex items-center gap-2 mb-8 text-white font-black italic uppercase tracking-widest">
                                <span>Security Settings</span>
                                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            @include('profile.partials.update-password-form')
                        </div>

                        <div class="p-8 bg-[#161625] border border-white/5 rounded-[2rem] shadow-2xl border-red-500/10">
                            <div class="flex items-center gap-2 mb-8 text-red-500 font-black italic uppercase tracking-widest">
                                <span>Account Removal</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </div>
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>

                    <div class="space-y-8">
                        <div class="p-8 bg-[#161625] border border-white/5 rounded-[2rem] shadow-2xl">
                            <h4 class="text-white font-black italic uppercase tracking-widest mb-6">Account Status</h4>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center text-xs">
                                    <span class="text-gray-500 font-bold tracking-widest uppercase">Login & Role</span>
                                    <span class="px-3 py-1 bg-green-500/10 text-green-500 font-black rounded-lg border border-green-500/20 uppercase tracking-tighter italic">ACTIVE</span>
                                </div>
                                <div class="flex justify-between items-center text-xs">
                                    <span class="text-gray-500 font-bold tracking-widest uppercase">Validasi Tiket</span>
                                    <span class="px-3 py-1 bg-green-500/10 text-green-500 font-black rounded-lg border border-green-500/20 uppercase tracking-tighter italic">ACTIVE</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="relative h-44 rounded-[2rem] overflow-hidden border border-white/5 shadow-2xl group">
                            <img src="https://images.unsplash.com/photo-1514525253361-bee8a48740d7?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover opacity-30 group-hover:scale-110 transition-transform duration-700" alt="Ticket">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#161625] to-transparent"></div>
                            <div class="absolute bottom-6 left-6">
                                <div class="w-12 h-1 bg-purple-600 rounded-full mb-2"></div>
                                <span class="text-white font-black italic uppercase text-xs tracking-widest">e-TIXIS System</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        /* Paksa Label & Input Jadi Gelap & Gede */
        label { 
            font-size: 0.9rem !important; 
            font-weight: 900 !important;
            color: #94a3b8 !important; 
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 0.8rem !important;
            display: block;
        }

        input { 
            font-size: 1rem !important; 
            padding: 1rem 1.2rem !important;
            background-color: #1a1a2e !important;
            border: 1px solid rgba(255,255,255,0.05) !important;
            color: white !important;
            border-radius: 12px !important;
            width: 100% !important;
            font-weight: 700 !important;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.3) !important;
        }

        input:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.2) !important;
            outline: none !important;
        }

        /* Tombol Save Biru Elegan Sesuai Gambar */
        button[type="submit"]:not(.bg-red-600) {
            background: linear-gradient(135deg, #1e3a8a, #2563eb) !important;
            padding: 0.7rem 1.8rem !important;
            border-radius: 10px !important;
            font-weight: 900 !important;
            font-size: 0.8rem !important;
            text-transform: uppercase !important;
            letter-spacing: 2px !important;
            border: none !important;
            color: white !important;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3) !important;
            transition: all 0.3s ease;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4) !important;
        }

        /* Tombol Delete Merah */
        .bg-red-600 {
            background-color: #7f1d1d !important;
            padding: 0.7rem 1.8rem !important;
            border-radius: 10px !important;
            font-weight: 900 !important;
            text-transform: uppercase !important;
            font-size: 0.8rem !important;
        }

        .bg-white { background-color: transparent !important; }
    </style>
</x-app-layout>