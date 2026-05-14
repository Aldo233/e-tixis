<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-TIXIS - Platform Tiket Modern</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,600,800" rel="stylesheet" />

    <!-- Vite (Sangat penting agar Tailwind jalan) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); }
    </style>
</head>
<body class="bg-[#0b0b18] text-white antialiased overflow-x-hidden">
    
    {{-- Background Glow --}}
    <div class="fixed top-0 left-0 w-full h-full -z-10">
        <div class="absolute top-[-10%] left-[-10%] w-[600px] h-[600px] bg-purple-600/20 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-fuchsia-600/10 rounded-full blur-[100px]"></div>
    </div>

    {{-- Navbar --}}
    <nav class="flex justify-between items-center px-8 py-8 max-w-7xl mx-auto">
        <div class="text-2xl font-black tracking-tighter italic text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-500">
            E-TIXIS.
        </div>
        
        <div class="flex gap-6 items-center">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-bold hover:text-purple-400 transition">DASHBOARD</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold hover:text-purple-400 transition">LOGIN</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-white text-black px-6 py-3 rounded-xl font-bold text-sm hover:bg-purple-500 hover:text-white transition-all duration-300 shadow-lg shadow-white/5">
                            DAFTAR
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    {{-- Hero Section --}}
    <main class="max-w-7xl mx-auto px-6 pt-20 pb-32 flex flex-col items-center text-center">
        <div class="inline-block px-4 py-2 glass rounded-full text-[10px] font-black tracking-[0.3em] text-purple-400 mb-8 uppercase">
            Sistem Manajemen Tiket Event
        </div>
        
        <h1 class="text-6xl md:text-8xl font-black tracking-tighter leading-[0.9] mb-8">
            Beli Tiket <br> 
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-500 via-fuchsia-400 to-purple-600">
                Masa Depan.
            </span>
        </h1>

        <p class="max-w-2xl text-white/40 text-lg md:text-xl leading-relaxed mb-12">
            Kelola dan beli tiket event kampus dengan sistem QR Code yang aman. 
            Didesain khusus untuk kemudahan mahasiswa Universitas Lampung.
        </p>

        <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ route('register') }}" class="bg-gradient-to-r from-purple-600 to-fuchsia-600 px-10 py-5 rounded-2xl font-black text-sm tracking-widest hover:scale-105 transition-all shadow-2xl shadow-purple-500/25">
                MULAI SEKARANG
            </a>
            <a href="#about" class="glass px-10 py-5 rounded-2xl font-black text-sm tracking-widest hover:bg-white/5 transition-all text-white/70">
                LEARN MORE
            </a>
        </div>

        {{-- Mockup Dekorasi --}}
        <div class="mt-24 w-full max-w-5xl glass rounded-[3rem] p-4 p-b-0 overflow-hidden shadow-2xl shadow-purple-500/10">
            <div class="bg-[#0b0b18] rounded-[2.5rem] w-full h-[400px] flex items-center justify-center border border-white/5">
                <span class="text-white/10 font-black text-4xl">PREVIEW DASHBOARD</span>
            </div>
        </div>
    </main>

    <footer class="py-12 text-center text-white/20 text-xs font-bold tracking-widest">
        &copy; 2026 E-TIXIS PROJECT - TEKNIK ELEKTRO UNILA
    </footer>

</body>
</html>