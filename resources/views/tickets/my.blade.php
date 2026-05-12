<!DOCTYPE html>
<html lang="id" data-theme="night">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Saya - E-TIXIS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#0b0b18] text-white">

    <div class="max-w-6xl mx-auto px-4 py-10">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

            <div>
                <a href="/dashboard" class="btn btn-ghost btn-sm mb-4">
                    ← Kembali ke Beranda
                </a>
 
                <h1 class="text-3xl md:text-4xl font-bold">
                    Tiket Saya
                </h1>

                <p class="text-white/40 mt-2">
                    Daftar tiket yang sudah kamu pesan beserta QR Code untuk validasi.
                </p>
            </div>

            <div class="badge badge-primary badge-lg">
                E-TIXIS Ticket
            </div>
        </div>

        {{-- ALERT JIKA TIDAK ADA TIKET --}}
        @if($orders->isEmpty())
            <div class="card bg-[#18182c] border border-white/10 shadow-xl">
                <div class="card-body text-center">
                    <div class="text-5xl mb-3">🎫</div>

                    <h2 class="text-2xl font-bold">
                        Kamu belum punya tiket
                    </h2>

                    <p class="text-white/40 mt-2">
                        Silakan pilih event terlebih dahulu dan lakukan pemesanan tiket.
                    </p>

                    <div class="mt-6">
                        <a href="/daftar-event" class="btn btn-primary">
                            Lihat Event
                        </a>
                    </div>
                </div>
            </div>
        @endif

        {{-- LIST TIKET --}}
        <div class="space-y-8">

            @foreach($orders as $order)

                <div class="card bg-[#18182c] border border-white/10 shadow-xl overflow-hidden">

                    {{-- EVENT HEADER --}}
                    <div class="p-6 border-b border-white/10"
                         style="background: linear-gradient(135deg, #2b135f 0%, #4c1d95 55%, #7c2d12 100%);">

                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                            <div>
                                <p class="text-sm text-white/50 mb-1">
                                    Event
                                </p>

                                <h2 class="text-2xl font-bold">
                                    {{ $order->event->nama_event }}
                                </h2>

                                <div class="flex flex-wrap gap-3 mt-3 text-sm text-white/60">
                                    <span>📅 {{ $order->event->tanggal }}</span>
                                    <span>📍 {{ $order->event->lokasi }}</span>
                                </div>
                            </div>

                            <div>
                                <div class="badge badge-outline border-white/40 text-white px-5 py-4">
                                    {{ $order->tickets->count() }} Tiket
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- TICKET BODY --}}
                    <div class="card-body">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            @foreach($order->tickets as $ticket)

                                <div class="rounded-2xl bg-[#111126] border border-white/10 p-5">

                                    <div class="flex flex-col lg:flex-row gap-5 items-center lg:items-start">

                                        {{-- QR CODE --}}
                                        <div class="bg-white p-4 rounded-2xl shadow-lg">
                                            {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(170)->generate($ticket->kode_unik) !!}
                                        </div>

                                        {{-- DETAIL TIKET --}}
                                        <div class="flex-1 text-center lg:text-left">

                                            <p class="text-sm text-white/40 mb-1">
                                                Kode Tiket
                                            </p>

                                            <h3 class="text-xl font-bold tracking-widest break-all">
                                                {{ $ticket->kode_unik }}
                                            </h3>

                                            <div class="mt-4">
                                                @if($ticket->status_tiket == 'valid')
                                                    <span class="badge badge-success badge-lg">
                                                        VALID
                                                    </span>
                                                @else
                                                    <span class="badge badge-error badge-lg">
                                                        USED
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="divider my-4"></div>

                                            <p class="text-sm text-white/40">
                                                Tunjukkan QR Code ini kepada petugas saat masuk ke acara.
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

    </div>

</body>
</html>