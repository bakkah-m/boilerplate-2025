<x-landing-layout>
    <div class="px-4 sm:px-24 bg-base-100 py-8 min-h-screen space-y-12 lg:px-96 lg:py-24">
        <h1 class="font-display text-2xl md:text-5xl font-bold text-center">Visi dan Misi</h1>

        <div class="flex flex-col text-lg md:text-2xl justify-center">
            <p class="text-center"><b>Visi dan Misi</b> dalam prakitnya membentuk fondasi strategis PPRPI. </p>
            <p class="text-justify">Visi memberikan pandangan jangka panjang yang diinginkan, sementara Misi menetapkan
                jalur konkret untuk
                mencapainya. Keduanya penting untuk membantu organisasi mencapai keberhasilan jangka panjang dan memandu
                pengambilan keputusan di semua tingkatan.</p>
        </div>

        <div class="flex flex-col text-lg md:text-2xl justify-center gap-6">
            <h2 class="font-display text-2xl md:text-4xl font-bold">Visi</h2>
            <p class="text-justify">Menjadi <b>Pomparan Raja Pasaribu</b> yang memiliki karakter mulia dan unggul serta
                taat pada Poda ni Ompungta,
                yaitu MarTuhan, MarAdat, MarPatik, MarUhum, dan MarRaja dalam kerangka meningkatkan kesejahteraan
                Anggota.</p>
        </div>


        <div class="flex flex-col text-lg md:text-2xl justify-center gap-6">
            <h2 class="font-display text-2xl md:text-4xl font-bold">Misi</h2>
            <ul class="flex flex-col gap-8">

                @php
                    $mission = [
                        'Mengakui dan mengagungkan adanya Tuhan Yang Maha Esa, Pencipta langit, bumi dan segala isinya (Debata Mulajadi Nabolon), serta menaati ajaranNya.',
                        'Memelihara, melestarikan dan mengembangkan nilai-nilai luhur budaya dan adat istiadat suku Batak sesuai dengan prinsip Dalihan Natolu, serta mengembangkan dan memajukan peradaban/ kebudayaan, norma, nilai, moral, dan etika yang hidup dalam kekerabatan bangso Batak khususnya dan masyarakat umumnya.',
                        'Menaati dan memelihara Patik (aturan hukum adat) Batak dan Peraturan Perundang-undangan yang berlaku.',
                        'Memelihara dan melaksanakan perilaku yang “Raja” dengan memiliki karakter ahlak mulia, kepemimpinan yang suka melayani, gotongroyong, dan menghormati sesama dalam kehidupan bermasyarakat, berbangsa dan bernegara.',
                        'Mempererat hubungan kekeluargaan marga Pasaribu dan boru melalui wadah perkumpulan (punguan) marga-marga Pasaribu di setiap wilayah',
                        'Mendorong peningkatan kualitas hidup SDM Marga Pasaribu dan borunya terutama di bidang ekonomi, Pendidikan dan sosial kemasyarakatan.',
                    ];
                @endphp

                @foreach ($mission as $item)
                    <li class="flex gap-6 lg:gap-12 items-center">
                        <img class="w-12 h-12" src="{{ url('/vector/mission/mission-'.$loop->iteration.'.svg') }}" />
                        <p class="text-justify">{{ $item }}</p>
                    </li>
                @endforeach

            </ul>
        </div>

    </div>
</x-landing-layout>