<!DOCTYPE html>
<html lang="id" data-theme="night">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Event - E-TIXIS</title>

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
                Daftar Event Tersedia
            </h1>

            <p class="text-white/45 mt-3 text-lg">
                Pilih event yang ingin kamu ikuti dan pesan tiket secara online.
            </p>
        </div>

        <div class="flex gap-3">
            <a href="/tiket-saya"
               class="btn border border-purple-500/30 bg-purple-500/10 text-purple-300 hover:bg-purple-500/20">
                🎫 Tiket Saya
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
    @if($events->isEmpty())

        <div class="bg-[#18182c] border border-white/10 rounded-[2rem] p-12 text-center shadow-2xl">
            <div class="text-6xl mb-4">🎪</div>

            <h2 class="text-3xl font-bold">
                Belum ada event tersedia
            </h2>

            <p class="text-white/40 mt-3">
                Silakan cek kembali nanti ketika admin sudah menambahkan event.
            </p>
        </div>

    @else

        {{-- EVENT GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-7">

            @foreach($events as $event)

                <div class="group bg-[#18182c] border border-white/10 rounded-[2rem] overflow-hidden shadow-2xl hover:-translate-y-1 hover:border-purple-500/40 transition-all duration-300">

                    {{-- IMAGE --}}
                    <div class="relative h-52 bg-[#111126] overflow-hidden">

                        @if($event->gambar_event)
                            <img
                                src="{{ asset('storage/' . $event->gambar_event) }}"
                                alt="Gambar Event"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-purple-900/70 to-orange-900/50">
                                <div class="w-24 h-24 rounded-3xl bg-white/10 flex items-center justify-center text-5xl">
                                    🎪
                                </div>
                            </div>
                        @endif

                        <div class="absolute top-4 right-4">
                            @if($event->harga > 0)
                                <span class="badge badge-primary badge-lg font-bold">
                                    Rp {{ number_format($event->harga, 0, ',', '.') }}
                                </span>
                            @else
                                <span class="badge badge-success badge-lg font-bold">
                                    Gratis
                                </span>
                            @endif
                        </div>

                    </div>

                    {{-- BODY --}}
                    <div class="p-6">

                        <div class="mb-5">
                            <p class="text-sm text-purple-400 font-bold tracking-widest uppercase">
                                Event
                            </p>

                            <h2 class="text-2xl font-black mt-2 leading-tight">
                                {{ $event->nama_event }}
                            </h2>
                        </div>

                        <div class="space-y-3 text-white/55">

                            <div class="flex items-center gap-3">
                                <span>📅</span>
                                <span>
                                    {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}
                                </span>
                            </div>

                            <div class="flex items-start gap-3">
                                <span>📍</span>
                                <span>
                                    {{ $event->lokasi }}
                                </span>
                            </div>

                            <div class="flex items-center gap-3">
                                <span>🎟️</span>
                                <span>
                                    Sisa kuota:
                                    <strong class="text-emerald-400">
                                        {{ $event->kuota }}
                                    </strong>
                                </span>
                            </div>

                        </div>

                        <div class="mt-6">

                            @if($event->kuota > 0)
                                <a href="/pesan-tiket/{{ $event->id }}"
                                   class="btn w-full border-0 text-white font-bold"
                                   style="background: linear-gradient(135deg, #9333ea 0%, #a855f7 50%, #7e22ce 100%);">
                                    Pesan Tiket
                                </a>
                            @else
                                <button class="btn w-full btn-disabled">
                                    Kuota Habis
                                </button>
                            @endif

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @endif

</div>

</body>
</html>