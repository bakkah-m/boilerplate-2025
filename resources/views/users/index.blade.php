<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-base-content leading-tight">
            {{ __('Manajemen User') }}
        </h2>
    </x-slot>
    <x-slot name="menu">
        <span class="badge badge-info text-white">Manajemen User</span>
    </x-slot>

    <div class="py-4">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-4">
            <div class="bg-base-100 overflow-hidden shadow-xs sm:rounded-lg p-4 space-y-4">
                <div class="flex justify-end">
                    @include('users.create')
                    <button class="btn btn-primary btn-soft" onclick="createModal.showModal()">+ Tambah Data</button>
                </div>

                <hr />

                <table id="data-table" class="border table-zebra table">
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-center">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            <tr class="hover:bg-base-300!">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->name }}</td>
                                <td>{{ $d->email }}</td>
                                <td>{{ $d->role }}</td>
                                <td>
                                    <div class="flex gap-2 justify-center">
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
