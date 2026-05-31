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
            <x-input-label :value="__('FOTO PROFIL')" class="text-gray-300 mb-3" />
            
            <div class="flex items-center gap-6">
                <div class="relative w-24 h-24">
                    <div class="w-full h-full bg-gradient-to-br from-purple-700 to-indigo-900 rounded-2xl flex items-center justify-center text-white text-4xl font-black shadow-lg border border-purple-500/30">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <label for="profile_photo" class="absolute -bottom-2 -right-2 bg-blue-600 hover:bg-blue-500 text-white w-8 h-8 rounded-full flex items-center justify-center cursor-pointer shadow-md transition-all duration-200 hover:scale-110 border-2 border-[#1a192f]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </label>

                    <input id="profile_photo" name="profile_photo" type="file" class="hidden" accept="image/*" />
                </div>

                <div class="text-xs text-gray-400 space-y-1">
                    <p class="font-bold text-gray-300">Klik ikon pensil untuk mengubah foto.</p>
                    <p>Format: JPG, PNG atau GIF (Maks. 2MB)</p>
                </div>
            </div>
            
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