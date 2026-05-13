@php
    // Logika untuk mengambil inisial nama user dan role
    $role = strtolower(trim(Auth::user()->role));
    $initial = strtoupper(substr(Auth::user()->name, 0, 1));
@endphp

<!DOCTYPE html>
<html lang="id" data-theme="night">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events - E-TIXIS</title>
    <!-- Memanggil Tailwind & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#0b0b18] text-white font-sans">

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside class="w-72 bg-[#111126] border-r border-white/10 hidden lg:flex flex-col fixed h-full">
            <div class="p-8 flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-500 to-fuchsia-600 shadow-lg shadow-purple-500/20"></div>
                <div>
                    <h1 class="text-xl font-black tracking-wider text-white">E-TIXIS</h1>
                    <p class="text-[10px] text-purple-400 font-bold uppercase tracking-widest">Management</p>
                </div>
            </div>

            <nav class="px-6 mt-4 space-y-2 flex-1">
                <p class="text-[10px] uppercase tracking-[0.2em] text-white/30 font-bold mb-4 px-4">Main Menu</p>
                
                <a href="/dashboard" class="flex items-center gap-4 px-5 py-3.5 rounded-2xl text-white/50 hover:bg-white/5 hover:text-white transition-all group">
                    <span class="text-xl group-hover:scale-110 transition">🏠</span>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="/events" class="flex items-center gap-4 px-5 py-3.5 rounded-2xl bg-purple-600/10 border border-purple-500/20 text-purple-400 shadow-lg shadow-purple-500/5">
                    <span class="text-xl">🎪</span>
                    <span class="font-bold">Events List</span>
                </a>

                @if($role == 'admin')
                <a href="/events/create" class="flex items-center gap-4 px-5 py-3.5 rounded-2xl text-white/50 hover:bg-white/5 hover:text-white transition-all group">
                    <span class="text-xl group-hover:scale-110 transition">➕</span>
                    <span class="font-medium">Add New Event</span>
                </a>
                @endif
            </nav>

            <div class="p-6 border-t border-white/5">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-4 px-5 py-3.5 rounded-2xl text-red-400/60 hover:bg-red-500/10 hover:text-red-400 transition-all">
                        <span>🚪</span>
                        <span class="font-bold">Sign Out</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 lg:ml-72 p-6 lg:p-12">
            
            {{-- HEADER SECTION --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
                <div>
                    <h2 class="text-4xl font-black text-white tracking-tight">Available Events</h2>
                    <p class="text-white/40 mt-2 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                        Explore and manage your upcoming event tickets
                    </p>
                </div>

                <div class="flex items-center gap-4 bg-[#18182c] p-2 rounded-2xl border border-white/5">
                    <div class="pl-4 pr-2">
                        <p class="text-xs text-white/30 text-right">Signed in as</p>
                        <p class="text-sm font-bold text-white text-right">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-purple-600 flex items-center justify-center text-xl font-bold border border-white/10 shadow-inner">
                        {{ $initial }}
                    </div>
                </div>
            </div>

            @if($role == 'admin')
                {{-- TAMPILAN ADMIN (TABEL MODERN) --}}
                <div class="bg-[#111126] border border-white/10 rounded-[2rem] overflow-hidden shadow-2xl">
                    <div class="p-8 border-b border-white/5 flex justify-between items-center bg-white/[0.02]">
                        <h3 class="text-lg font-bold flex items-center gap-3">
                            <span class="w-2 h-6 bg-purple-500 rounded-full"></span>
                            Event Management Data
                        </h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-white/30 text-[11px] uppercase tracking-[0.15em] bg-white/[0.01]">
                                    <th class="px-8 py-5">No</th>
                                    <th class="px-8 py-5">Event Detail</th>
                                    <th class="px-8 py-5">Location</th>
                                    <th class="px-8 py-5 text-center">Quota</th>
                                    <th class="px-8 py-5 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach ($events as $index => $event)
                                <tr class="hover:bg-white/[0.02] transition-colors group">
                                    <td class="px-8 py-6 text-white/20 font-mono text-sm">#{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-8 py-6">
                                        <div class="font-bold text-white group-hover:text-purple-400 transition">{{ $event->nama_event }}</div>
                                        <div class="text-xs text-white/30 mt-1">📅 {{ $event->tanggal }}</div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="text-sm text-white/60">📍 {{ $event->lokasi }}</div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg bg-emerald-500/10 text-emerald-400 text-xs font-bold border border-emerald-500/20">
                                            {{ $event->kuota }} Left
                                        </span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex justify-end gap-3">
                                            <a href="/events/{{ $event->id }}/edit" class="p-2.5 bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded-xl hover:bg-blue-500 hover:text-white transition-all">
                                                ✏️
                                            </a>
                                            <form action="/events/{{ $event->id }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2.5 bg-red-500/10 text-red-400 border border-red-500/20 rounded-xl hover:bg-red-500 hover:text-white transition-all" onclick="return confirm('Hapus event ini?')">
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
                </div>
            @else
                {{-- TAMPILAN USER (CARD MODE) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    @foreach ($events as $event)
                        <div class="bg-[#111126] border border-white/10 rounded-[2.5rem] p-8 hover:border-purple-500/40 transition-all duration-500 group relative overflow-hidden shadow-2xl hover:-translate-y-2">
                            <div class="absolute -top-12 -right-12 w-40 h-40 bg-purple-600/10 rounded-full blur-[60px] group-hover:bg-purple-600/20 transition-all"></div>
                            
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-fuchsia-600 rounded-2xl mb-8 flex items-center justify-center shadow-2xl shadow-purple-900/40 group-hover:rotate-6 transition-transform">
                                <span class="text-3xl">🎟️</span>
                            </div>

                            <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-purple-400 transition">{{ $event->nama_event }}</h3>
                            
                            <div class="space-y-4 mb-10">
                                <div class="flex items-center gap-3 text-white/50 bg-white/[0.03] p-3 rounded-xl border border-white/5">
                                    <span class="text-xl">📅</span>
                                    <span class="text-sm font-medium">{{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-white/50 bg-white/[0.03] p-3 rounded-xl border border-white/5">
                                    <span class="text-xl">📍</span>
                                    <span class="text-sm font-medium">{{ $event->lokasi }}</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between mb-8 px-2">
                                <span class="text-white/30 text-xs uppercase tracking-widest font-bold">Available Seats</span>
                                <span class="text-emerald-400 font-black text-lg">{{ $event->kuota }}</span>
                            </div>

                            <button class="w-full bg-purple-600 hover:bg-purple-500 text-white font-black py-4 rounded-2xl transition-all shadow-xl shadow-purple-900/40 active:scale-95 group-hover:shadow-purple-500/20">
                                BOOK TICKET NOW
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif

            @if($events->isEmpty())
                <div class="text-center py-32 bg-[#111126] rounded-[3rem] border-2 border-dashed border-white/5">
                    <div class="text-6xl mb-6 opacity-20">📂</div>
                    <p class="text-white/20 font-medium italic">No events found in the database.</p>
                </div>
            @endif

        </main>
    </div>

</body>
</html>