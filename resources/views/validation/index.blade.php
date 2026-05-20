<!DOCTYPE html>
<html lang="id" data-theme="night">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Tiket - E-TIXIS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#0b0b18] text-white min-h-screen">

<div class="max-w-6xl mx-auto px-5 py-10">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">

        <div>
            <a href="/dashboard" class="inline-flex items-center gap-2 text-white/50 hover:text-purple-400 transition mb-5">
                <span>←</span>
                <span>Kembali ke Dashboard</span>
            </a>

            <h1 class="text-4xl md:text-5xl font-black">
                Validasi Tiket
            </h1>

            <p class="text-white/45 mt-3 text-lg">
                Masukkan kode tiket pengunjung untuk melakukan pengecekan status tiket.
            </p>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('tickets.scan') }}"
               class="btn border border-purple-500/30 bg-purple-500/10 text-purple-300 hover:bg-purple-500/20">
                📷 Scan QR Code
            </a>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

        {{-- FORM VALIDASI --}}
        <div class="bg-[#111126] border border-white/10 rounded-[2.5rem] shadow-2xl overflow-hidden relative">

            {{-- Dekorasi --}}
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-fuchsia-600/10 rounded-full blur-[80px]"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-purple-600/10 rounded-full blur-[80px]"></div>

            {{-- Header Card --}}
            <div class="relative p-8 border-b border-white/10"
                 style="background: linear-gradient(135deg, #2b135f 0%, #4c1d95 55%, #7c2d12 100%);">

                <div class="w-20 h-20 bg-white/10 border border-white/10 rounded-3xl mb-6 flex items-center justify-center shadow-2xl">
                    <span class="text-4xl">🔍</span>
                </div>

                <h2 class="text-3xl font-black">
                    Validasi Manual
                </h2>

                <p class="text-white/50 mt-3">
                    Gunakan fitur ini jika petugas ingin mengecek tiket menggunakan kode unik.
                </p>
            </div>

            <div class="relative p-8 lg:p-10">

                {{-- ALERT ERROR/SUCCESS --}}
                @if(session('error'))
                    <div class="alert alert-error mb-6">
                        <div>
                            <div class="font-bold">Validasi Gagal</div>
                            <div class="text-sm">{{ session('error') }}</div>
                        </div>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success mb-6">
                        <div>
                            <div class="font-bold">Validasi Berhasil</div>
                            <div class="text-sm">{{ session('success') }}</div>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error mb-6">
                        <div>
                            <div class="font-bold">Input tidak valid</div>

                            <ul class="list-disc list-inside text-sm mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form action="/validasi-tiket" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-xs font-black uppercase tracking-[0.2em] text-white/30 mb-3 ml-2">
                            Kode Tiket
                        </label>

                        <div class="relative">
                            <span class="absolute left-6 top-1/2 -translate-y-1/2 text-xl opacity-40">
                                🎫
                            </span>

                            <input
                                type="text"
                                name="kode_unik"
                                value="{{ old('kode_unik') }}"
                                placeholder="Contoh: ETX-ABC12345"
                                required
                                class="w-full bg-white/[0.03] border border-white/10 rounded-2xl pl-16 pr-6 py-4 focus:border-fuchsia-500 focus:ring-1 focus:ring-fuchsia-500 transition-all outline-none text-white text-center font-mono tracking-widest placeholder:text-white/15 uppercase"
                            >
                        </div>

                        <p class="text-xs text-white/30 mt-3 ml-2">
                            Kode tiket dapat dilihat pada halaman Tiket Saya milik pengguna.
                        </p>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500 text-white font-black py-5 rounded-2xl transition-all shadow-xl shadow-fuchsia-900/20 active:scale-95 tracking-wider"
                    >
                        VALIDASI TIKET SEKARANG
                    </button>
                </form>

            </div>

        </div>


        {{-- PANEL INFORMASI --}}
        <div class="space-y-6">

            <div class="bg-[#18182c] border border-white/10 rounded-[2rem] p-7 shadow-2xl">

                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-purple-500/20 border border-purple-500/20 flex items-center justify-center text-3xl">
                        ✅
                    </div>

                    <div>
                        <h3 class="text-2xl font-black">
                            Aturan Validasi
                        </h3>

                        <p class="text-white/40">
                            Sistem mengecek status tiket secara otomatis.
                        </p>
                    </div>
                </div>

                <div class="space-y-4">

                    <div class="rounded-2xl bg-white/[0.03] border border-white/5 p-5">
                        <p class="font-bold text-emerald-400">
                            Tiket Valid
                        </p>

                        <p class="text-sm text-white/45 mt-2">
                            Jika kode ditemukan dan status masih valid, sistem akan menerima tiket dan mengubah status menjadi used.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white/[0.03] border border-white/5 p-5">
                        <p class="font-bold text-red-400">
                            Tiket Sudah Digunakan
                        </p>

                        <p class="text-sm text-white/45 mt-2">
                            Jika status tiket sudah used, sistem akan menolak tiket agar tidak bisa dipakai dua kali.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white/[0.03] border border-white/5 p-5">
                        <p class="font-bold text-yellow-400">
                            Tiket Tidak Ditemukan
                        </p>

                        <p class="text-sm text-white/45 mt-2">
                            Jika kode tidak ada di database, tiket dianggap tidak valid atau palsu.
                        </p>
                    </div>

                </div>

            </div>

            <div class="bg-[#18182c] border border-white/10 rounded-[2rem] p-7 shadow-2xl">

                <h3 class="text-2xl font-black mb-3">
                    Gunakan QR Scanner
                </h3>

                <p class="text-white/45 mb-6">
                    Selain input manual, petugas juga dapat membuka halaman scan QR Code untuk validasi tiket.
                </p>

                <a href="{{ route('tickets.scan') }}"
                   class="btn w-full border-0 text-white font-bold"
                   style="background: linear-gradient(135deg, #9333ea 0%, #a855f7 50%, #7e22ce 100%);">
                    📷 Buka Scan QR Code
                </a>

            </div>

        </div>

    </div>

    <p class="text-center mt-10 text-white/10 text-[10px] font-bold uppercase tracking-[0.3em]">
        E-TIXIS Petugas System v1.0
    </p>

</div>

</body>
</html>