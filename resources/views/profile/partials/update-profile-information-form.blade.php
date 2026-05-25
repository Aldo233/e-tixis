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

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="profile_photo" :value="__('FOTO PROFIL')" class="text-gray-300" />
            <input id="profile_photo" name="profile_photo" type="file" class="mt-1 block w-full text-white bg-[#1a192f] border-gray-700 p-2 rounded" accept="image/*" />
            <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('NAMA LENGKAP')" class="text-gray-300" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-[#1a192f] text-white border-gray-700" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('ALAMAT SUREL / EMAIL')" class="text-gray-300" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-[#1a192f] text-white border-gray-700" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-gradient-to-r from-purple-600 to-pink-500 border-none hover:from-purple-700 hover:to-pink-600 font-black uppercase tracking-widest">
                {{ __('SIMPAN PERUBAHAN') }}
            </x-primary-button>
        </div>
    </form>
</section>