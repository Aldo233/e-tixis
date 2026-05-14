<section class="space-y-6">
    <header>
        <h2 class="text-lg font-black text-white uppercase italic">
            {{ __('Hapus Akun') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400 font-bold">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun, silakan unduh data atau informasi apa pun yang ingin Anda simpan.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="uppercase font-black tracking-widest"
    >{{ __('Hapus Akun') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-[#161625] border border-white/10 rounded-[2rem]">
            @csrf
            @method('delete')

            <h2 class="text-lg font-black text-white uppercase italic">
                {{ __('Apakah Anda yakin ingin menghapus akun?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-400 font-bold">
                {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun secara permanen.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Kata Sandi') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 bg-[#0d0d16] border-white/10 text-white"
                    placeholder="{{ __('Masukkan Kata Sandi Anda') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="font-black uppercase tracking-widest border-white/10 text-gray-400">
                    {{ __('Batal') }}
                </x-secondary-button>

                <x-danger-button class="ms-3 font-black uppercase tracking-widest">
                    {{ __('Hapus Akun Sekarang') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>