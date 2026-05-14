<x-guest-layout>
    <div class="min-h-screen bg-[#0b0b18] text-white flex flex-col justify-center items-center px-6">
        
        {{-- Background Glow --}}
        <div class="fixed top-0 left-0 w-full h-full -z-10">
            <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-purple-600/10 rounded-full blur-[100px]"></div>
        </div>

        <div class="w-full max-w-md">
            {{-- Logo / Brand --}}
            <div class="text-center mb-10">
                <a href="/" class="text-3xl font-black italic tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-500">
                    E-TIXIS.
                </a>
                <p class="text-white/40 text-sm mt-2">Daftar akun untuk mulai pesan tiket event</p>
            </div>

            {{-- Form Card --}}
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 p-8 rounded-[2rem] shadow-2xl">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Nama -->
                    <div>
                        <label for="name" class="block text-xs font-black tracking-widest text-purple-400 uppercase mb-2">Nama Lengkap</label>
                        <input id="name" class="block mt-1 w-full bg-white/5 border-white/10 rounded-xl focus:border-purple-500 focus:ring-purple-500 text-white placeholder-white/20 py-3" type="text" name="name" :value="old('name')" required autofocus placeholder="Masukkan nama Anda" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="mt-6">
                        <label for="email" class="block text-xs font-black tracking-widest text-purple-400 uppercase mb-2">Alamat Email</label>
                        <input id="email" class="block mt-1 w-full bg-white/5 border-white/10 rounded-xl focus:border-purple-500 focus:ring-purple-500 text-white placeholder-white/20 py-3" type="email" name="email" :value="old('email')" required placeholder="nama@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-6">
                        <label for="password" class="block text-xs font-black tracking-widest text-purple-400 uppercase mb-2">Kata Sandi</label>
                        <input id="password" class="block mt-1 w-full bg-white/5 border-white/10 rounded-xl focus:border-purple-500 focus:ring-purple-500 text-white placeholder-white/20 py-3" type="password" name="password" required placeholder="Minimal 8 karakter" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mt-6">
                        <label for="password_confirmation" class="block text-xs font-black tracking-widest text-purple-400 uppercase mb-2">Konfirmasi Kata Sandi</label>
                        <input id="password_confirmation" class="block mt-1 w-full bg-white/5 border-white/10 rounded-xl focus:border-purple-500 focus:ring-purple-500 text-white placeholder-white/20 py-3" type="password" name="password_confirmation" required placeholder="Ulangi kata sandi" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex flex-col gap-4 mt-10">
                        <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-fuchsia-600 py-4 rounded-xl font-black text-sm tracking-widest hover:scale-[1.02] transition-all shadow-lg shadow-purple-500/20 uppercase">
                            Daftar Akun
                        </button>

                        <a class="text-center text-xs font-bold text-white/40 hover:text-white transition" href="{{ route('login') }}">
                            Sudah punya akun? <span class="text-purple-400">Masuk di sini</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>