<x-app-layout>
    <div class="flex min-h-screen bg-[#090917] font-sans">
        
        <aside class="w-64 fixed inset-y-0 left-0 z-50 bg-[#111022] border-r border-white/5">
            @include('layouts.navigation')
        </aside>

        <div class="flex-1 ml-64 bg-[#090917]">
            
            <nav class="bg-[#111022]/95 backdrop-blur-md sticky top-0 z-40 border-b border-white/5 py-5 px-10 flex justify-between items-center shadow-2xl">
                <div>
                    <h2 class="font-black text-2xl text-white tracking-widest uppercase italic">
                        Account <span class="text-purple-500">Profile</span>
                    </h2>
                </div>
                
                <div class="flex items-center gap-4 bg-[#1a192f] px-5 py-2.5 rounded-2xl border border-white/10 shadow-lg">
                    <div class="text-right text-white">
                        <p class="font-black text-sm tracking-tight leading-none uppercase">{{ Auth::user()->name }}</p>
                        <p class="text-purple-400 text-[10px] font-black uppercase tracking-widest mt-1 italic">Verified User</p>
                    </div>
                    <div class="h-10 w-10 rounded-xl bg-gradient-to-tr from-purple-600 to-pink-500 flex items-center justify-center text-white font-black border border-white/20 shadow-pink-500/20 shadow-lg transform rotate-3 text-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </nav>

            <div class="py-12 px-10">
                <div class="max-w-6xl mx-auto space-y-10">
                    
                    <div class="relative overflow-hidden p-10 bg-gradient-to-br from-[#1a1c3d] to-[#111022] border border-white/10 rounded-[3rem] shadow-2xl flex items-center gap-10">
                        <div class="h-36 w-36 rounded-[2rem] bg-gradient-to-tr from-purple-600 via-pink-500 to-orange-400 flex items-center justify-center text-7xl font-black text-white shadow-2xl transform -rotate-3 border-4 border-white/10">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div>
                            <span class="px-4 py-1.5 bg-purple-500/20 text-purple-400 text-[10px] font-black rounded-full border border-purple-500/30 uppercase tracking-[0.2em] mb-4 inline-block italic shadow-lg">Member Account</span>
                            <h3 class="text-6xl font-black text-white uppercase tracking-tighter italic leading-none">
                                {{ Auth::user()->name }}
                            </h3>
                            <p class="text-gray-400 text-lg mt-3 font-bold italic opacity-75">Status: Active • Joined {{ Auth::user()->created_at->format('M Y') }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                        
                        <div class="lg:col-span-2 space-y-10">
                            <div class="p-10 bg-[#111022] border border-white/5 shadow-2xl rounded-[3rem]">
                                <h4 class="text-2xl font-black text-white mb-8 border-b border-white/5 pb-5 uppercase tracking-widest italic text-purple-500">Update Profile</h4>
                                <div class="max-w-full">
                                    @include('profile.partials.update-profile-information-form')
                                </div>
                            </div>

                            <div class="p-10 bg-[#111022] border border-white/5 shadow-2xl rounded-[3rem]">
                                <h4 class="text-2xl font-black text-white mb-8 border-b border-white/5 pb-5 uppercase tracking-widest italic text-pink-500">Change Security</h4>
                                <div class="max-w-full">
                                    @include('profile.partials.update-password-form')
                                </div>
                            </div>
                        </div>

                        <div class="space-y-10">
                            <div class="p-8 bg-[#111022] border border-white/5 shadow-2xl rounded-[3rem]">
                                <h4 class="text-xl font-black text-white mb-6 uppercase tracking-widest italic border-b border-white/5 pb-3">Summary</h4>
                                <div class="space-y-5 text-sm font-black">
                                    <div class="flex justify-between items-center text-gray-400">
                                        <span>JOINED</span>
                                        <span class="text-white">{{ Auth::user()->created_at->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center text-gray-400">
                                        <span>ACCOUNT ROLE</span>
                                        <span class="text-purple-500 uppercase">User</span>
                                    </div>
                                </div>
                            </div>

                            <div class="p-8 bg-red-950/10 border border-red-500/20 shadow-2xl rounded-[3rem]">
                                <h4 class="text-xl font-black text-red-500 mb-4 uppercase tracking-widest italic">Terminate</h4>
                                <div class="text-white/80">
                                    @include('profile.partials.delete-user-form')
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Paksa Label Jadi Gede & Tebal */
        label { 
            font-size: 1.1rem !important; 
            font-weight: 900 !important;
            color: #94a3b8 !important; 
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 0.8rem !important;
            display: block;
        }

        /* Paksa Input Jadi Gelap & Gede */
        input { 
            font-size: 1.2rem !important; 
            padding: 1.2rem 1.5rem !important;
            background-color: #090917 !important;
            border: 2px solid rgba(255,255,255,0.05) !important;
            color: white !important;
            border-radius: 20px !important;
            width: 100% !important;
            font-weight: 700 !important;
        }

        input:focus {
            border-color: #9333ea !important;
            box-shadow: 0 0 30px rgba(147, 51, 234, 0.25) !important;
            outline: none !important;
        }

        /* Tombol Save Gradasi Dashboard */
        button[type="submit"]:not(.bg-red-600) {
            background: linear-gradient(90deg, #9333ea, #db2777) !important;
            padding: 1.2rem 2.5rem !important;
            border-radius: 18px !important;
            font-weight: 900 !important;
            font-size: 1.1rem !important;
            text-transform: uppercase !important;
            letter-spacing: 2.5px !important;
            border: none !important;
            color: white !important;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3) !important;
            transition: all 0.4s ease;
        }

        button[type="submit"]:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(219, 39, 119, 0.4) !important;
        }

        /* Menghilangkan background putih dari elemen bawaan Laravel */
        .bg-white { background-color: transparent !important; }
        .shadow { shadow: none !important; }
    </style>
</x-app-layout>