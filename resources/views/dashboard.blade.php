@php
    use App\Models\Event;
    use App\Models\Ticket;
    use App\Models\User;

    $role = strtolower(trim(Auth::user()->role));

    $totalEvent = Event::count();
    $tiketTerjual = Ticket::count();
    $pendapatan = 0;
    $penggunaAktif = User::count();

    $initial = strtoupper(substr(Auth::user()->name, 0, 1));
@endphp

<!DOCTYPE html>
<html lang="id" data-theme="night">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard E-TIXIS</title>

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

                    <a href="/dashboard"
                       class="flex items-center gap-3 px-5 py-3 rounded-xl bg-purple-700/40 text-white">
                        <span>🏠</span>
                        <span>Dashboard</span>
                    </a>

                    @if($role == 'admin')
                        <a href="/events"
                           class="flex items-center gap-3 px-5 py-3 rounded-xl text-white/55 hover:bg-white/10 hover:text-white transition">
                            <span>🎪</span>
                            <span>Events</span>
                        </a>

                        <a href="/events/create"
                           class="flex items-center gap-3 px-5 py-3 rounded-xl text-white/55 hover:bg-white/10 hover:text-white transition">
                            <span>➕</span>
                            <span>Tambah Event</span>
                        </a>
                    @endif

                    @if($role == 'user')
                        <a href="/daftar-event"
                           class="flex items-center gap-3 px-5 py-3 rounded-xl text-white/55 hover:bg-white/10 hover:text-white transition">
                            <span>🎫</span>
                            <span>Lihat Event</span>
                        </a>

                        <a href="/tiket-saya"
                           class="flex items-center gap-3 px-5 py-3 rounded-xl text-white/55 hover:bg-white/10 hover:text-white transition">
                            <span>🧾</span>
                            <span>Tiket Saya</span>
                        </a>
                    @endif

                    @if($role == 'petugas')
    <a href="/scan-tiket"
       class="flex items-center gap-3 px-5 py-3 rounded-xl text-white/55 hover:bg-white/10 hover:text-white transition">
        <span>📷</span>
        <span>Scan Tiket</span>
    </a>

    <a href="/validasi-tiket"
       class="flex items-center gap-3 px-5 py-3 rounded-xl text-white/55 hover:bg-white/10 hover:text-white transition">
        <span>⌨️</span>
        <span>Validasi Manual</span>
    </a>
@endif

                </nav>
            </div>

            <div class="px-7 mt-10">
                <p class="text-xs uppercase tracking-widest text-white/35 mb-4">Pengaturan</p>

                <a href="/profile"
                   class="flex items-center gap-3 px-5 py-3 rounded-xl text-white/55 hover:bg-white/10 hover:text-white transition">
                    <span>⚙️</span>
                    <span>Profile</span>
                </a>
            </div>

            <div class="mt-auto border-t border-white/10 p-7">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="flex items-center gap-3 text-white/60 hover:text-red-400 transition">
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
                    <h2 class="text-3xl font-bold">Dashboard</h2>
                    <p class="text-white/35 mt-1">
                        Sistem manajemen tiket digital berbasis web
                    </p>
                </div>

                <div class="flex items-center gap-4">

                    <div class="hidden md:flex items-center gap-2 px-4 py-2 rounded-2xl bg-[#18182c] border border-white/10">
                        <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                        <span class="text-sm text-white/60">{{ strtoupper($role) }}</span>
                    </div>

                    <div class="avatar placeholder">
                        <div class="bg-purple-600 text-white rounded-full w-12">
                            <span class="font-bold">{{ $initial }}</span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- HERO --}}
            <section class="relative overflow-hidden rounded-none lg:rounded-2xl p-8 lg:p-10 mb-8"
                     style="background: linear-gradient(135deg, #2b135f 0%, #4c1d95 45%, #7c2d12 100%);">

                <div class="absolute -right-10 -top-10 w-56 h-56 rounded-full bg-white/5"></div>
                <div class="absolute right-24 top-8 w-40 h-40 rounded-full bg-white/5"></div>
                <div class="absolute right-36 top-16 w-20 h-20 rounded-full bg-black/10"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">

                    <div>
                        <p class="text-white/65 mb-2">Selamat datang kembali,</p>

                        <h1 class="text-4xl font-extrabold tracking-tight">
                            {{ Auth::user()->name }}
                        </h1>

                        <p class="text-white/55 mt-3 max-w-xl">
                            @if($role == 'admin')
                                Kelola tiket dan event melalui dashboard admin.
                            @elseif($role == 'user')
                                Pesan tiket event dan pantau status tiket kamu dengan mudah.
                            @elseif($role == 'petugas')
                                Validasi tiket pengunjung dengan cepat dan aman.
                            @endif
                        </p>
                    </div>

                    <div class="badge badge-outline border-white/30 text-white px-7 py-5 text-lg">
                        {{ strtoupper($role) }}
                    </div>

                </div>
            </section>

            {{-- STAT CARDS --}}
            @if($role == 'admin')
                <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

                    <div class="bg-[#18182c] border border-white/10 p-6">
                        <div class="w-12 h-12 rounded-xl bg-purple-500/20 flex items-center justify-center mb-6">
                            <span class="text-purple-300 text-xl">📅</span>
                        </div>
                        <h3 class="text-3xl font-bold">{{ $totalEvent }}</h3>
                        <p class="text-white/35 mt-1">Total Event</p>
                        <p class="text-emerald-400 text-sm mt-4">Data event aktif</p>
                    </div>

                    <div class="bg-[#18182c] border border-white/10 p-6">
                        <div class="w-12 h-12 rounded-xl bg-blue-500/20 flex items-center justify-center mb-6">
                            <span class="text-blue-300 text-xl">🎟️</span>
                        </div>
                        <h3 class="text-3xl font-bold">{{ number_format($tiketTerjual) }}</h3>
                        <p class="text-white/35 mt-1">Tiket Terjual</p>
                        <p class="text-emerald-400 text-sm mt-4">Total tiket dibuat</p>
                    </div>

                    <div class="bg-[#18182c] border border-white/10 p-6">
                        <div class="w-12 h-12 rounded-xl bg-emerald-500/20 flex items-center justify-center mb-6">
                            <span class="text-emerald-300 text-xl">💰</span>
                        </div>
                        <h3 class="text-3xl font-bold">Rp {{ number_format($pendapatan, 0, ',', '.') }}</h3>
                        <p class="text-white/35 mt-1">Pendapatan</p>
                        <p class="text-emerald-400 text-sm mt-4">Estimasi pendapatan</p>
                    </div>

                    <div class="bg-[#18182c] border border-white/10 p-6">
                        <div class="w-12 h-12 rounded-xl bg-orange-500/20 flex items-center justify-center mb-6">
                            <span class="text-orange-300 text-xl">👥</span>
                        </div>
                        <h3 class="text-3xl font-bold">{{ number_format($penggunaAktif) }}</h3>
                        <p class="text-white/35 mt-1">Pengguna Aktif</p>
                        <p class="text-red-400 text-sm mt-4">Semua akun terdaftar</p>
                    </div>

                </section>
            @endif

            {{-- CONTENT GRID --}}
            <section class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                {{-- LEFT PANEL --}}
                <div class="bg-[#18182c] border border-white/10 p-7">

                    @if($role == 'admin')
                        <h3 class="text-xl font-bold mb-1">Aksi Cepat Admin</h3>
                        <p class="text-white/35 mb-6">Pintasan menu utama</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="/events/create" class="p-5 rounded-xl bg-white/5 border border-white/10 hover:bg-purple-500/20 hover:border-purple-400/40 transition">
                                <p class="font-semibold">Tambah Event</p>
                                <p class="text-sm text-white/35 mt-1">Buat event baru</p>
                            </a>

                            <a href="/events" class="p-5 rounded-xl bg-white/5 border border-white/10 hover:bg-blue-500/20 hover:border-blue-400/40 transition">
                                <p class="font-semibold">Kelola Event</p>
                                <p class="text-sm text-white/35 mt-1">Edit dan hapus event</p>
                            </a>

                            <a href="/dashboard" class="p-5 rounded-xl bg-white/5 border border-white/10 hover:bg-emerald-500/20 hover:border-emerald-400/40 transition">
                                <p class="font-semibold">Kelola Tiket</p>
                                <p class="text-sm text-white/35 mt-1">Monitoring tiket</p>
                            </a>

                            <a href="/dashboard" class="p-5 rounded-xl bg-white/5 border border-white/10 hover:bg-orange-500/20 hover:border-orange-400/40 transition">
                                <p class="font-semibold">Laporan</p>
                                <p class="text-sm text-white/35 mt-1">Ringkasan sistem</p>
                            </a>
                        </div>
                    @endif

                    @if($role == 'user')
                        <h3 class="text-xl font-bold mb-1">Menu Pengguna</h3>
                        <p class="text-white/35 mb-6">Akses fitur tiket kamu</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="/daftar-event" class="p-5 rounded-xl bg-white/5 border border-white/10 hover:bg-emerald-500/20 hover:border-emerald-400/40 transition">
                                <p class="font-semibold">Lihat Event</p>
                                <p class="text-sm text-white/35 mt-1">Pilih event tersedia</p>
                            </a>

                            <a href="/tiket-saya" class="p-5 rounded-xl bg-white/5 border border-white/10 hover:bg-purple-500/20 hover:border-purple-400/40 transition">
                                <p class="font-semibold">Tiket Saya</p>
                                <p class="text-sm text-white/35 mt-1">Lihat kode tiket</p>
                            </a>
                        </div>
                    @endif

                    @if($role == 'petugas')
    <h3 class="text-xl font-bold mb-1">Menu Petugas</h3>
    <p class="text-white/35 mb-6">Validasi tiket pengunjung</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="/scan-tiket"
           class="p-5 rounded-xl bg-white/5 border border-white/10 hover:bg-purple-500/20 hover:border-purple-400/40 transition">
            <p class="font-semibold">Scan Tiket</p>
            <p class="text-sm text-white/35 mt-1">
                Scan QR Code tiket menggunakan kamera.
            </p>
        </a>

        <a href="/validasi-tiket"
           class="p-5 rounded-xl bg-white/5 border border-white/10 hover:bg-red-500/20 hover:border-red-400/40 transition">
            <p class="font-semibold">Validasi Manual</p>
            <p class="text-sm text-white/35 mt-1">
                Masukkan kode tiket secara manual.
            </p>
        </a>
    </div>
@endif

                </div>

                {{-- RIGHT PANEL --}}
                <div class="bg-[#18182c] border border-white/10 p-7">
                    <h3 class="text-xl font-bold mb-1">Status Sistem</h3>
                    <p class="text-white/35 mb-6">Ringkasan fitur E-TIXIS</p>

                    <div class="space-y-4">

                        <div class="flex items-center justify-between p-4 rounded-xl bg-white/5 border border-white/10">
                            <div>
                                <p class="font-semibold">Login & Role</p>
                                <p class="text-sm text-white/35">Admin, user, dan petugas</p>
                            </div>
                            <span class="badge badge-success">Aktif</span>
                        </div>

                        <div class="flex items-center justify-between p-4 rounded-xl bg-white/5 border border-white/10">
                            <div>
                                <p class="font-semibold">Kode Tiket Unik</p>
                                <p class="text-sm text-white/35">Generated otomatis</p>
                            </div>
                            <span class="badge badge-success">Aktif</span>
                        </div>

                        <div class="flex items-center justify-between p-4 rounded-xl bg-white/5 border border-white/10">
                            <div>
                                <p class="font-semibold">Validasi Tiket</p>
                                <p class="text-sm text-white/35">Valid / used / tidak ditemukan</p>
                            </div>
                            <span class="badge badge-success">Aktif</span>
                        </div>

                        <div class="flex items-center justify-between p-4 rounded-xl bg-white/5 border border-white/10">
                            <div>
                                <p class="font-semibold">Kuota Event</p>
                                <p class="text-sm text-white/35">Berkurang otomatis saat pesan</p>
                            </div>
                            <span class="badge badge-success">Aktif</span>
                        </div>

                    </div>
                </div>

            </section>

        </main>

    </div>

</body>
</html>