<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard E-TIXIS
        </h2>
    </x-slot>

    @php
        $role = strtolower(trim(Auth::user()->role));
    @endphp

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-xl p-8">

                <h1 class="text-2xl font-bold text-gray-800">
                    Selamat Datang, {{ Auth::user()->name }}
                </h1>

                <p class="mt-2 text-gray-600">
                    Role akun kamu:
                    <span class="font-semibold text-blue-600">
                        {{ $role }}
                    </span>
                </p>

                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">

                    @if($role == 'admin')
                        <a href="/events" class="block p-6 bg-blue-500 text-white rounded-xl shadow-lg hover:bg-blue-600 transition">
                            <h3 class="text-xl font-bold">Kelola Event</h3>
                            <p class="mt-2">Tambah, edit, dan hapus event.</p>
                        </a>

                    @elseif($role == 'user')
                        <a href="/daftar-event" class="block p-6 bg-green-500 text-white rounded-xl shadow-lg hover:bg-green-600 transition">
                            <h3 class="text-xl font-bold">Lihat Event</h3>
                            <p class="mt-2">Pilih event dan pesan tiket.</p>
                        </a>

                        <a href="/tiket-saya" class="block p-6 bg-purple-500 text-white rounded-xl shadow-lg hover:bg-purple-600 transition">
                            <h3 class="text-xl font-bold">Tiket Saya</h3>
                            <p class="mt-2">Lihat tiket yang sudah dipesan.</p>
                        </a>

                    @elseif($role == 'petugas')
                        <a href="/validasi-tiket" class="block p-6 bg-red-500 text-white rounded-xl shadow-lg hover:bg-red-600 transition">
                            <h3 class="text-xl font-bold">Validasi Tiket</h3>
                            <p class="mt-2">Validasi kode tiket pengunjung.</p>
                        </a>

                    @else
                        <div class="p-4 bg-red-100 text-red-700 rounded-lg">
                            Role tidak dikenali: {{ Auth::user()->role }}
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>
</x-app-layout>