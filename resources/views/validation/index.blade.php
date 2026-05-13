<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Tiket - E-TIXIS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0b0b18] text-white min-h-screen flex items-center justify-center p-6">

    <div class="max-w-md w-full">
        {{-- Tombol Kembali --}}
        <a href="/dashboard" class="text-white/50 hover:text-white transition flex items-center gap-2 mb-8 group">
            <span class="group-hover:-translate-x-1 transition-transform">←</span> Kembali ke Dashboard
        </a>

        <div class="bg-[#111126] border border-white/10 rounded-[2.5rem] p-8 lg:p-10 shadow-2xl relative overflow-hidden">
            {{-- Dekorasi Latar Belakang --}}
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-fuchsia-600/10 rounded-full blur-[80px]"></div>

            <div class="relative text-center">
                {{-- Icon --}}
                <div class="w-20 h-20 bg-gradient-to-br from-fuchsia-500 to-purple-600 rounded-3xl mb-6 mx-auto flex items-center justify-center shadow-2xl shadow-fuchsia-900/20">
                    <span class="text-4xl">🔍</span>
                </div>

                <h1 class="text-3xl font-black mb-2">Validasi Tiket</h1>
                <p class="text-white/40 mb-8">Masukkan kode tiket pelanggan untuk melakukan verifikasi data.</p>

                {{-- Notifikasi Error/Sukses --}}
                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-2xl text-red-400 text-sm font-bold">
                        ⚠️ {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl text-emerald-400 text-sm font-bold">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <form action="/validasi-tiket" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="text-left">
                        <label class="block text-xs font-black uppercase tracking-widest text-white/30 mb-3 ml-2">Kode Tiket</label>
                        <input type="text" name="ticket_code" placeholder="Contoh: ETX-ABC12345" required
                            class="w-full bg-white/[0.03] border border-white/10 rounded-2xl px-6 py-4 focus:border-fuchsia-500 focus:ring-1 focus:ring-fuchsia-500 transition-all outline-none text-white text-center font-mono tracking-widest placeholder:text-white/10">
                    </div>

                    <button type="submit" 
                        class="w-full bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-500 hover:to-purple-500 text-white font-black py-4 rounded-2xl transition-all shadow-xl shadow-fuchsia-900/20 active:scale-95">
                        VALIDASI TIKET SEKARANG
                    </button>
                </form>

                {{-- Opsi Scan QR (Opsional jika kamu ingin menambahkan fitur scan nanti) --}}
                <div class="mt-8 pt-8 border-t border-white/5">
                    <p class="text-xs text-white/20 mb-4 font-bold uppercase tracking-widest">Atau Gunakan Kamera</p>
                    <a href="{{ route('tickets.scan') }}" class="flex items-center justify-center gap-3 text-sm font-bold text-fuchsia-400 hover:text-fuchsia-300 transition group">
                        <span class="text-xl">📷</span> Scan QR Code
                    </a>
                </div>
            </div>
        </div>
        
        <p class="text-center mt-8 text-white/10 text-[10px] font-bold uppercase tracking-[0.3em]">
            E-TIXIS Petugas System v1.0
        </p>
    </div>

</body>
</html>