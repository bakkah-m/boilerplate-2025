<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-base-content leading-tight">
            {{ __('Habeahan') }}
        </h2>
    </x-slot>
    <x-slot name="menu">
        <span class="badge badge-info text-white">Habeahan</span>
    </x-slot>

    <div class="py-4">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-4">
            <div class="bg-base-100 overflow-hidden shadow-xs sm:rounded-lg p-4 space-y-4">

                <form class="flex justify-end gap-4 items-end">
                    <fieldset class="fieldset p-0">
                        <legend class="fieldset-legend">Generasi</legend>
                        <select class="select w-full" name="sundut_filter">
                            <option value=""{{ $filters['sundut'] == '' ? 'selected' : '' }} >Semua</option>
                            @for ($i = 1; $i <= 26; $i++)
                                <option value="{{ $i }}" {{ $i==$filters['sundut'] ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </fieldset>
                    <fieldset class="fieldset p-0">
                        <legend class="fieldset-legend">Abjad</legend>
                        <select class="select w-full" name="letter_filter">
                            <option value="" {{ $filters['letter'] == '' ? 'selected' : '' }}>Semua</option>
                            @for ($i = 1; $i <= 26; $i++)
                                <option value="{{ turnToLetter($i) }}" {{ turnToLetter($i)==$filters['letter'] ? 'selected' : '' }}>{{ turnToLetter($i) }}</option>
                            @endfor
                        </select>
                    </fieldset>
                    <fieldset class="fieldset p-0">
                        <legend class="fieldset-legend">Nama</legend>
                        <input type="text" class="input w-full" name="name_filter" placeholder="Ketik nama..." value="{{ $filters['name'] }}"/>
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

                <div class="overflow-x-auto">
                    <table class="border table">
                        <thead>
                            <!-- Baris 1: Nomor di atas kolom 1–26 -->
                            <tr class="bg-base-200">
                                <th rowspan="2" class="border">No Urut</th>
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
                                    <td>{{$loop->iteration}}</td>
                                    @for ($i = 1; $i <= $d->sundut; $i++)
                                        <td class="max-w-10 p-0 border border-r-0 border-l-4 overflow-visible{{ $i == $d->sundut ? ' border-b-4' : '' }}"
                                            style="border-left-color: {{ $colColors[$i] }}; {{ $i == $d->sundut ? 'border-bottom-color: ' . $colColors[$i] : '' }}">
                                            <div
                                                class="inline-block whitespace-nowrap py-4 px-2  transition-all gap-4 {{ $i == $d->sundut ? 'hover:bg-success/30' : '' }}">
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
                                                    <div class="flex justify-center items-center gap-2 px-6">
                                                        @if ($d->sundut == $i)
                                                            <button class="btn btn-info text-white" onclick="openCreateModal({{$d->id}})">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                                    viewBox="0 0 24 24">
                                                                    <path fill="currentColor"
                                                                        d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z" />
                                                                </svg>
                                                            </button><button class="btn btn-warning text-white" onclick="openEditModal({{$d->id}})">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                                    viewBox="0 0 24 24">
                                                                    <path fill="currentColor"
                                                                        d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75z" />
                                                                </svg>
                                                            </button>
                                                            @if ($d->parent_id)
                                                                <button class="btn btn-error text-white" onclick="openDeleteModal('{{ route('habeahan.destroy', $d->id) }}')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                                        viewBox="0 0 24 24">
                                                                        <path fill="currentColor"
                                                                            d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                                                    </svg>
                                                                </button>
                                                            @endif
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
                    <div class="mt-4">
                        {{ $data->links()  }}
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
@include('habeahan.modals')