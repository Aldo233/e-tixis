<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-TIXIS - Tiket Konser & Event Lampung</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,600,800" rel="stylesheet" />

    <!-- Vite -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); }
    </style>
</head>
<body class="bg-[#0b0b18] text-white antialiased overflow-x-hidden">
    
    {{-- Background Glow Dekoratif --}}
    <div class="fixed top-0 left-0 w-full h-full -z-10">
        <div class="absolute top-[-10%] left-[-10%] w-[600px] h-[600px] bg-purple-600/20 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-fuchsia-600/10 rounded-full blur-[100px]"></div>
    </div>

    {{-- Navbar --}}
    <nav class="flex justify-between items-center px-8 py-8 max-w-7xl mx-auto">
        <div class="text-2xl font-black tracking-tighter italic text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400">
            E-TIXIS.
        </div>
        
        <div class="flex gap-6 items-center">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-xs font-black tracking-widest hover:text-purple-400 transition">DASHBOARD</a>
                @else
                    <a href="{{ route('login') }}" class="text-xs font-black tracking-widest hover:text-purple-400 transition">MASUK</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-white text-black px-6 py-3 rounded-xl font-bold text-xs hover:bg-purple-500 hover:text-white transition-all duration-300 shadow-lg shadow-white/5 uppercase">
                            Daftar
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    {{-- Hero Section --}}
    <main class="max-w-7xl mx-auto px-6 pt-24 pb-32 flex flex-col items-center text-center">
        <div class="inline-block px-4 py-2 glass rounded-full text-[10px] font-black tracking-[0.3em] text-purple-400 mb-10 uppercase">
            Platform Tiket Event Lampung
        </div>
        
        <h1 class="text-6xl md:text-8xl font-black tracking-tighter leading-[0.9] mb-10">
            Akses Event <br> 
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-500 via-fuchsia-400 to-purple-600">
                Lokal Terbaik.
            </span>
        </h1>

        <p class="max-w-xl text-white/40 text-lg md:text-xl leading-relaxed mb-14 italic">
            "Satu platform untuk semua hiburan di Bumi Ruwa Jurai." 
            Pesan tiket konser, festival, dan acara favoritmu dengan sistem QR Code yang praktis.
        </p>

        <div class="flex flex-col sm:flex-row gap-5">
            <a href="{{ route('register') }}" class="bg-gradient-to-r from-purple-600 to-fuchsia-600 px-12 py-5 rounded-2xl font-black text-sm tracking-widest hover:scale-105 transition-all shadow-2xl shadow-purple-500/25 uppercase">
                Cari Event Sekarang
            </a>
            <a href="#about" class="glass px-12 py-5 rounded-2xl font-black text-sm tracking-widest hover:bg-white/5 transition-all text-white/70 uppercase">
                Tentang Kami
            </a>
        </div>

        {{-- Highlight Category --}}
        <div class="mt-32 grid grid-cols-1 md:grid-cols-3 gap-8 w-full max-w-5xl">
            <div class="glass p-10 rounded-[2.5rem] text-left hover:border-purple-500/50 transition-all group">
                <div class="w-12 h-12 bg-purple-600/20 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <span class="text-purple-400 font-black">01</span>
                </div>
                <h3 class="font-black text-xl mb-3 tracking-tight text-white/90">Konser Musik</h3>
                <p class="text-white/30 text-sm leading-relaxed">Dapatkan barisan depan untuk penampilan musisi nasional dan lokal di Lampung.</p>
            </div>

            <div class="glass p-10 rounded-[2.5rem] text-left hover:border-fuchsia-500/50 transition-all group">
                <div class="w-12 h-12 bg-fuchsia-600/20 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <span class="text-fuchsia-400 font-black">02</span>
                </div>
                <h3 class="font-black text-xl mb-3 tracking-tight text-white/90">Festival Budaya</h3>
                <p class="text-white/30 text-sm leading-relaxed">Nikmati kemeriahan festival seni dan budaya khas daerah Lampung.</p>
            </div>

            <div class="glass p-10 rounded-[2.5rem] text-left hover:border-purple-500/50 transition-all group">
                <div class="w-12 h-12 bg-purple-600/20 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <span class="text-purple-400 font-black">03</span>
                </div>
                <h3 class="font-black text-xl mb-3 tracking-tight text-white/90">Event Komunitas</h3>
                <p class="text-white/30 text-sm leading-relaxed">Hubungkan dirimu dengan berbagai kegiatan komunitas kreatif di sekitarmu.</p>
            </div>
        </div>
    </main>

    <footer class="py-16 text-center">
        <p class="text-white/20 text-[10px] font-black tracking-[0.4em] uppercase mb-4">
            &copy; 2026 E-TIXIS LAMPUNG
        </p>
        <div class="flex justify-center gap-6 opacity-30">
            {{-- Tambahkan link sosial media jika ada --}}
        </div>
    </footer>

</body>
</html>