<!DOCTYPE html>
<html lang="id" data-theme="night">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event - E-TIXIS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#0b0b18] text-white">

    <div class="max-w-5xl mx-auto px-4 py-10">

        <a href="/dashboard" class="inline-flex items-center gap-2 text-white/50 hover:text-purple-400 transition mb-8">
            <span>←</span>
            <span>Kembali ke Dashboard</span>
        </a>

        <div class="bg-[#111126] border border-white/10 rounded-[2rem] shadow-2xl overflow-hidden">

            <div class="p-8 md:p-10 border-b border-white/10"
                 style="background: linear-gradient(135deg, #1e1040 0%, #2d1065 45%, #7c2d12 100%);">

                <p class="text-sm text-white/50 mb-2">
                    Admin Panel
                </p>

                <h1 class="text-4xl md:text-5xl font-extrabold">
                    Tambah Event
                </h1>

                <p class="text-white/50 mt-4">
                    Silakan lengkapi formulir di bawah untuk membuat event baru.
                </p>
            </div>

            <div class="p-8 md:p-10">

                @if ($errors->any())
                    <div class="alert alert-error mb-6">
                        <div>
                            <h3 class="font-bold">Terjadi kesalahan input</h3>
                            <ul class="list-disc list-inside text-sm mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form action="/events" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block mb-2 font-semibold text-white/70">
                            Nama Event
                        </label>

                        <input
                            type="text"
                            name="nama_event"
                            value="{{ old('nama_event') }}"
                            class="input input-bordered w-full bg-[#18182c] border-white/10 h-14"
                            placeholder="Masukkan nama event..."
                            required
                        >
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block mb-2 font-semibold text-white/70">
                                Tanggal Pelaksanaan
                            </label>

                            <input
                                type="date"
                                name="tanggal"
                                value="{{ old('tanggal') }}"
                                class="input input-bordered w-full bg-[#18182c] border-white/10 h-14"
                                required
                            >
                        </div>

                        <div>
                            <label class="block mb-2 font-semibold text-white/70">
                                Jumlah Kuota
                            </label>

                            <input
                                type="number"
                                name="kuota"
                                value="{{ old('kuota') }}"
                                class="input input-bordered w-full bg-[#18182c] border-white/10 h-14"
                                placeholder="Contoh: 100"
                                min="1"
                                required
                            >
                        </div>

                    </div>

                    <div>
                        <label class="block mb-2 font-semibold text-white/70">
                            Lokasi Event
                        </label>

                        <input
                            type="text"
                            name="lokasi"
                            value="{{ old('lokasi') }}"
                            class="input input-bordered w-full bg-[#18182c] border-white/10 h-14"
                            placeholder="Contoh: Gedung H UNILA"
                            required
                        >
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold text-white/70">
                            Deskripsi Event
                        </label>

                        <textarea
                            name="deskripsi"
                            rows="5"
                            class="textarea textarea-bordered w-full bg-[#18182c] border-white/10 text-white"
                            placeholder="Tuliskan deskripsi event, seperti tema acara, benefit, pembicara, rundown singkat, atau informasi penting lainnya..."
                        >{{ old('deskripsi') }}</textarea>

                        <p class="text-sm text-white/40 mt-2">
                            Deskripsi ini akan ditampilkan kepada pengguna saat melihat event.
                        </p>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold text-white/70">
                            Harga Tiket
                        </label>

                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-white/40 font-semibold">
                                Rp
                            </span>

                            <input
                                type="number"
                                name="harga"
                                value="{{ old('harga') }}"
                                class="input input-bordered w-full bg-[#18182c] border-white/10 h-14 pl-12"
                                placeholder="Contoh: 50000"
                                min="0"
                                required
                            >
                        </div>

                        <p class="text-sm text-white/40 mt-2">
                            Isi 0 jika event tidak berbayar.
                        </p>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold text-white/70">
                            Logo / Gambar Event
                        </label>

                        <input
                            type="file"
                            name="gambar_event"
                            class="file-input file-input-bordered w-full bg-[#18182c] border-white/10"
                            accept="image/*"
                        >

                        <p class="text-sm text-white/40 mt-2">
                            Format yang disarankan: jpg, jpeg, png, atau webp. Maksimal 2MB.
                        </p>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                                class="btn w-full h-14 border-0 text-white text-lg font-extrabold tracking-wide"
                                style="background: linear-gradient(135deg, #9333ea 0%, #a855f7 50%, #7e22ce 100%);">
                            SIMPAN EVENT SEKARANG
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>

</body>
</html>