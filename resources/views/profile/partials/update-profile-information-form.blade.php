<section>
    <header>
        <h2 class="text-lg font-black text-white uppercase italic">
            {{ __('Informasi Profil') }}
        </h2>
        <p class="mt-1 text-sm text-gray-400 font-bold">
            {{ __("Perbarui informasi profil akun dan alamat surel Anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- FORM UTAMA: Ditambahkan id="profile-update-form" agar terhubung dengan input file di atas -->
    <form id="profile-update-form" method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- KETERANGAN FOTO PROFIL (Input dipindah ke atas, di sini sisa error handling) -->
        <div>
            <x-input-label :value="__('FOTO PROFIL')" class="text-gray-300" />
            <p class="text-xs text-gray-400 mt-1 font-medium">Gunakan tombol pensil pada foto profil di atas untuk mengubah atau menambahkan foto.</p>
            
            <!-- Jika upload error (misal file kegedean), error tetap muncul di sini -->
            <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
        </div>

        <!-- INPUT NAMA LENGKAP -->
        <div>
            <x-input-label for="name" :value="__('NAMA LENGKAP')" class="text-gray-300" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-[#1a192f] text-white border-gray-700" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- INPUT EMAIL -->
        <div>
            <x-input-label for="email" :value="__('ALAMAT SUREL / EMAIL')" class="text-gray-300" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-[#1a192f] text-white border-gray-700" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <!-- TOMBOL SIMPAN -->
        <div class="flex items-center gap-4">
            <x-primary-button class="bg-gradient-to-r from-purple-600 to-pink-500 border-none hover:from-purple-700 hover:to-pink-600 font-black uppercase tracking-widest">
                {{ __('SIMPAN PERUBAHAN') }}
            </x-primary-button>
        </div>
    </form>
</section>