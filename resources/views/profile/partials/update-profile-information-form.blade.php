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

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('NAMA LENGKAP')" class="text-gray-300" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-[#1a192f] text-white border-gray-700" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('ALAMAT SUREL / EMAIL')" class="text-gray-300" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-[#1a192f] text-white border-gray-700" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-200 font-bold">
                        {{ __('Alamat email Anda belum terverifikasi.') }}

                        <button form="send-verification" class="underline text-sm text-purple-400 hover:text-purple-300 font-black uppercase tracking-tighter">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-gradient-to-r from-purple-600 to-pink-500 border-none hover:from-purple-700 hover:to-pink-600 font-black uppercase tracking-widest">
                {{ __('SIMPAN PERUBAHAN') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400 font-bold italic"
                >{{ __('Berhasil Disimpan.') }}</p>
            @endif
        </div>
    </form>
</section>