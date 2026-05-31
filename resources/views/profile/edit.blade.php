@php
    $user = Auth::user();
    $name = trim($user->name);

    $nameParts = preg_split('/\s+/', $name);
    $initial = strtoupper(substr($nameParts[0] ?? 'U', 0, 1));

    if (count($nameParts) > 1) {
        $initial .= strtoupper(substr(end($nameParts), 0, 1));
    }

    $role = strtolower(trim($user->role ?? 'user'));

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
    <title>Profile - E-TIXIS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#0b0b18] text-white">

<div class="max-w-7xl mx-auto px-5 py-10">

    {{-- BACK BUTTON --}}
    <a href="{{ route('dashboard') }}"
       class="inline-flex items-center gap-3 bg-[#18182c] hover:bg-purple-600/20 px-5 py-3 rounded-2xl border border-white/10 transition mb-8">
        <span class="text-purple-400 text-xl">←</span>
        <span class="text-xs font-black uppercase tracking-[0.2em]">
            Kembali ke Dashboard
        </span>
    </a>


    {{-- PROFILE HERO --}}
    <section class="relative overflow-hidden rounded-[2.5rem] border border-white/10 shadow-2xl p-8 md:p-10 mb-8"
             style="background: linear-gradient(135deg, #2b135f 0%, #4c1d95 55%, #7c2d12 100%);">

        <div class="absolute -right-12 -top-12 w-72 h-72 rounded-full bg-white/5"></div>
        <div class="absolute right-28 top-10 w-44 h-44 rounded-full bg-white/5"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center gap-8">

            {{-- WRAPPER AVATAR DENGAN TOMBOL PENSIL --}}
            <div class="relative w-32 h-32 shrink-0">
                {{-- Kotak Inisial --}}
                <div class="w-full h-full rounded-[2rem] bg-purple-500/25 border border-white/15 flex items-center justify-center text-5xl font-black shadow-2xl">
                    {{ $initial }}
                </div>

                {{-- Tombol Edit (Ikon Pensil) Melayang di Pojok Kanan Bawah --}}
                <label for="profile_photo" class="absolute -bottom-1 -right-1 bg-purple-600 hover:bg-purple-500 text-white w-9 h-9 rounded-full flex items-center justify-center cursor-pointer shadow-xl transition-all duration-200 hover:scale-110 border-2 border-[#1c123d]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                </label>

                {{-- Input File Tersembunyi (Terikat otomatis ke form update profil di partials) --}}
                <input id="profile_photo" name="profile_photo" type="file" form="profile-update-form" class="hidden" accept="image/*" />
            </div>

            <div class="flex-1">

                <p class="text-white/55 mb-2">
                    Profil Akun
                </p>

                <h1 class="text-4xl md:text-5xl font-black leading-tight">
                    {{ $user->name }}
                </h1>

                <p class="text-white/55 mt-3 break-all">
                    {{ $user->email }}
                </p>

                <div class="flex flex-wrap items-center gap-3 mt-5">

                    <span class="px-4 py-2 rounded-xl bg-white/10 border border-white/10 text-xs font-black uppercase tracking-widest">
                        {{ $roleLabel }}
                    </span>

                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-black uppercase tracking-widest">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        Status Aktif
                    </span>

                </div>

            </div>

        </div>

    </section>


    {{-- CONTENT GRID --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- LEFT CONTENT --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- UPDATE PROFILE --}}
            <section class="bg-[#18182c] border border-white/10 rounded-[2.5rem] shadow-2xl p-7 md:p-8">

                <div class="flex items-center gap-4 mb-8">
                    <div class="w-2 h-10 rounded-full bg-purple-500"></div>

                    <div>
                        <h2 class="text-2xl font-black">
                            Informasi Profil
                        </h2>

                        <p class="text-white/35 mt-1">
                            Perbarui nama dan alamat email akun kamu.
                        </p>
                    </div>
                </div>

                <div class="profile-form-wrapper">
                    @include('profile.partials.update-profile-information-form')
                </div>

            </section>


            {{-- UPDATE PASSWORD --}}
            <section class="bg-[#18182c] border border-white/10 rounded-[2.5rem] shadow-2xl p-7 md:p-8">

                <div class="flex items-center gap-4 mb-8">
                    <div class="w-2 h-10 rounded-full bg-fuchsia-500"></div>

                    <div>
                        <h2 class="text-2xl font-black">
                            Keamanan Akun
                        </h2>

                        <p class="text-white/35 mt-1">
                            Gunakan password yang kuat agar akun tetap aman.
                        </p>
                    </div>
                </div>

                <div class="profile-form-wrapper">
                    @include('profile.partials.update-password-form')
                </div>

            </section>

        </div>


        {{-- RIGHT CONTENT --}}
        <div class="space-y-8">

            {{-- ACCOUNT SUMMARY --}}
            <section class="bg-[#18182c] border border-white/10 rounded-[2.5rem] shadow-2xl p-7 md:p-8">

                <h3 class="text-xl font-black mb-6">
                    Ringkasan Akun
                </h3>

                <div class="space-y-4">

                    <div class="rounded-2xl bg-white/[0.03] border border-white/5 p-5">
                        <p class="text-xs text-white/35 uppercase tracking-widest font-bold">
                            Tanggal Bergabung
                        </p>

                        <p class="font-black mt-2">
                            {{ $user->created_at->translatedFormat('d F Y') }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white/[0.03] border border-white/5 p-5">
                        <p class="text-xs text-white/35 uppercase tracking-widest font-bold">
                            Peran Sistem
                        </p>

                        <p class="font-black mt-2 text-purple-400">
                            {{ $roleLabel }}
                        </p>
                    </div>

                    <div class="rounded-2xl bg-white/[0.03] border border-white/5 p-5">
                        <p class="text-xs text-white/35 uppercase tracking-widest font-bold">
                            Validasi Akun
                        </p>

                        <p class="font-black mt-2 text-emerald-400">
                            Terverifikasi
                        </p>
                    </div>

                </div>

            </section>


            {{-- DANGER ZONE --}}
            <section class="bg-red-950/10 border border-red-500/15 rounded-[2.5rem] shadow-2xl p-7 md:p-8">

                <h3 class="text-xl font-black text-red-400 mb-3">
                    Zona Berbahaya
                </h3>

                <p class="text-white/35 mb-6">
                    Hapus akun secara permanen dari sistem.
                </p>

                <div class="profile-form-wrapper danger-zone">
                    @include('profile.partials.delete-user-form')
                </div>

            </section>

        </div>

    </div>

</div>


<style>
    .profile-form-wrapper label {
        font-size: 0.75rem !important;
        font-weight: 900 !important;
        color: rgba(255, 255, 255, 0.45) !important;
        text-transform: uppercase;
        letter-spacing: 0.14em;
        margin-bottom: 0.7rem !important;
        display: block;
    }

    .profile-form-wrapper input {
        width: 100% !important;
        background-color: #0f0f1f !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        color: white !important;
        border-radius: 1rem !important;
        padding: 0.95rem 1.1rem !important;
        font-weight: 700 !important;
        box-shadow: none !important;
    }

    .profile-form-wrapper input:focus {
        border-color: #a855f7 !important;
        box-shadow: 0 0 0 1px rgba(168, 85, 247, 0.35) !important;
        outline: none !important;
    }

    .profile-form-wrapper p {
        color: rgba(255, 255, 255, 0.45) !important;
        font-weight: 600;
    }

    .profile-form-wrapper .text-sm {
        color: rgba(255, 255, 255, 0.45) !important;
    }

    .profile-form-wrapper button[type="submit"] {
        background: linear-gradient(135deg, #9333ea 0%, #db2777 100%) !important;
        color: white !important;
        border: none !important;
        border-radius: 1rem !important;
        padding: 0.85rem 1.6rem !important;
        font-weight: 900 !important;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        transition: 0.25s ease;
    }

    .profile-form-wrapper button[type="submit"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(147, 51, 234, 0.25);
    }

    .danger-zone button {
        border-radius: 1rem !important;
        font-weight: 900 !important;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }

    .profile-form-wrapper a {
        color: #c084fc !important;
    }
</style>

</body>
</html>