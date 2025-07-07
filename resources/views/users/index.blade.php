<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-base-content leading-tight">
            {{ __('Akun Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-4">
            <div class="bg-base-100 overflow-hidden shadow-xs sm:rounded-lg p-4 space-y-4">
                <div class="flex justify-end">
                    @include('users.create')
                    <button class="btn" onclick="createModal.showModal()">+ Tambah Data</button>
                </div>

                <hr />

                <table id="data-table" class="border">
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-center">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->name }}</td>
                                <td>{{ $d->email }}</td>
                                <td>{{ $d->role }}</td>
                                <td>
                                    <div class="flex gap-2 justify-center">
                                        @include('users.edit', ['d' => $d])
                                        <button class="btn btn-info text-white" onclick="editModal{{$d->id}}.showModal()">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                                                <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2">
                                                    <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1" />
                                                    <path
                                                        d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3zM16 5l3 3" />
                                                </g>
                                            </svg>
                                        </button>
                                        @include('users.delete', ['d' => $d])
                                        <button class="btn btn-error text-white" onclick="deleteModal{{$d->id}}.showModal()">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
