@php
    $role = strtolower(trim(Auth::user()->role));
    $initial = strtoupper(substr(Auth::user()->name, 0, 1));
@endphp

<!DOCTYPE html>
<html lang="id" data-theme="night">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events - E-TIXIS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#0b0b18] text-white">

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside class="w-72 bg-[#111126] border-r border-white/10 hidden lg:flex flex-col">
            <div class="p-7 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-fuchsia-600 shadow-lg"></div>
                <div>
                    <h1 class="text-xl font-bold">E-TIXIS</h1>
                    <p class="text-xs text-white/40">Ticketing System</p>
                </div>
            </div>

            <div class="px-7 mt-6">
                <p class="text-xs uppercase tracking-widest text-white/35 mb-4">Menu</p>
                <nav class="space-y-2">
                    <a href="/dashboard" class="flex items-center gap-3 px-5 py-3 rounded-xl text-white/55 hover:bg-white/10 hover:text-white transition">
                        <span>🏠</span>
                        <span>Dashboard</span>
                    </a>

                    <a href="/events" class="flex items-center gap-3 px-5 py-3 rounded-xl bg-purple-700/40 text-white">
                        <span>🎪</span>
                        <span>{{ $role == 'admin' ? 'Kelola Event' : 'Lihat Event' }}</span>
                    </a>

                    @if($role == 'admin')
                        <a href="/events/create" class="flex items-center gap-3 px-5 py-3 rounded-xl text-white/55 hover:bg-white/10 hover:text-white transition">
                            <span>➕</span>
                            <span>Tambah Event</span>
                        </a>
                    @else
                        <a href="#" class="flex items-center gap-3 px-5 py-3 rounded-xl text-white/55 hover:bg-white/10 hover:text-white transition">
                            <span>🎟️</span>
                            <span>Tiket Saya</span>
                        </a>
                    @endif
                </nav>
            </div>

            <div class="mt-auto border-t border-white/10 p-7">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 text-white/60 hover:text-red-400 transition">
                        <span>🚪</span>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-6 lg:p-10 overflow-y-auto">

            {{-- TOP HEADER --}}
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-bold">{{ $role == 'admin' ? 'Manajemen Event' : 'Jelajahi Event' }}</h2>
                    <p class="text-white/35 mt-1">{{ $role == 'admin' ? 'Kelola semua data event di sistem' : 'Pilih dan pesan tiket event yang kamu inginkan' }}</p>
                </div>

                <div class="flex items-center gap-4">
                    <div class="hidden md:flex items-center gap-2 px-4 py-2 rounded-2xl bg-[#18182c] border border-white/10">
                        <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                        <span class="text-sm text-white/60">{{ strtoupper($role) }}</span>
                    </div>
                    <div class="avatar placeholder">
                        <div class="bg-purple-600 text-white rounded-full w-12 flex items-center justify-center">
                            <span class="font-bold">{{ $initial }}</span>
                        </div>
                    </div>
                </div>
            </div>

            @if($role == 'admin')
                {{-- TABLE SECTION (KHUSUS ADMIN) --}}
                <section class="bg-[#18182c] border border-white/10 rounded-2xl overflow-hidden shadow-2xl">
                    <div class="p-6 border-b border-white/10 flex justify-between items-center bg-white/5">
                        <h3 class="text-xl font-bold">Daftar Inventori Event</h3>
                        <a href="/events/create" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-xl text-sm transition font-semibold">
                            + Tambah Baru
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-white/5 text-white/50 text-sm uppercase tracking-wider">
                                    <th class="px-6 py-4 font-semibold">No</th>
                                    <th class="px-6 py-4 font-semibold">Nama Event</th>
                                    <th class="px-6 py-4 font-semibold">Tanggal</th>
                                    <th class="px-6 py-4 font-semibold">Lokasi</th>
                                    <th class="px-6 py-4 font-semibold text-center">Kuota</th>
                                    <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach ($events as $index => $event)
                                <tr class="hover:bg-white/[0.02] transition">
                                    <td class="px-6 py-4 text-white/40">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4"><span class="font-bold text-purple-300">{{ $event->nama_event }}</span></td>
                                    <td class="px-6 py-4 text-white/70">{{ $event->tanggal }}</td>
                                    <td class="px-6 py-4 text-white/70">{{ $event->lokasi }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-400 text-xs border border-emerald-500/20 font-bold">
                                            {{ $event->kuota }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="/events/{{ $event->id }}/edit" class="p-2 bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded-lg hover:bg-blue-500/20 transition">✏️</a>
                                            <form action="/events/{{ $event->id }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-500/10 text-red-400 border border-red-500/20 rounded-lg hover:bg-red-500/20 transition" onclick="return confirm('Hapus?')">🗑️</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            @else
                {{-- CARD SECTION (KHUSUS USER) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    @foreach ($events as $event)
                    <div class="bg-[#18182c] border border-white/10 rounded-[2.5rem] overflow-hidden hover:border-purple-500/50 transition-all duration-300 hover:-translate-y-2 group shadow-xl">
                        <div class="h-44 bg-gradient-to-br from-purple-900/30 to-fuchsia-900/30 p-8 flex items-start justify-between">
                            <span class="bg-emerald-500/20 text-emerald-400 text-[10px] font-bold px-3 py-1 rounded-full border border-emerald-500/20 uppercase tracking-tighter">Tersedia</span>
                        </div>
                        <div class="p-8 -mt-12 bg-[#18182c] rounded-t-[2.5rem]">
                            <h3 class="text-xl font-bold mb-4 group-hover:text-purple-400 transition line-clamp-1">{{ $event->nama_event }}</h3>
                            <div class="space-y-3 mb-8 text-sm text-white/50">
                                <div class="flex items-center gap-3"><span>📅</span> {{ $event->tanggal }}</div>
                                <div class="flex items-center gap-3"><span>📍</span> {{ $event->lokasi }}</div>
                                <div class="flex items-center gap-3"><span>👥</span> Sisa Kuota: <span class="text-emerald-400 font-bold">{{ $event->kuota }}</span></div>
                            </div>
                            <button class="w-full bg-purple-600 hover:bg-purple-500 text-white py-4 rounded-2xl font-bold transition-all shadow-lg shadow-purple-900/20">
                                Pesan Tiket Sekarang
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif

        </main>
    </div>

</body>
</html>