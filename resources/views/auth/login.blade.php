<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk E-TIXIS</title>
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
        <div class="absolute top-[-10%] right-[-10%] w-[500px] h-[500px] bg-fuchsia-600/10 rounded-full blur-[120px] -z-10"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[400px] h-[400px] bg-purple-600/20 rounded-full blur-[100px] -z-10"></div>

        <div class="w-full max-w-md z-10">
            {{-- Logo --}}
            <div class="text-center mb-10">
                <a href="/" class="text-3xl font-black italic tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-500">
                    E-TIXIS.
                </a>
                <p class="text-white/40 text-sm mt-2 font-medium">Selamat datang kembali di pusat event Lampung</p>
            </div>

            {{-- Form Card --}}
            <div class="bg-white/5 backdrop-blur-2xl border border-white/10 p-8 rounded-[2.5rem] shadow-2xl">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-5">
                        <label for="email" class="block text-[10px] font-black tracking-[0.2em] text-purple-400 uppercase mb-2 ml-1">Alamat Email</label>
                        <input id="email" class="block w-full bg-white/5 border-white/10 rounded-2xl focus:border-purple-500 focus:ring-purple-500 text-white placeholder-white/20 py-4 px-5 transition-all" type="email" name="email" :value="old('email')" required autofocus placeholder="nama@email.com" />
                        @error('email') <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <div class="flex justify-between items-center mb-2 ml-1">
                            <label for="password" class="block text-[10px] font-black tracking-[0.2em] text-purple-400 uppercase">Kata Sandi</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-[9px] font-bold text-white/30 hover:text-purple-400 uppercase tracking-widest transition">Lupa Sandi?</a>
                            @endif
                        </div>
                        <input id="password" class="block w-full bg-white/5 border-white/10 rounded-2xl focus:border-purple-500 focus:ring-purple-500 text-white placeholder-white/20 py-4 px-5 transition-all" type="password" name="password" required placeholder="Masukkan kata sandi" />
                        @error('password') <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center mb-8 ml-1">
                        <input id="remember_me" type="checkbox" class="rounded border-white/10 bg-white/5 text-purple-600 focus:ring-purple-500" name="remember">
                        <label for="remember_me" class="ml-2 text-[10px] font-bold text-white/40 uppercase tracking-wider">Ingat Saya</label>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-fuchsia-600 py-4 rounded-2xl font-black text-xs tracking-[0.2em] hover:scale-[1.02] active:scale-95 transition-all shadow-xl shadow-purple-500/20 uppercase text-white">
                        Masuk Sekarang
                    </button>

                    <div class="mt-8 text-center">
                        <a class="text-[11px] font-bold text-white/30 hover:text-white transition uppercase tracking-widest" href="{{ route('register') }}">
                            Belum punya akun? <span class="text-purple-400">Daftar Akun</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>