<x-landing-layout>
    <div class="px-4 sm:px-24 bg-base-100 py-8 min-h-screen space-y-4 lg:px-36 pb-24">
        <h1 class="font-display text-2xl md:text-5xl font-bold text-center">Tarombo Bondar</h1>

        <img class="w-full lg:px-72 py-12" src="{{ url('/images/empty.png') }}" />

        <div class="flex flex-col lg:flex-row gap-4 lg:gap-12 w-full justify-center items-center lg:px-72">
            <h2 class="font-display text-2xl md:text-4xl font-bold w-full text-nowrap">Apa itu Bondar?</h2>
            <p class="text-sm md:text-2xl text-justify">
                Dalam sistem kekerabatan Batak, <b>Bondar</b> adalah keturunan dari garis laki-laki yang lebih tua dalam satu
                marga. Mereka dihormati sebagai sumber asal (panganak ni marga) dan memiliki kedudukan penting dalam
                adat serta pengambilan keputusan keluarga besar.</p>
        </div>

        <div class="flex justify-center mt-8">
            <a class="btn bg-pr-red text-white rounded-lg text-lg" href="{{ route('bondar.detail') }}">Lihat Silsilah
                Lengkap</a>
        </div>

    </div>
</x-landing-layout>