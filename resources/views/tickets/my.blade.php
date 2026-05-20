<!DOCTYPE html>
<html lang="id" data-theme="night">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Saya - E-TIXIS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#0b0b18] text-white">

<div class="max-w-7xl mx-auto px-5 py-10">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">

        <div>
            <a href="/dashboard" class="inline-flex items-center gap-2 text-white/50 hover:text-purple-400 transition mb-5">
                <span>←</span>
                <span>Kembali ke Dashboard</span>
            </a>

            <h1 class="text-4xl md:text-5xl font-black">
                Tiket Saya
            </h1>

            <p class="text-white/45 mt-3 text-lg">
                Lihat tiket yang sudah kamu pesan beserta QR Code untuk validasi.
            </p>
        </div>

        <div class="flex gap-3">
            <a href="/daftar-event"
               class="btn border border-purple-500/30 bg-purple-500/10 text-purple-300 hover:bg-purple-500/20">
                🎪 Lihat Event
            </a>
        </div>

    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success mb-6">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error mb-6">
            <span>{{ session('error') }}</span>
        </div>
    @endif


    {{-- EMPTY STATE --}}
    @if($orders->isEmpty())

        <div class="bg-[#18182c] border border-white/10 rounded-[2rem] p-12 text-center shadow-2xl">

            <div class="text-6xl mb-4">🎫</div>

            <h2 class="text-3xl font-bold">
                Kamu belum punya tiket
            </h2>

            <p class="text-white/40 mt-3">
                Silakan pesan tiket event terlebih dahulu.
            </p>

            <a href="/daftar-event"
               class="btn mt-6 border-0 text-white font-bold"
               style="background: linear-gradient(135deg, #9333ea 0%, #a855f7 50%, #7e22ce 100%);">
                Lihat Event
            </a>

        </div>

    @else

        <div class="space-y-10">

            @foreach($orders as $order)

                @php
                    $event = $order->event;
                    $jumlahTiket = $order->tickets->count();
                    $hargaTiket = $event->harga ?? 0;
                    $totalHarga = $hargaTiket * $jumlahTiket;
                @endphp

                <div class="bg-[#18182c] border border-white/10 rounded-[2rem] overflow-hidden shadow-2xl">

                    {{-- EVENT HEADER --}}
                    <div class="relative overflow-hidden p-7 md:p-8"
                         style="background: linear-gradient(135deg, #2b135f 0%, #4c1d95 55%, #7c2d12 100%);">

                        <div class="absolute -right-10 -top-10 w-48 h-48 rounded-full bg-white/5"></div>
                        <div class="absolute right-20 top-10 w-32 h-32 rounded-full bg-white/5"></div>

                        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                            <div class="flex flex-col md:flex-row gap-5 md:items-center">

                                {{-- IMAGE --}}
                                <div class="w-full md:w-28 h-28 rounded-3xl overflow-hidden bg-white/10 border border-white/10 shrink-0">

                                    @if($event->gambar_event)
                                        <img
                                            src="{{ asset('storage/' . $event->gambar_event) }}"
                                            alt="Gambar Event"
                                            class="w-full h-full object-cover bg-white"
                                        >
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-5xl bg-white/10">
                                            🎪
                                        </div>
                                    @endif

                                </div>

                                {{-- EVENT INFO --}}
                                <div>
                                    <p class="text-sm text-white/50 mb-1">
                                        Event
                                    </p>

                                    <h2 class="text-3xl font-black leading-tight">
                                        {{ $event->nama_event }}
                                    </h2>

                                    <div class="flex flex-wrap gap-4 mt-4 text-sm text-white/65">
                                        <span>📅 {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}</span>
                                        <span>📍 {{ $event->lokasi }}</span>
                                    </div>
                                </div>

                            </div>

                            {{-- SUMMARY --}}
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">

                                <div class="rounded-2xl bg-white/10 border border-white/10 px-5 py-4 text-center">
                                    <p class="text-xs text-white/45 mb-1">Jumlah</p>
                                    <p class="text-lg font-black">{{ $jumlahTiket }} Tiket</p>
                                </div>

                                <div class="rounded-2xl bg-white/10 border border-white/10 px-5 py-4 text-center">
                                    <p class="text-xs text-white/45 mb-1">Harga</p>

                                    @if($hargaTiket > 0)
                                        <p class="text-lg font-black">
                                            Rp {{ number_format($hargaTiket, 0, ',', '.') }}
                                        </p>
                                    @else
                                        <p class="text-lg font-black text-emerald-400">
                                            Gratis
                                        </p>
                                    @endif
                                </div>

                                <div class="rounded-2xl bg-white/10 border border-white/10 px-5 py-4 text-center col-span-2 md:col-span-1">
                                    <p class="text-xs text-white/45 mb-1">Total</p>

                                    @if($totalHarga > 0)
                                        <p class="text-lg font-black text-purple-200">
                                            Rp {{ number_format($totalHarga, 0, ',', '.') }}
                                        </p>
                                    @else
                                        <p class="text-lg font-black text-emerald-400">
                                            Gratis
                                        </p>
                                    @endif
                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- TICKET BODY --}}
                    <div class="p-6 md:p-8">

                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                            @foreach($order->tickets as $ticket)

                                @php
                                    $status = strtolower($ticket->status_tiket);
                                    $qrId = 'qr-ticket-' . $ticket->id;
                                @endphp

                                <div class="rounded-[1.5rem] bg-[#111126] border border-white/10 p-5 hover:border-purple-500/30 transition">

                                    <div class="flex flex-col md:flex-row gap-5">

                                        {{-- QR CODE --}}
                                        <div class="shrink-0 flex flex-col items-center gap-3">

                                            <div id="{{ $qrId }}"
                                                 class="qr-wrapper bg-white p-4 rounded-2xl shadow-lg">
                                                {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(180)->generate($ticket->kode_unik) !!}
                                            </div>

                                            <button
                                                type="button"
                                                class="download-qr-btn btn btn-sm border border-purple-500/30 bg-purple-500/10 text-purple-300 hover:bg-purple-500/20 w-full"
                                                data-qr-id="{{ $qrId }}"
                                                data-code="{{ $ticket->kode_unik }}"
                                            >
                                                ⬇ Unduh QR
                                            </button>

                                        </div>

                                        {{-- DETAIL --}}
                                        <div class="flex-1 min-w-0">

                                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">

                                                <div>
                                                    <p class="text-sm text-white/40">
                                                        Kode Tiket
                                                    </p>

                                                    <h3 class="text-xl md:text-2xl font-black tracking-widest break-all mt-1">
                                                        {{ $ticket->kode_unik }}
                                                    </h3>
                                                </div>

                                                <div>
                                                    @if($status == 'valid')
                                                        <span class="badge badge-success badge-lg font-bold">
                                                            VALID
                                                        </span>
                                                    @else
                                                        <span class="badge badge-error badge-lg font-bold">
                                                            USED
                                                        </span>
                                                    @endif
                                                </div>

                                            </div>

                                            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-3">

                                                <div class="rounded-2xl bg-white/[0.03] border border-white/5 p-4">
                                                    <p class="text-xs text-white/35 mb-1">Status</p>

                                                    @if($status == 'valid')
                                                        <p class="font-bold text-emerald-400">
                                                            Siap digunakan
                                                        </p>
                                                    @else
                                                        <p class="font-bold text-red-400">
                                                            Sudah digunakan
                                                        </p>
                                                    @endif
                                                </div>

                                                <div class="rounded-2xl bg-white/[0.03] border border-white/5 p-4">
                                                    <p class="text-xs text-white/35 mb-1">Validasi</p>
                                                    <p class="font-bold text-white/70">
                                                        QR / Kode Unik
                                                    </p>
                                                </div>

                                            </div>

                                            <p class="text-sm text-white/40 mt-5 leading-relaxed">
                                                Tunjukkan QR Code ini kepada petugas saat masuk ke acara.
                                                Tiket hanya dapat digunakan satu kali.
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @endif

</div>


<script>
    document.querySelectorAll('.download-qr-btn').forEach((button) => {
        button.addEventListener('click', function () {
            const qrId = this.dataset.qrId;
            const code = this.dataset.code;
            const qrContainer = document.getElementById(qrId);
            const svg = qrContainer.querySelector('svg');

            if (!svg) {
                alert('QR Code tidak ditemukan.');
                return;
            }

            const serializer = new XMLSerializer();
            let svgString = serializer.serializeToString(svg);

            if (!svgString.includes('xmlns="http://www.w3.org/2000/svg"')) {
                svgString = svgString.replace('<svg', '<svg xmlns="http://www.w3.org/2000/svg"');
            }

            const svgBlob = new Blob([svgString], {
                type: 'image/svg+xml;charset=utf-8'
            });

            const url = URL.createObjectURL(svgBlob);
            const image = new Image();

            image.onload = function () {
                const canvas = document.createElement('canvas');
                const size = 500;

                canvas.width = size;
                canvas.height = size;

                const context = canvas.getContext('2d');

                // background putih
                context.fillStyle = '#ffffff';
                context.fillRect(0, 0, size, size);

                // gambar QR di tengah
                context.drawImage(image, 40, 40, 420, 420);

                URL.revokeObjectURL(url);

                const pngUrl = canvas.toDataURL('image/png');

                const link = document.createElement('a');
                link.href = pngUrl;
                link.download = `QR-${code}.png`;

                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            };

            image.src = url;
        });
    });
</script>

</body>
</html>