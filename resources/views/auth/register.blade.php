<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar E-TIXIS</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,600,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#0b0b18] text-white antialiased">
    <div class="min-h-screen flex flex-col justify-center items-center px-6 relative overflow-hidden">
        
        {{-- Background Glow --}}
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-purple-600/20 rounded-full blur-[120px] -z-10"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[400px] h-[400px] bg-fuchsia-600/10 rounded-full blur-[100px] -z-10"></div>

        <div class="w-full max-w-md z-10">
            {{-- Logo --}}
            <div class="text-center mb-10">
                <a href="/" class="text-3xl font-black italic tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-500">
                    E-TIXIS.
                </a>
                <p class="text-white/40 text-sm mt-2 font-medium">Daftar akun untuk mulai pesan tiket event</p>
            </div>

            {{-- Form Card --}}
            <div class="bg-white/5 backdrop-blur-2xl border border-white/10 p-8 rounded-[2.5rem] shadow-2xl">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-5">
                        <label for="name" class="block text-[10px] font-black tracking-[0.2em] text-purple-400 uppercase mb-2 ml-1">Nama Lengkap</label>
                        <input id="name" class="block w-full bg-white/5 border-white/10 rounded-2xl focus:border-purple-500 focus:ring-purple-500 text-white placeholder-white/20 py-4 px-5 transition-all" type="text" name="name" :value="old('name')" required autofocus placeholder="Masukkan nama Anda" />
                        @error('name') <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-5">
                        <label for="email" class="block text-[10px] font-black tracking-[0.2em] text-purple-400 uppercase mb-2 ml-1">Alamat Email</label>
                        <input id="email" class="block w-full bg-white/5 border-white/10 rounded-2xl focus:border-purple-500 focus:ring-purple-500 text-white placeholder-white/20 py-4 px-5 transition-all" type="email" name="email" :value="old('email')" required placeholder="nama@email.com" />
                        @error('email') <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-5">
                        <label for="password" class="block text-[10px] font-black tracking-[0.2em] text-purple-400 uppercase mb-2 ml-1">Kata Sandi</label>
                        <input id="password" class="block w-full bg-white/5 border-white/10 rounded-2xl focus:border-purple-500 focus:ring-purple-500 text-white placeholder-white/20 py-4 px-5 transition-all" type="password" name="password" required placeholder="Minimal 8 karakter" />
                        @error('password') <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mb-8">
                        <label for="password_confirmation" class="block text-[10px] font-black tracking-[0.2em] text-purple-400 uppercase mb-2 ml-1">Konfirmasi Kata Sandi</label>
                        <input id="password_confirmation" class="block w-full bg-white/5 border-white/10 rounded-2xl focus:border-purple-500 focus:ring-purple-500 text-white placeholder-white/20 py-4 px-5 transition-all" type="password" name="password_confirmation" required placeholder="Ulangi kata sandi" />
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-fuchsia-600 py-4 rounded-2xl font-black text-xs tracking-[0.2em] hover:scale-[1.02] active:scale-95 transition-all shadow-xl shadow-purple-500/20 uppercase">
                        Daftar Sekarang
                    </button>

                    <div class="mt-8 text-center">
                        <a class="text-[11px] font-bold text-white/30 hover:text-white transition uppercase tracking-widest" href="{{ route('login') }}">
                            Sudah punya akun? <span class="text-purple-400">Masuk</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>