<!DOCTYPE html>
<html lang="id" data-theme="night">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Tiket - E-TIXIS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/scan-ticket.js'])
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
                Scan Tiket
            </h1>

            <p class="text-white/45 mt-3 text-lg">
                Arahkan kamera ke QR Code tiket pengguna untuk validasi otomatis.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            <a href="/validasi-tiket"
               class="btn border border-purple-500/30 bg-purple-500/10 text-purple-300 hover:bg-purple-500/20">
                Validasi Manual
            </a>

            <div class="badge badge-error badge-lg px-5 py-4 font-semibold">
                Petugas Validator
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

        {{-- KAMERA SCANNER --}}
        <div class="bg-[#111126] border border-white/10 rounded-[2.5rem] shadow-2xl overflow-hidden relative">

            {{-- Dekorasi --}}
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-cyan-600/10 rounded-full blur-[80px]"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-purple-600/10 rounded-full blur-[80px]"></div>

            {{-- Header Card --}}
            <div class="relative p-8 border-b border-white/10"
                 style="background: linear-gradient(135deg, #2b135f 0%, #5b21b6 55%, #155e75 100%);">

                <div class="w-20 h-20 bg-white/10 border border-white/10 rounded-3xl mb-6 flex items-center justify-center shadow-2xl">
                    <span class="text-4xl">📷</span>
                </div>

                <h2 class="text-3xl font-black">
                    Kamera Scanner
                </h2>

                <p class="text-white/60 mt-3 leading-relaxed">
                    Aktifkan kamera perangkat, lalu arahkan ke QR Code tiket pengguna.
                </p>
            </div>

            {{-- Area Kamera --}}
            <div class="relative p-8 lg:p-10">

                <div class="bg-white rounded-[2rem] overflow-hidden p-3 shadow-xl">
                    <div id="reader" class="w-full min-h-[300px] rounded-[1.5rem] overflow-hidden"></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                    <button
                        id="startScanBtn"
                        class="btn border-0 text-white font-bold"
                        style="background: linear-gradient(135deg, #16a34a 0%, #0d9488 50%, #0891b2 100%);"
                    >
                        Mulai Scan
                    </button>

                    <button
                        id="stopScanBtn"
                        class="btn border-0 text-white font-bold disabled:opacity-40 disabled:cursor-not-allowed"
                        style="background: linear-gradient(135deg, #dc2626 0%, #e11d48 50%, #9f1239 100%);"
                        disabled
                    >
                        Berhenti Scan
                    </button>
                </div>

                <div class="mt-5 rounded-2xl bg-white/[0.03] border border-white/10 p-4">
                    <p id="cameraStatus" class="text-sm text-white/45">
                        Kamera belum aktif.
                    </p>
                </div>

                <p class="text-xs text-white/30 mt-4 ml-2">
                    QR Code yang berhasil discan akan langsung divalidasi oleh sistem.
                </p>

            </div>

        </div>

        {{-- PANEL KANAN --}}
        <div class="space-y-6">

            {{-- HASIL VALIDASI --}}
            <div class="bg-[#18182c] border border-white/10 rounded-[2rem] p-7 shadow-2xl">

                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-purple-500/20 border border-purple-500/20 flex items-center justify-center text-3xl">
                        ✅
                    </div>

                    <div>
                        <h3 class="text-2xl font-black">
                            Hasil Validasi
                        </h3>

                        <p class="text-white/40">
                            Hasil pembacaan QR Code akan muncul di sini.
                        </p>
                    </div>
                </div>

                <div id="resultBox" class="rounded-2xl bg-white/[0.03] border border-white/5 p-5">
                    <div class="flex items-start gap-4">
                        <div class="text-2xl">🔍</div>

                        <div>
                            <p class="font-bold text-white">
                                Belum Ada Tiket Discan
                            </p>

                            <p class="text-sm text-white/45 mt-2">
                                Klik tombol mulai scan, lalu arahkan kamera ke QR Code tiket pengguna.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ATURAN SCAN --}}
            <div class="bg-[#18182c] border border-white/10 rounded-[2rem] p-7 shadow-2xl">

                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-cyan-500/20 border border-cyan-500/20 flex items-center justify-center text-3xl">
                        📌
                    </div>

                    <div>
                        <h3 class="text-2xl font-black">
                            Aturan Scan QR
                        </h3>

                        <p class="text-white/40">
                            Sistem mengecek status tiket secara otomatis.
                        </p>
                    </div>
                </div>

                <div class="space-y-4">

                    <div class="rounded-2xl bg-white/[0.03] border border-white/5 p-5">
                        <p class="font-bold text-emerald-400">
                            QR Valid
                        </p>

                        <p class="text-sm text-white/45 mt-2">
                            Jika QR Code sesuai dan status masih valid, sistem menerima tiket dan mengubah status menjadi used.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white/[0.03] border border-white/5 p-5">
                        <p class="font-bold text-red-400">
                            QR Sudah Digunakan
                        </p>

                        <p class="text-sm text-white/45 mt-2">
                            Jika tiket sudah digunakan sebelumnya, sistem akan menolak tiket agar tidak bisa dipakai dua kali.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white/[0.03] border border-white/5 p-5">
                        <p class="font-bold text-yellow-400">
                            QR Tidak Terdaftar
                        </p>

                        <p class="text-sm text-white/45 mt-2">
                            Jika kode hasil scan tidak ditemukan di database, tiket dianggap tidak valid atau palsu.
                        </p>
                    </div>

                </div>

            </div>

            {{-- LINK MANUAL --}}
            <div class="bg-[#18182c] border border-white/10 rounded-[2rem] p-7 shadow-2xl">

                <h3 class="text-2xl font-black mb-3">
                    Kamera Bermasalah?
                </h3>

                <p class="text-white/45 mb-6">
                    Jika kamera tidak bisa dibuka atau QR sulit terbaca, petugas tetap bisa menggunakan validasi manual.
                </p>

                <a href="/validasi-tiket"
                   class="btn w-full border-0 text-white font-bold"
                   style="background: linear-gradient(135deg, #9333ea 0%, #a855f7 50%, #7e22ce 100%);">
                    Buka Validasi Manual
                </a>

            </div>

        </div>

    </div>

    <p class="text-center mt-10 text-white/10 text-[10px] font-bold uppercase tracking-[0.3em]">
        E-TIXIS Petugas System v1.0
    </p>

</div>

<script>
    window.scanTicketUrl = "{{ route('tickets.scan.check') }}";
    window.csrfToken = "{{ csrf_token() }}";
</script>

</body>
</html>