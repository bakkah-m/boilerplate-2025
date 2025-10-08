<x-landing-layout>
    <div class="px-4 sm:px-24 bg-base-100 py-8 min-h-screen space-y-4">
        <h1 class="font-display text-2xl md:text-4xl font-bold">Daftar Lengkap Tarombo Habeahan</h1>

        <div class="flex flex-col items-end overflow-hidden sm:rounded-lg space-y-4">

            <form class="flex flex-col md:flex-row gap-4 items-end md:justify-end w-full">
                <fieldset class="fieldset p-0 w-full md:w-24">
                    <legend class="fieldset-legend">Generasi</legend>
                    <select class="select w-full" name="sundut_filter">
                        <option value="" {{ $filters['sundut'] == '' ? 'selected' : '' }}>Semua</option>
                        @for ($i = 1; $i <= 26; $i++)
                            <option value="{{ $i }}" {{ $i == $filters['sundut'] ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </fieldset>
                <fieldset class="fieldset p-0 w-full md:w-24">
                    <legend class="fieldset-legend">Abjad</legend>
                    <select class="select w-full" name="letter_filter">
                        <option value="" {{ $filters['letter'] == '' ? 'selected' : '' }}>Semua</option>
                        @for ($i = 1; $i <= 26; $i++)
                            <option value="{{ turnToLetter($i) }}" {{ turnToLetter($i) == $filters['letter'] ? 'selected' : '' }}>{{ turnToLetter($i) }}</option>
                        @endfor
                    </select>
                </fieldset>
                <fieldset class="fieldset p-0 w-full md:w-64">
                    <legend class="fieldset-legend">Nama</legend>
                    <input type="text" class="input w-full" name="name_filter" placeholder="Ketik nama..."
                        value="{{ $filters['name'] }}" />
                </fieldset>
                <button class="btn btn-success text-white" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m19.6 21l-6.3-6.3q-.75.6-1.725.95T9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l6.3 6.3zM9.5 14q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14" />
                    </svg>
                </button>
            </form>

            <hr />

            @php
                // repeat until 26 cols
                $colColors = [];
                for ($i = 1; $i <= 26; $i++) {
                    $colColors[$i] = randomPastelTailwind($i);
                }
            @endphp

            <div class="space-y-4 shadow-lg border w-full rounded-2xl">

                <div class="overflow-x-auto w-full rounded-2xl">
                    <table class="border table">
                        <thead>
                            <!-- Baris 1: Nomor di atas kolom 1–26 -->
                            <tr class="bg-base-200">
                                <th rowspan="2" class="border text-center">Nomor Urut</th>
                                <th colspan="26" class="text-center">Nomor/Sundut</th>
                            </tr>
                            <!-- Baris 2: nomor 1 sampai 26 -->

                            <tr>
                                @for ($i = 1; $i <= 26; $i++)
                                    <th class="border border-l-4 text-black"
                                        style="background-color: {{ $colColors[$i] }}; border-left-color: {{ $colColors[$i] }};">
                                        {{ $i }}
                                    </th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    @for ($i = 1; $i <= $d->sundut; $i++)
                                        <td class="max-w-10 p-0 border border-r-0 border-l-4 overflow-visible {{ $i == $d->sundut ? ' border-b-4' : '' }}"
                                            style="border-left-color: {{ $colColors[$i] }}; {{ $i == $d->sundut ? 'border-bottom-color: ' . $colColors[$i] : '' }}">
                                            <div class="inline-block whitespace-nowrap py-4 px-2  transition-all gap-4">
                                                <div class="flex gap-4">
                                                    <div class="flex flex-col">
                                                        @php
                                                            $urutan = $d->jenis_kelamin == 'P' ? $d->urutan_lahir . "b" : $d->urutan_lahir;
                                                        @endphp
                                                        <small class="text-sm">
                                                            {{ $i == $d->sundut ? "$d->sundut. $urutan/$d->jumlah_saudara." : '' }}
                                                        </small>
                                                        <p
                                                            class="font-bold {{ $i == $d->sundut ? ($d->jenis_kelamin == 'P' ? 'text-success' : '') : '' }}">
                                                            {{ $i == $d->sundut ? $d->nama : '' }}
                                                        </p>
                                                        @if ($d->wilayah && $i == $d->sundut)
                                                            <small class="text-sm">
                                                                h : {{ $i == $d->sundut ? $d->wilayah : '' }}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    @endfor

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 w-full p-6 rounded-2xl">
                    {{ $data->links()  }}
                </div>
            </div>


        </div>
    </div>
</x-landing-layout>