<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Tiket - E-TIXIS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0b0b18] text-white min-h-screen p-6 lg:p-12">

    <div class="max-w-2xl mx-auto">
        {{-- Tombol Kembali --}}
        <a href="/events" class="text-white/50 hover:text-white transition flex items-center gap-2 mb-8 group">
            <span class="group-hover:-translate-x-1 transition-transform">←</span> Kembali ke Daftar Event
        </a>

        <div class="bg-[#111126] border border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl relative">
            {{-- Dekorasi Latar Belakang --}}
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-purple-600/10 rounded-full blur-[80px]"></div>
            
            {{-- Header Visual --}}
            <div class="h-32 bg-gradient-to-r from-purple-600 to-fuchsia-600 p-8 flex items-end">
                <h1 class="text-3xl font-black text-white">Konfirmasi Pemesanan</h1>
            </div>

            <div class="p-8 lg:p-10 relative">
                {{-- Detail Event --}}
                <div class="mb-10 bg-white/[0.02] border border-white/5 rounded-3xl p-6">
                    <h2 class="text-2xl font-bold text-purple-400 mb-4">{{ $event->nama_event }}</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center gap-3 text-white/60">
                            <span class="text-xl">📅</span>
                            <span class="text-sm font-medium">{{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-white/60">
                            <span class="text-xl">📍</span>
                            <span class="text-sm font-medium">{{ $event->lokasi }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-emerald-400/80">
                            <span class="text-xl">👥</span>
                            <span class="text-sm font-bold">Kuota Tersedia: {{ $event->kuota }}</span>
                        </div>
                    </div>
                </div>

                {{-- Form Pemesanan --}}
                <form action="/pesan-tiket/{{ $event->id }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-xs font-black uppercase tracking-[0.2em] text-white/30 mb-3 ml-2">Jumlah Tiket</label>
                        <div class="relative">
                            <span class="absolute left-6 top-1/2 -translate-y-1/2 text-xl opacity-40">🎟️</span>
                            <input type="number" name="jumlah_tiket" min="1" max="{{ $event->kuota }}" placeholder="1" required
                                class="w-full bg-white/[0.03] border border-white/10 rounded-2xl pl-16 pr-6 py-4 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-all outline-none text-white font-bold">
                        </div>
                        <p class="text-[10px] text-white/20 mt-3 ml-2 italic">*Maksimal pembelian sesuai sisa kuota yang tersedia.</p>
                    </div>

                    <button type="submit" 
                        class="w-full bg-purple-600 hover:bg-purple-500 text-white font-black py-5 rounded-2xl transition-all shadow-xl shadow-purple-900/40 active:scale-95 text-lg tracking-wider">
                        KONFIRMASI PESANAN
                    </button>
                </form>
            </div>
        </div>

        {{-- Footer Info --}}
        <div class="mt-8 flex items-center justify-center gap-4 opacity-20">
            <div class="h-[1px] flex-1 bg-white"></div>
            <p class="text-[10px] font-black uppercase tracking-widest">E-TIXIS Secure Checkout</p>
            <div class="h-[1px] flex-1 bg-white"></div>
        </div>
    </div>

</body>
</html>