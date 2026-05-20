<!DOCTYPE html>
<html lang="id" data-theme="night">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Tiket - E-TIXIS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#0b0b18] text-white min-h-screen p-6 lg:p-12">

    <div class="max-w-2xl mx-auto">

        {{-- Tombol Kembali --}}
        <a href="/daftar-event" class="text-white/50 hover:text-white transition flex items-center gap-2 mb-8 group">
            <span class="group-hover:-translate-x-1 transition-transform">←</span>
            Kembali ke Daftar Event
        </a>

        <div class="bg-[#111126] border border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl relative">

            {{-- Dekorasi Latar Belakang --}}
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-purple-600/10 rounded-full blur-[80px]"></div>

            {{-- Header Visual --}}
            <div class="h-32 bg-gradient-to-r from-purple-600 to-fuchsia-600 p-8 flex items-end">
                <h1 class="text-3xl font-black text-white">
                    Konfirmasi Pemesanan
                </h1>
            </div>

            <div class="p-8 lg:p-10 relative">

                {{-- Alert Error --}}
                @if(session('error'))
                    <div class="alert alert-error mb-6">
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error mb-6">
                        <div>
                            <h3 class="font-bold">Terjadi kesalahan input</h3>
                            <ul class="list-disc list-inside text-sm mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                {{-- Detail Event --}}
                <div class="mb-8 bg-white/[0.02] border border-white/5 rounded-3xl p-6">

                    <div class="flex flex-col md:flex-row gap-5">

                        {{-- Gambar Event --}}
                        <div class="w-full md:w-32 h-32 rounded-2xl overflow-hidden bg-[#18182c] border border-white/10 shrink-0">

                            @if($event->gambar_event)
                                <img
                                    src="{{ asset('storage/' . $event->gambar_event) }}"
                                    alt="Gambar Event"
                                    class="w-full h-full object-cover bg-white"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-purple-900/70 to-orange-900/50 text-5xl">
                                    🎪
                                </div>
                            @endif

                        </div>

                        {{-- Info Event --}}
                        <div class="flex-1">

                            <h2 class="text-2xl font-bold text-purple-400 mb-4">
                                {{ $event->nama_event }}
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                <div class="flex items-center gap-3 text-white/60">
                                    <span class="text-xl">📅</span>
                                    <span class="text-sm font-medium">
                                        {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-3 text-white/60">
                                    <span class="text-xl">📍</span>
                                    <span class="text-sm font-medium">
                                        {{ $event->lokasi }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-3 text-emerald-400/80">
                                    <span class="text-xl">👥</span>
                                    <span class="text-sm font-bold">
                                        Kuota Tersedia: {{ $event->kuota }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-3 text-purple-300">
                                    <span class="text-xl">💳</span>

                                    @if($event->harga > 0)
                                        <span class="text-sm font-bold">
                                            Harga: Rp {{ number_format($event->harga, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-sm font-bold text-emerald-400">
                                            Harga: Gratis
                                        </span>
                                    @endif
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- Form Pemesanan --}}
                <form action="/pesan-tiket/{{ $event->id }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-xs font-black uppercase tracking-[0.2em] text-white/30 mb-3 ml-2">
                            Jumlah Tiket
                        </label>

                        <div class="relative">
                            <span class="absolute left-6 top-1/2 -translate-y-1/2 text-xl opacity-40">
                                🎟️
                            </span>

                            <input
                                type="number"
                                id="jumlahTiket"
                                name="jumlah_tiket"
                                min="1"
                                max="{{ $event->kuota }}"
                                value="1"
                                required
                                class="w-full bg-white/[0.03] border border-white/10 rounded-2xl pl-16 pr-6 py-4 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-all outline-none text-white font-bold"
                            >
                        </div>

                        <p class="text-[10px] text-white/20 mt-3 ml-2 italic">
                            *Maksimal pembelian sesuai sisa kuota yang tersedia.
                        </p>
                    </div>

                    {{-- Ringkasan Pembayaran --}}
                    <div class="bg-white/[0.02] border border-white/5 rounded-3xl p-6 space-y-4">

                        <div class="flex items-center justify-between text-white/60">
                            <span>Harga Tiket</span>

                            @if($event->harga > 0)
                                <span class="font-bold text-white">
                                    Rp {{ number_format($event->harga, 0, ',', '.') }}
                                </span>
                            @else
                                <span class="font-bold text-emerald-400">
                                    Gratis
                                </span>
                            @endif
                        </div>

                        <div class="flex items-center justify-between text-white/60">
                            <span>Jumlah Tiket</span>
                            <span class="font-bold text-white" id="jumlahRingkasan">1 tiket</span>
                        </div>

                        <div class="border-t border-white/10 pt-4 flex items-center justify-between">
                            <span class="text-white font-black">
                                Total Estimasi
                            </span>

                            <span class="text-2xl font-black text-purple-400" id="totalHarga">
                                @if($event->harga > 0)
                                    Rp {{ number_format($event->harga, 0, ',', '.') }}
                                @else
                                    Gratis
                                @endif
                            </span>
                        </div>

                        <p class="text-xs text-white/30 italic">
                            Pembayaran belum diaktifkan. Total ini masih berupa estimasi harga pesanan.
                        </p>

                    </div>

                    <button
                        type="submit"
                        class="w-full bg-purple-600 hover:bg-purple-500 text-white font-black py-5 rounded-2xl transition-all shadow-xl shadow-purple-900/40 active:scale-95 text-lg tracking-wider"
                    >
                        KONFIRMASI PESANAN
                    </button>
                </form>

            </div>
        </div>

        {{-- Footer Info --}}
        <div class="mt-8 flex items-center justify-center gap-4 opacity-20">
            <div class="h-[1px] flex-1 bg-white"></div>
            <p class="text-[10px] font-black uppercase tracking-widest">
                E-TIXIS Secure Checkout
            </p>
            <div class="h-[1px] flex-1 bg-white"></div>
        </div>

    </div>

    <script>
        const hargaTiket = {{ $event->harga ?? 0 }};
        const jumlahInput = document.getElementById('jumlahTiket');
        const jumlahRingkasan = document.getElementById('jumlahRingkasan');
        const totalHarga = document.getElementById('totalHarga');

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(angka);
        }

        function updateTotal() {
            const jumlah = parseInt(jumlahInput.value) || 1;
            const total = hargaTiket * jumlah;

            jumlahRingkasan.textContent = jumlah + ' tiket';

            if (hargaTiket > 0) {
                totalHarga.textContent = formatRupiah(total);
            } else {
                totalHarga.textContent = 'Gratis';
            }
        }

        jumlahInput.addEventListener('input', updateTotal);
        updateTotal();
    </script>

</body>
</html>