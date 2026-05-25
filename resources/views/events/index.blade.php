<!DOCTYPE html>
<html lang="id" data-theme="night">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Event - E-TIXIS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#0b0b18] text-white">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-[#111126] border-r border-white/10 hidden lg:flex flex-col shrink-0">

        {{-- LOGO --}}
    <div class="p-7">

        <a href="/dashboard"
        class="block w-full h-24 rounded-3xl bg-[#18182c] border border-white/10 shadow-lg overflow-hidden">

            <img 
                src="{{ asset('images/logo-icon-etixis.png') }}" 
                alt="Logo E-TIXIS"
                class="w-full h-full object-contain scale-150"
            >

        </a>

    </div>

        <div class="px-6 mt-8">
            <p class="text-xs uppercase tracking-[0.3em] text-white/35 mb-5">
                Menu Utama
            </p>

            <nav class="space-y-3">

                <a href="/dashboard"
                   class="flex items-center gap-4 px-5 py-4 rounded-2xl text-white/55 hover:bg-white/10 hover:text-white transition">
                    <span class="text-2xl">🏠</span>
                    <span class="font-semibold">Dashboard</span>
                </a>

                <a href="/events"
                   class="flex items-center gap-4 px-5 py-4 rounded-2xl bg-purple-700/30 border border-purple-500/30 text-purple-300">
                    <span class="text-2xl">🎪</span>
                    <span class="font-semibold">Daftar Event</span>
                </a>

                <a href="/events/create"
                   class="flex items-center gap-4 px-5 py-4 rounded-2xl text-white/55 hover:bg-white/10 hover:text-white transition">
                    <span class="text-2xl">➕</span>
                    <span class="font-semibold leading-tight">Tambah Event Baru</span>
                </a>

            </nav>
        </div>

        <div class="mt-auto border-t border-white/10 p-8">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="flex items-center gap-4 text-red-400 hover:text-red-300 transition font-semibold">
                    <span>🚪</span>
                    <span>Keluar</span>
                </button>
            </form>
        </div>

    </aside>

    {{-- MAIN CONTENT --}}
  <main class="flex-1 px-5 py-10 lg:px-8 overflow-hidden">

        {{-- TOP HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">

            <div>
                <h1 class="text-4xl md:text-5xl font-black">
                    Event Tersedia
                </h1>

                <p class="text-white/45 mt-3 text-lg">
                    <span class="text-purple-400">•</span>
                    Jelajahi dan kelola data event kamu dengan mudah
                </p>
            </div>

            <div class="bg-[#18182c] border border-white/10 rounded-2xl px-6 py-4 flex items-center gap-4 shadow-xl">

                <div>
                    <p class="text-sm text-white/35">
                        Masuk sebagai
                    </p>

                    <p class="font-bold">
                        {{ Auth::user()->name }}
                    </p>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-purple-600 flex items-center justify-center text-white font-black text-2xl shrink-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

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

        {{-- CARD TABLE --}}
        <div class="bg-[#18182c] border border-white/10 rounded-[2rem] shadow-2xl overflow-hidden">

            <div class="px-8 py-7 border-b border-white/10">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div class="flex items-center gap-4">
                        <div class="w-2 h-10 rounded-full bg-purple-500"></div>

                        <div>
                            <h2 class="text-2xl font-black">
                                Data Manajemen Event
                            </h2>

                            <p class="text-white/40 mt-1">
                                Total event: {{ $events->count() }}
                            </p>
                        </div>
                    </div>

                    <a href="/events/create"
                       class="btn border-0 text-white font-bold whitespace-nowrap"
                       style="background: linear-gradient(135deg, #9333ea 0%, #a855f7 50%, #7e22ce 100%);">
                        + Tambah Event
                    </a>

                </div>
            </div>

            @if($events->isEmpty())

                <div class="p-12 text-center">

                    <div class="text-6xl mb-4">🎪</div>

                    <h3 class="text-2xl font-bold">
                        Belum ada event
                    </h3>

                    <p class="text-white/40 mt-2">
                        Silakan tambahkan event baru terlebih dahulu.
                    </p>

                    <a href="/events/create" class="btn btn-primary mt-6">
                        Tambah Event
                    </a>

                </div>

            @else

                <div class="overflow-x-auto">

                    <table class="w-full min-w-[880px]">

                        <thead>
                            <tr class="bg-[#141426] border-b border-white/10 text-white/40 uppercase tracking-[0.25em] text-xs">
                                <th class="px-5 py-5 text-left w-[70px]">No</th>
                                <th class="px-5 py-5 text-left w-[330px]">Detail Event</th>
                                <th class="px-5 py-5 text-left w-[180px]">Lokasi</th>
                                <th class="px-5 py-5 text-left w-[140px]">Harga</th>
                                <th class="px-5 py-5 text-left w-[130px]">Kuota</th>
                                <th class="px-5 py-5 text-center w-[130px]">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($events as $event)

                                <tr class="border-b border-white/10 hover:bg-white/[0.03] transition">

                                    {{-- NO --}}
                                    <td class="px-5 py-5 text-white/35 font-bold align-middle">
                                        #{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </td>

                                    {{-- DETAIL EVENT --}}
                                    <td class="px-5 py-5 align-middle">

                                        <div class="flex items-center gap-4 min-w-0">

                                            @if($event->gambar_event)
                                                <img
                                                    src="{{ asset('storage/' . $event->gambar_event) }}"
                                                    alt="Gambar Event"
                                                   class="w-14 h-14 rounded-xl object-cover border border-white/10 bg-white shrink-0"
                                                >
                                            @else
                                                <div class="w-14 h-14 rounded-xl bg-purple-500/20 border border-purple-500/20 flex items-center justify-center text-2xl shrink-0">
                                                    🎪
                                                </div>
                                            @endif

                                            <div class="min-w-0">
                                                <h3 class="text-lg font-black text-white leading-tight">
                                                    {{ $event->nama_event }}
                                                </h3>

                                                <p class="text-sm text-white/40 mt-1 whitespace-nowrap">
                                                    📅 {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}
                                                </p>

                                                @if($event->gambar_event)
                                                    <p class="text-xs text-purple-400 mt-1 font-bold">
                                                        Gambar tersedia
                                                    </p>
                                                @else
                                                    <p class="text-xs text-white/35 mt-1 font-bold">
                                                        Tanpa gambar
                                                    </p>
                                                @endif
                                            </div>

                                        </div>

                                    </td>

                                    {{-- LOKASI --}}
                                    <td class="px-5 py-5 align-middle">
                                        <div class="flex items-start gap-2 text-white/60 leading-relaxed">
                                            <span class="shrink-0">📍</span>
                                            <span>{{ $event->lokasi }}</span>
                                        </div>
                                    </td>

                                    {{-- HARGA --}}
                                    <td class="px-5 py-5 align-middle">

                                        @if($event->harga > 0)
                                            <span class="inline-flex items-center justify-center rounded-xl bg-purple-600 px-4 py-2 text-white font-bold whitespace-nowrap min-w-[110px]">
                                                Rp {{ number_format($event->harga, 0, ',', '.') }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center justify-center rounded-xl bg-emerald-500 px-4 py-2 text-black font-bold whitespace-nowrap min-w-[90px]">
                                                Gratis
                                            </span>
                                        @endif

                                    </td>

                                    {{-- KUOTA --}}
                                    <td class="px-5 py-5 align-middle">
                                        <span class="inline-flex items-center justify-center rounded-xl bg-emerald-500 px-4 py-2 text-black font-bold whitespace-nowrap min-w-[90px]">
                                            Sisa {{ $event->kuota }}
                                        </span>
                                    </td>

                                    {{-- AKSI --}}
                                    <td class="px-5 py-5 align-middle">

                                        <div class="flex justify-center gap-3">

                                            <a href="/events/{{ $event->id }}/edit"
                                               class="w-10 h-10 rounded-xl bg-blue-500/15 hover:bg-blue-500/30 border border-blue-500/30 text-blue-300 flex items-center justify-center transition">
                                                ✏️
                                            </a>

                                            <form action="/events/{{ $event->id }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus event ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="w-10 h-10 rounded-xl bg-red-500/15 hover:bg-red-500/30 border border-red-500/30 text-red-300 flex items-center justify-center transition">
                                                    🗑️
                                                </button>
                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </div>

    </main>

</div>

</body>
</html>