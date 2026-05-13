<x-app-layout>
    <div class="flex min-h-screen bg-[#090917] text-white font-sans">
        
        <aside class="w-64 fixed inset-y-0 left-0 z-50 bg-[#111022] border-r border-white/5">
            @include('layouts.navigation')
        </aside>

        <div class="flex-1 ml-64">
            
            <header class="bg-[#111022]/90 backdrop-blur-md sticky top-0 z-40 border-b border-white/5 py-4 px-10 flex justify-between items-center">
                <h2 class="font-black text-2xl tracking-widest uppercase italic">
                    Account <span class="text-purple-500">Profile</span>
                </h2>
                
                <div class="flex items-center gap-3 bg-[#1a192f] px-4 py-2 rounded-xl border border-white/10">
                    <div class="text-right">
                        <p class="text-white font-bold text-xs leading-none">{{ Auth::user()->name }}</p>
                        <p class="text-purple-400 text-[10px] font-black uppercase tracking-tighter">Member</p>
                    </div>
                    <div class="h-8 w-8 rounded-full bg-gradient-to-tr from-purple-600 to-pink-500 flex items-center justify-center text-[10px] font-black border border-white/20">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <div class="py-10 px-10">
                <div class="max-w-5xl mx-auto space-y-10">
                    
                    <div class="p-10 bg-gradient-to-r from-[#1a1c3d] to-[#111022] border border-white/10 rounded-[2.5rem] flex items-center gap-8 shadow-2xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-purple-500/5 rounded-full blur-3xl"></div>
                        
                        <div class="h-32 w-32 rounded-[2rem] bg-gradient-to-tr from-purple-500 to-pink-500 flex items-center justify-center text-6xl font-black shadow-xl transform -rotate-2 border-4 border-white/10">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-5xl font-black uppercase tracking-tighter italic">{{ Auth::user()->name }}</h3>
                            <div class="mt-3 flex items-center gap-2">
                                <span class="px-3 py-1 bg-green-500/20 text-green-400 text-[10px] font-black rounded-full border border-green-500/30 uppercase">Active Status</span>
                                <span class="text-gray-400 text-sm font-medium">Joined {{ Auth::user()->created_at->format('M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        
                        <div class="lg:col-span-2 space-y-8">
                            <div class="p-8 bg-[#111022] border border-white/5 rounded-[2rem] shadow-xl">
                                <h4 class="text-xl font-black mb-6 uppercase tracking-widest border-b border-white/5 pb-4">Update Info</h4>
                                <div class="max-w-full">
                                    @include('profile.partials.update-profile-information-form')
                                </div>
                            </div>

                            <div class="p-8 bg-[#111022] border border-white/5 rounded-[2rem] shadow-xl">
                                <h4 class="text-xl font-black mb-6 uppercase tracking-widest border-b border-white/5 pb-4">Security</h4>
                                <div class="max-w-full">
                                    @include('profile.partials.update-password-form')
                                </div>
                            </div>
                        </div>

                        <div class="space-y-8">
                            <div class="p-8 bg-[#111022] border border-white/5 rounded-[2rem] shadow-xl">
                                <h4 class="text-lg font-black mb-4 uppercase italic">Summary</h4>
                                <div class="space-y-4 text-sm">
                                    <div class="flex justify-between border-b border-white/5 pb-2">
                                        <span class="text-gray-400">Role</span>
                                        <span class="text-purple-400 font-bold uppercase">User</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-400">Verified</span>
                                        <span class="text-green-400 font-bold">YES</span>
                                    </div>
                                </div>
                            </div>

                            <div class="p-8 bg-red-950/10 border border-red-500/20 rounded-[2rem]">
                                <h4 class="text-lg font-black text-red-500 mb-4 uppercase">Danger Zone</h4>
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Memperbesar Label & Input */
        label { 
            font-size: 1rem !important; 
            font-weight: 800 !important;
            color: #94a3b8 !important; 
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem !important;
        }
        input { 
            font-size: 1.1rem !important; 
            padding: 1rem !important;
            background-color: #090917 !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
            color: white !important;
            border-radius: 15px !important;
            font-weight: 600 !important;
        }
        input:focus {
            border-color: #9333ea !important;
            box-shadow: 0 0 15px rgba(147, 51, 234, 0.3) !important;
        }
        /* Tombol Save Gradasi */
        button[type="submit"]:not(.bg-red-600) {
            background: linear-gradient(90deg, #9333ea, #db2777) !important;
            padding: 1rem 2rem !important;
            border-radius: 15px !important;
            font-weight: 900 !important;
            font-size: 1rem !important;
            text-transform: uppercase !important;
            letter-spacing: 1.5px !important;
            border: none !important;
            cursor: pointer;
            transition: 0.3s;
        }
        button[type="submit"]:hover { transform: translateY(-3px); opacity: 0.9; }
    </style>
</x-app-layout>