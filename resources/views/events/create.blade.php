<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event Baru - E-TIXIS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0b0b18] text-white min-h-screen p-6 lg:p-12">

    <div class="max-w-3xl mx-auto">
        {{-- Tombol Kembali --}}
        <a href="/events" class="text-white/50 hover:text-white transition flex items-center gap-2 mb-8 group">
            <span class="group-hover:-translate-x-1 transition-transform">←</span> Kembali ke Dashboard
        </a>

        <div class="bg-[#111126] border border-white/10 rounded-[2.5rem] p-8 lg:p-12 shadow-2xl relative overflow-hidden">
            {{-- Dekorasi --}}
            <div class="absolute -top-24 -left-24 w-64 h-64 bg-purple-600/10 rounded-full blur-[80px]"></div>

            <div class="relative">
                <h1 class="text-4xl font-black mb-2">Tambah Event</h1>
                <p class="text-white/40 mb-10">Silakan lengkapi formulir di bawah untuk membuat event baru.</p>

                <form action="/events" method="POST" class="space-y-6">
                    @csrf
                    
                    {{-- Nama Event --}}
                    <div>
                        <label class="block text-sm font-bold text-white/60 mb-2 ml-1">Nama Event</label>
                        <input type="text" name="nama_event" placeholder="Masukkan nama event..." required
                            class="w-full bg-white/[0.03] border border-white/10 rounded-2xl px-6 py-4 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-all outline-none text-white">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Tanggal --}}
                        <div>
                            <label class="block text-sm font-bold text-white/60 mb-2 ml-1">Tanggal Pelaksanaan</label>
                            <input type="date" name="tanggal" required
                                class="w-full bg-white/[0.03] border border-white/10 rounded-2xl px-6 py-4 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-all outline-none text-white [color-scheme:dark]">
                        </div>

                        {{-- Kuota --}}
                        <div>
                            <label class="block text-sm font-bold text-white/60 mb-2 ml-1">Jumlah Kuota</label>
                            <input type="number" name="kuota" placeholder="Contoh: 100" required
                                class="w-full bg-white/[0.03] border border-white/10 rounded-2xl px-6 py-4 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-all outline-none text-white">
                        </div>
                    </div>

                    {{-- Lokasi --}}
                    <div>
                        <label class="block text-sm font-bold text-white/60 mb-2 ml-1">Lokasi Event</label>
                        <input type="text" name="lokasi" placeholder="Contoh: Gedung H UNILA" required
                            class="w-full bg-white/[0.03] border border-white/10 rounded-2xl px-6 py-4 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-all outline-none text-white">
                    </div>

                    {{-- Tombol Simpan --}}
                    <div class="pt-6">
                        <button type="submit" 
                            class="w-full bg-purple-600 hover:bg-purple-500 text-white font-black py-4 rounded-2xl transition-all shadow-xl shadow-purple-900/40 active:scale-95">
                            SIMPAN EVENT SEKARANG
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>