<!DOCTYPE html>
<html lang="id" data-theme="night">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Tiket - E-TIXIS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/scan-ticket.js'])
</head>

<body class="min-h-screen bg-[#0b0b18] text-white">

    <div class="max-w-6xl mx-auto px-4 py-10">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <a href="/dashboard" class="btn btn-ghost btn-sm mb-4">
                    ← Kembali ke Beranda
                </a>

                <h1 class="text-3xl md:text-4xl font-bold">
                    Scan Tiket
                </h1>

                <p class="text-white/40 mt-2">
                    Arahkan kamera ke QR Code tiket pengguna untuk validasi otomatis.
                </p>
            </div>

            <div class="badge badge-error badge-lg">
                Petugas Validator
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="card bg-[#18182c] border border-white/10 shadow-xl">
                <div class="card-body">

                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="card-title">Kamera Scanner</h2>
                            <p class="text-sm text-white/40 mt-1">
                                Izinkan akses kamera pada browser.
                            </p>
                        </div>

                        <div class="text-3xl">📷</div>
                    </div>

                    <div class="bg-white rounded-2xl overflow-hidden p-2">
    <div id="reader" class="w-full min-h-[300px]"></div>
</div>

<div class="flex gap-3 mt-4">
    <button id="startScanBtn" class="btn btn-primary">
        Mulai Scan
    </button>

    <button id="stopScanBtn" class="btn btn-error" disabled>
        Berhenti Scan
    </button>
</div>

<p id="cameraStatus" class="text-sm text-white/40 mt-3">
    Kamera belum aktif.
</p>
                    <p class="text-sm text-white/35 mt-4">
                        QR Code yang berhasil discan akan langsung divalidasi oleh sistem.
                    </p>

                </div>
            </div>

            <div class="card bg-[#18182c] border border-white/10 shadow-xl">
                <div class="card-body">

                    <h2 class="card-title">Hasil Validasi</h2>

                    <div id="resultBox" class="alert bg-[#111126] border border-white/10 text-white">
                        <span>Belum ada tiket yang discan.</span>
                    </div>

                    <div class="divider">Fallback Manual</div>

                    <form id="manualForm">
                        @csrf

                        <label class="label">
                            <span class="label-text text-white/70">Kode Tiket</span>
                        </label>

                        <input
                            type="text"
                            id="manualCode"
                            class="input input-bordered w-full bg-[#111126] border-white/10"
                            placeholder="Contoh: ETX-0VDQ2WUH"
                        >

                        <button type="submit" class="btn btn-primary w-full mt-4">
                            Validasi Manual
                        </button>
                    </form>

                    <div class="mt-6 space-y-3 text-sm text-white/40">
                        <p>✅ Jika tiket valid, status akan berubah menjadi used.</p>
                        <p>❌ Jika tiket sudah digunakan, sistem akan menolak.</p>
                        <p>⚠️ Jika kode tidak ditemukan, tiket dianggap tidak valid.</p>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <script>
        window.scanTicketUrl = "{{ route('tickets.scan.check') }}";
        window.csrfToken = "{{ csrf_token() }}";
    </script>

</body>
</html>