<x-app-layout>
    <div class="min-h-screen bg-[#090917] font-sans text-white">
        
        <div class="flex">
            <aside class="w-64 fixed inset-y-0 left-0 z-50 bg-[#111022] border-r border-white/5">
                @include('layouts.navigation')
            </aside>

            <div class="flex-1 ml-64">
                
                <nav class="bg-[#111022]/80 backdrop-blur-xl sticky top-0 z-40 border-b border-white/5 py-5 px-10 flex justify-between items-center shadow-2xl">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-1.5 bg-gradient-to-b from-purple-600 to-pink-500 rounded-full"></div>
                        <h2 class="font-black text-2xl tracking-[0.2em] uppercase italic text-white">
                            My <span class="text-purple-500">Profile</span>
                        </h2>
                    </div>

                    <div class="flex items-center gap-4 bg-[#1a192f] pl-6 pr-2 py-2 rounded-2xl border border-white/10 hover:border-purple-500/50 transition-all duration-300 group">
                        <div class="text-right">
                            <p class="text-white font-black text-sm leading-none group-hover:text-purple-400 transition-colors">{{ Auth::user()->name }}</p>
                            <p class="text-purple-400 text-[10px] font-black uppercase tracking-widest mt-1 opacity-70">Verified Member</p>
                        </div>
                        <div class="h-10 w-10 rounded-xl bg-gradient-to-tr from-purple-600 to-pink-500 flex items-center justify-center text-white font-black border border-white/20 shadow-lg transform group-hover:rotate-6 transition-transform">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>
                </nav>

                <div class="py-12 px-10 max-w-7xl mx-auto space-y-10">
                    
                    <div class="relative overflow-hidden p-12 bg-gradient-to-br from-[#1a1c3d] to-[#111022] border border-white/10 rounded-[3rem] shadow-[0_20px_50px_rgba(0,0,0,0.5)] flex items-center gap-12 group">
                        <div class="absolute -top-24 -right-24 w-96 h-96 bg-purple-600/10 rounded-full blur-[120px] group-hover:bg-purple-600/20 transition-all duration-700"></div>
                        
                        <div class="relative h-40 w-40 rounded-[2.5rem] bg-gradient-to-tr from-purple-600 via-pink-500 to-orange-400 flex items-center justify-center text-8xl font-black text-white shadow-2xl transform -rotate-3 border-8 border-white/5 group-hover:rotate-0 transition-transform duration-500">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>

                        <div class="relative">
                            <span class="px-5 py-1.5 bg-purple-500/20 text-purple-400 text-[10px] font-black rounded-full border border-purple-500/30 uppercase tracking-[0.3em] mb-5 inline-block italic shadow-inner">Official Account</span>
                            <h3 class="text-6xl font-black text-white uppercase tracking-tighter italic leading-none mb-3">
                                {{ Auth::user()->name }}
                            </h3>
                            <div class="flex items-center gap-3">
                                <div class="flex items-center gap-2 px-3 py-1 bg-green-500/10 border border-green-500/20 rounded-lg text-green-400 text-xs font-bold">
                                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                    ACTIVE STATUS
                                </div>
                                <span class="text-gray-500 font-bold text-sm italic">Joined {{ Auth::user()->created_at->format('F Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                        
                        <div class="lg:col-span-2 space-y-10">
                            <div class="p-10 bg-[#111022] border border-white/5 shadow-2xl rounded-[3.5rem] hover:shadow-purple-500/5 transition-all duration-500">
                                <h4 class="text-2xl font-black text-white mb-10 border-b border-white/5 pb-6 uppercase tracking-[0.2em] italic flex items-center gap-3">
                                    <span class="text-purple-500">01.</span> Personal Information
                                </h4>
                                <div class="text-lg">
                                    @include('profile.partials.update-profile-information-form')
                                </div>
                            </div>

                            <div class="p-10 bg-[#111022] border border-white/5 shadow-2xl rounded-[3.5rem] hover:shadow-pink-500/5 transition-all duration-500">
                                <h4 class="text-2xl font-black text-white mb-10 border-b border-white/5 pb-6 uppercase tracking-[0.2em] italic flex items-center gap-3">
                                    <span class="text-pink-500">02.</span> Password Security
                                </h4>
                                <div class="text-lg">
                                    @include('profile.partials.update-password-form')
                                </div>
                            </div>
                        </div>

                        <div class="space-y-10">
                            <div class="p-8 bg-gradient-to-b from-[#111022] to-[#090917] border border-white/5 shadow-2xl rounded-[3.5rem]">
                                <h4 class="text-xl font-black text-white mb-8 uppercase tracking-widest italic border-b border-white/5 pb-4">Account Summary</h4>
                                <div class="space-y-6">
                                    <div class="flex flex-col gap-1">
                                        <span class="text-[10px] text-gray-500 font-black tracking-[0.2em] uppercase">Email Address</span>
                                        <span class="text-white font-bold text-sm">{{ Auth::user()->email }}</span>
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <span class="text-[10px] text-gray-500 font-black tracking-[0.2em] uppercase">Account Role</span>
                                        <span class="text-purple-500 font-black italic">REGISTERED USER</span>
                                    </div>
                                    <div class="pt-4 border-t border-white/5">
                                        <p class="text-[10px] text-gray-600 font-medium italic italic leading-relaxed">
                                            Manage your account settings and security preferences to keep your e-Tixis account safe.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-8 bg-red-950/5 border border-red-500/10 shadow-2xl rounded-[3.5rem] group hover:bg-red-950/10 transition-all">
                                <h4 class="text-xl font-black text-red-600 mb-4 uppercase tracking-widest italic">Danger Zone</h4>
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Memperbesar Label & Teks Input */
        label { 
            font-size: 1.1rem !important; 
            font-weight: 900 !important;
            color: #94a3b8 !important; 
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 1rem !important;
            display: block;
        }

        input { 
            font-size: 1.2rem !important; 
            padding: 1.3rem 1.6rem !important;
            background-color: #090917 !important;
            border: 2px solid rgba(255,255,255,0.05) !important;
            color: white !important;
            border-radius: 22px !important;
            width: 100% !important;
            font-weight: 700 !important;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #9333ea !important;
            box-shadow: 0 0 30px rgba(147, 51, 234, 0.2) !important;
            transform: translateY(-2px);
        }

        /* Tombol Save Gradasi E-TIXIS */
        button[type="submit"]:not(.bg-red-600) {
            background: linear-gradient(90deg, #9333ea, #db2777) !important;
            padding: 1.2rem 3rem !important;
            border-radius: 20px !important;
            font-weight: 900 !important;
            font-size: 1.1rem !important;
            text-transform: uppercase !important;
            letter-spacing: 3px !important;
            color: white !important;
            border: none !important;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(147, 51, 234, 0.3) !important;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        button[type="submit"]:hover {
            transform: scale(1.05) translateY(-5px);
            box-shadow: 0 20px 40px rgba(219, 39, 119, 0.4) !important;
        }

        /* Hilangkan elemen bawaan Laravel yang ganggu */
        .bg-white { background-color: transparent !important; }
        [shadow] { box-shadow: none !important; }
    </style>
</x-app-layout>