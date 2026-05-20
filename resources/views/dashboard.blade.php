@php
    use App\Models\Event;
    use App\Models\Ticket;
    use App\Models\User;
    use Illuminate\Support\Facades\DB;

    $role = strtolower(trim(Auth::user()->role));

    $totalEvent = Event::count();
    $tiketTerjual = Ticket::count();

    $pendapatan = DB::table('tickets')
        ->join('orders', 'tickets.order_id', '=', 'orders.id')
        ->join('events', 'orders.event_id', '=', 'events.id')
        ->sum('events.harga');

    $penggunaAktif = User::count();

    $name = Auth::user()->name;
    $initial = strtoupper(substr($name, 0, 1));

    $roleLabel = [
        'admin' => 'Administrator',
        'user' => 'Pengguna',
        'petugas' => 'Petugas Validator',
    ][$role] ?? ucfirst($role);
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
    <aside class="w-72 bg-[#111126] border-r border-white/10 hidden lg:flex flex-col shrink-0">

        {{-- LOGO --}}
<div class="p-7">

    <a href="/dashboard"
       class="block w-full h-24 rounded-3xl bg-[#18182c] border border-white/10 shadow-lg overflow-hidden">

        <img 
            src="{{ asset('images/logo-icon-etixis.png') }}" 
            alt="Logo E-TIXIS"
            class="w-full h-full object-cover object-center"
        >

    </a>

</div>
        {{-- MENU --}}
        <div class="px-6 mt-6">
            <p class="text-xs uppercase tracking-[0.3em] text-white/35 mb-5">
                Menu
            </p>

            <nav class="space-y-3">

                <a href="/dashboard"
                   class="flex items-center gap-4 px-5 py-4 rounded-2xl bg-purple-700/35 border border-purple-500/30 text-white shadow-lg">
                    <span class="text-2xl">🏠</span>
                    <span class="font-semibold">Dashboard</span>
                </a>

                @if($role == 'admin')

                    <a href="/events"
                       class="flex items-center gap-4 px-5 py-4 rounded-2xl text-white/55 hover:bg-white/10 hover:text-white transition">
                        <span class="text-2xl">🎪</span>
                        <span class="font-semibold">Kelola Event</span>
                    </a>

                    <a href="/events/create"
                       class="flex items-center gap-4 px-5 py-4 rounded-2xl text-white/55 hover:bg-white/10 hover:text-white transition">
                        <span class="text-2xl">➕</span>
                        <span class="font-semibold">Tambah Event</span>
                    </a>

                @elseif($role == 'user')

                    <a href="/daftar-event"
                       class="flex items-center gap-4 px-5 py-4 rounded-2xl text-white/55 hover:bg-white/10 hover:text-white transition">
                        <span class="text-2xl">🎫</span>
                        <span class="font-semibold">Lihat Event</span>
                    </a>

                    <a href="/tiket-saya"
                       class="flex items-center gap-4 px-5 py-4 rounded-2xl text-white/55 hover:bg-white/10 hover:text-white transition">
                        <span class="text-2xl">🧾</span>
                        <span class="font-semibold">Tiket Saya</span>
                    </a>

                @elseif($role == 'petugas')

                    <a href="/scan-tiket"
                       class="flex items-center gap-4 px-5 py-4 rounded-2xl text-white/55 hover:bg-white/10 hover:text-white transition">
                        <span class="text-2xl">📷</span>
                        <span class="font-semibold">Scan Tiket</span>
                    </a>

                    <a href="/validasi-tiket"
                       class="flex items-center gap-4 px-5 py-4 rounded-2xl text-white/55 hover:bg-white/10 hover:text-white transition">
                        <span class="text-2xl">⌨️</span>
                        <span class="font-semibold">Validasi Manual</span>
                    </a>

                @endif

            </nav>
        </div>

        {{-- PROFILE MENU --}}
        <div class="px-6 mt-10">
            <p class="text-xs uppercase tracking-[0.3em] text-white/35 mb-5">
                Pengaturan
            </p>

            <a href="/profile"
               class="flex items-center gap-4 px-5 py-4 rounded-2xl text-white/55 hover:bg-white/10 hover:text-white transition">
                <span class="text-2xl">⚙️</span>
                <span class="font-semibold">Profile</span>
            </a>
        </div>

        {{-- LOGOUT --}}
        <div class="mt-auto border-t border-white/10 p-7">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="flex items-center gap-4 text-red-400 hover:text-red-300 transition font-semibold">
                    <span class="text-xl">🚪</span>
                    <span>Keluar</span>
                </button>
            </form>
        </div>

    </aside>


    {{-- MAIN CONTENT --}}
    <main class="flex-1 px-5 py-8 lg:px-10 overflow-x-hidden">

        {{-- TOP HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5 mb-8">

            <div>
                <h2 class="text-4xl md:text-5xl font-black tracking-tight">
                    Dashboard
                </h2>

                <p class="text-white/40 mt-2 text-lg">
                    Sistem manajemen tiket digital berbasis web
                </p>
            </div>

            <div class="flex items-center gap-4">

                <div class="hidden sm:flex items-center gap-3 px-5 py-3 rounded-2xl bg-[#18182c] border border-white/10 shadow-xl">
                    <span class="w-2.5 h-2.5 rounded-full bg-purple-400"></span>
                    <span class="text-sm text-white/70 font-bold tracking-wider">
                        {{ strtoupper($role) }}
                    </span>
                </div>

                <a href="/profile"
                   class="flex items-center gap-4 bg-[#18182c] border border-white/10 rounded-2xl px-4 py-3 shadow-xl hover:border-purple-500/40 transition">

                    <div class="hidden md:block text-right">
                        <p class="text-xs text-white/35">
                            Masuk sebagai
                        </p>

                        <p class="font-bold leading-tight max-w-[180px] truncate">
                            {{ $name }}
                        </p>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-fuchsia-600 border border-purple-400/30 flex items-center justify-center shrink-0">
                        <span class="text-white font-black text-2xl leading-none">
                            {{ $initial }}
                        </span>
                    </div>

                </a>

            </div>

        </div>


        {{-- MOBILE MENU --}}
        <div class="lg:hidden mb-8 grid grid-cols-2 gap-3">

            @if($role == 'admin')
                <a href="/events" class="btn bg-[#18182c] border border-white/10 text-white">
                    🎪 Event
                </a>
                <a href="/events/create" class="btn bg-[#18182c] border border-white/10 text-white">
                    ➕ Tambah
                </a>
            @elseif($role == 'user')
                <a href="/daftar-event" class="btn bg-[#18182c] border border-white/10 text-white">
                    🎫 Event
                </a>
                <a href="/tiket-saya" class="btn bg-[#18182c] border border-white/10 text-white">
                    🧾 Tiket
                </a>
            @elseif($role == 'petugas')
                <a href="/scan-tiket" class="btn bg-[#18182c] border border-white/10 text-white">
                    📷 Scan
                </a>
                <a href="/validasi-tiket" class="btn bg-[#18182c] border border-white/10 text-white">
                    ⌨️ Manual
                </a>
            @endif

        </div>


        {{-- HERO --}}
        <section class="relative overflow-hidden rounded-[2rem] p-8 lg:p-10 mb-8 shadow-2xl"
                 style="background: linear-gradient(135deg, #2b135f 0%, #4c1d95 45%, #7c2d12 100%);">

            <div class="absolute -right-12 -top-12 w-64 h-64 rounded-full bg-white/5"></div>
            <div class="absolute right-24 top-8 w-44 h-44 rounded-full bg-white/5"></div>
            <div class="absolute right-40 top-16 w-24 h-24 rounded-full bg-black/10"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-7">

                <div>
                    <p class="text-white/65 mb-2">
                        Selamat datang kembali,
                    </p>

                    <h1 class="text-4xl md:text-5xl font-black tracking-tight">
                        {{ $name }}
                    </h1>

                    <p class="text-white/60 mt-4 max-w-2xl text-lg">
                        @if($role == 'admin')
                            Kelola data event, harga tiket, gambar event, kuota, dan pantau aktivitas sistem E-TIXIS.
                        @elseif($role == 'user')
                            Jelajahi event, pesan tiket, unduh QR Code, dan pantau status tiket kamu dengan mudah.
                        @elseif($role == 'petugas')
                            Validasi tiket pengunjung melalui scan QR Code atau input kode tiket manual.
                        @else
                            Selamat datang di sistem E-TIXIS.
                        @endif
                    </p>
                </div>

                <div class="shrink-0">
                    <div class="px-7 py-4 rounded-2xl bg-white/10 border border-white/20 text-white font-black tracking-widest">
                        {{ strtoupper($roleLabel) }}
                    </div>
                </div>

            </div>

        </section>


        {{-- STAT CARDS ADMIN --}}
        @if($role == 'admin')

            <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

                <div class="rounded-[1.5rem] bg-[#18182c] border border-white/10 p-6 shadow-xl">
                    <div class="w-14 h-14 rounded-2xl bg-purple-500/20 flex items-center justify-center mb-6">
                        <span class="text-2xl">📅</span>
                    </div>

                    <h3 class="text-4xl font-black">
                        {{ $totalEvent }}
                    </h3>

                    <p class="text-white/35 mt-1">
                        Total Event
                    </p>

                    <p class="text-emerald-400 text-sm mt-4">
                        Data event aktif
                    </p>
                </div>

                <div class="rounded-[1.5rem] bg-[#18182c] border border-white/10 p-6 shadow-xl">
                    <div class="w-14 h-14 rounded-2xl bg-blue-500/20 flex items-center justify-center mb-6">
                        <span class="text-2xl">🎟️</span>
                    </div>

                    <h3 class="text-4xl font-black">
                        {{ number_format($tiketTerjual) }}
                    </h3>

                    <p class="text-white/35 mt-1">
                        Tiket Dibuat
                    </p>

                    <p class="text-emerald-400 text-sm mt-4">
                        Total tiket pengguna
                    </p>
                </div>

                <div class="rounded-[1.5rem] bg-[#18182c] border border-white/10 p-6 shadow-xl">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-500/20 flex items-center justify-center mb-6">
                        <span class="text-2xl">💰</span>
                    </div>

                   @php
    if ($pendapatan >= 1000000000) {
        $pendapatanText = 'Rp ' . number_format($pendapatan / 1000000000, 1, ',', '.') . ' M';
    } elseif ($pendapatan >= 1000000) {
        $pendapatanText = 'Rp ' . number_format($pendapatan / 1000000, 1, ',', '.') . ' jt';
    } elseif ($pendapatan >= 1000) {
        $pendapatanText = 'Rp ' . number_format($pendapatan / 1000, 0, ',', '.') . ' rb';
    } else {
        $pendapatanText = 'Rp ' . number_format($pendapatan, 0, ',', '.');
    }
@endphp

<h3 class="text-3xl font-black leading-tight">
    {{ $pendapatanText }}
</h3>

                    <p class="text-white/35 mt-1">
                        Estimasi Pendapatan
                    </p>

                    <p class="text-emerald-400 text-sm mt-4">
                        Berdasarkan tiket terbuat
                    </p>
                </div>

                <div class="rounded-[1.5rem] bg-[#18182c] border border-white/10 p-6 shadow-xl">
                    <div class="w-14 h-14 rounded-2xl bg-orange-500/20 flex items-center justify-center mb-6">
                        <span class="text-2xl">👥</span>
                    </div>

                    <h3 class="text-4xl font-black">
                        {{ number_format($penggunaAktif) }}
                    </h3>

                    <p class="text-white/35 mt-1">
                        Pengguna Aktif
                    </p>

                    <p class="text-purple-400 text-sm mt-4">
                        Semua akun terdaftar
                    </p>
                </div>

            </section>

        @endif


        {{-- CONTENT GRID --}}
        <section class="grid grid-cols-1 xl:grid-cols-2 gap-6">

            {{-- LEFT PANEL --}}
            <div class="rounded-[2rem] bg-[#18182c] border border-white/10 p-7 shadow-2xl">

                @if($role == 'admin')

                    <h3 class="text-2xl font-black mb-1">
                        Aksi Cepat Admin
                    </h3>

                    <p class="text-white/35 mb-6">
                        Pintasan untuk mengelola data event dan sistem.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <a href="/events/create"
                           class="p-5 rounded-2xl bg-white/5 border border-white/10 hover:bg-purple-500/20 hover:border-purple-400/40 transition">
                            <div class="text-3xl mb-4">➕</div>
                            <p class="font-bold">Tambah Event</p>
                            <p class="text-sm text-white/35 mt-1">Buat event baru dengan harga dan gambar.</p>
                        </a>

                        <a href="/events"
                           class="p-5 rounded-2xl bg-white/5 border border-white/10 hover:bg-blue-500/20 hover:border-blue-400/40 transition">
                            <div class="text-3xl mb-4">🎪</div>
                            <p class="font-bold">Kelola Event</p>
                            <p class="text-sm text-white/35 mt-1">Edit, hapus, dan pantau kuota event.</p>
                        </a>

                    </div>

                @elseif($role == 'user')

                    <h3 class="text-2xl font-black mb-1">
                        Menu Pengguna
                    </h3>

                    <p class="text-white/35 mb-6">
                        Akses event dan tiket kamu.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <a href="/daftar-event"
                           class="p-5 rounded-2xl bg-white/5 border border-white/10 hover:bg-emerald-500/20 hover:border-emerald-400/40 transition">
                            <div class="text-3xl mb-4">🎫</div>
                            <p class="font-bold">Lihat Event</p>
                            <p class="text-sm text-white/35 mt-1">Pilih event dan pesan tiket.</p>
                        </a>

                        <a href="/tiket-saya"
                           class="p-5 rounded-2xl bg-white/5 border border-white/10 hover:bg-purple-500/20 hover:border-purple-400/40 transition">
                            <div class="text-3xl mb-4">🧾</div>
                            <p class="font-bold">Tiket Saya</p>
                            <p class="text-sm text-white/35 mt-1">Lihat QR Code dan unduh tiket.</p>
                        </a>

                    </div>

                @elseif($role == 'petugas')

                    <h3 class="text-2xl font-black mb-1">
                        Menu Petugas
                    </h3>

                    <p class="text-white/35 mb-6">
                        Validasi tiket pengunjung secara cepat.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <a href="/scan-tiket"
                           class="p-5 rounded-2xl bg-white/5 border border-white/10 hover:bg-purple-500/20 hover:border-purple-400/40 transition">
                            <div class="text-3xl mb-4">📷</div>
                            <p class="font-bold">Scan Tiket</p>
                            <p class="text-sm text-white/35 mt-1">Scan QR Code tiket menggunakan kamera.</p>
                        </a>

                        <a href="/validasi-tiket"
                           class="p-5 rounded-2xl bg-white/5 border border-white/10 hover:bg-red-500/20 hover:border-red-400/40 transition">
                            <div class="text-3xl mb-4">⌨️</div>
                            <p class="font-bold">Validasi Manual</p>
                            <p class="text-sm text-white/35 mt-1">Masukkan kode tiket secara manual.</p>
                        </a>

                    </div>

                @else

                    <div class="alert alert-error">
                        Role tidak dikenali: {{ Auth::user()->role }}
                    </div>

                @endif

            </div>


            {{-- RIGHT PANEL --}}
            <div class="rounded-[2rem] bg-[#18182c] border border-white/10 p-7 shadow-2xl">

                <h3 class="text-2xl font-black mb-1">
                    Status Sistem
                </h3>

                <p class="text-white/35 mb-6">
                    Ringkasan fitur utama E-TIXIS.
                </p>

                <div class="space-y-4">

                    <div class="flex items-center justify-between gap-4 p-5 rounded-2xl bg-white/5 border border-white/10">
                        <div>
                            <p class="font-bold">Login & Role</p>
                            <p class="text-sm text-white/35">Admin, user, dan petugas</p>
                        </div>
                        <span class="badge badge-success font-bold">Aktif</span>
                    </div>

                    <div class="flex items-center justify-between gap-4 p-5 rounded-2xl bg-white/5 border border-white/10">
                        <div>
                            <p class="font-bold">Kode Tiket Unik</p>
                            <p class="text-sm text-white/35">Generated otomatis per tiket</p>
                        </div>
                        <span class="badge badge-success font-bold">Aktif</span>
                    </div>

                    <div class="flex items-center justify-between gap-4 p-5 rounded-2xl bg-white/5 border border-white/10">
                        <div>
                            <p class="font-bold">QR Code Tiket</p>
                            <p class="text-sm text-white/35">Tampil dan bisa diunduh</p>
                        </div>
                        <span class="badge badge-success font-bold">Aktif</span>
                    </div>

                    <div class="flex items-center justify-between gap-4 p-5 rounded-2xl bg-white/5 border border-white/10">
                        <div>
                            <p class="font-bold">Validasi Tiket</p>
                            <p class="text-sm text-white/35">Manual dan scan QR Code</p>
                        </div>
                        <span class="badge badge-success font-bold">Aktif</span>
                    </div>

                    <div class="flex items-center justify-between gap-4 p-5 rounded-2xl bg-white/5 border border-white/10">
                        <div>
                            <p class="font-bold">Kuota Event</p>
                            <p class="text-sm text-white/35">Berkurang otomatis saat pesan</p>
                        </div>
                        <span class="badge badge-success font-bold">Aktif</span>
                    </div>

                </div>

            </div>

        </section>

    </main>

</div>

</body>
</html>