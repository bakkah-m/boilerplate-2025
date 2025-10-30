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
                    <button class="btn btn-primary btn-soft" @click="createModal.showModal()">+ Tambah Data</button>
                </div>

                <hr />

                <div x-data="userGrid()" x-init="init()">
                    <div id="gridjs-wrapper"></div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function userGrid() {
            return {
                grid: null,
                init() {
                    if (this.grid) {
                        this.grid.destroy();
                        this.grid = null;
                    }

                    this.grid = new Grid({
                        columns: [{
                                id: 'id',
                                name: 'No'
                            },
                            {
                                id: 'name',
                                name: 'Nama',
                                sortable: true
                            },
                            {
                                id: 'email',
                                name: 'Email',
                                sortable: true
                            },
                            {
                                id: 'role',
                                name: 'Role',
                                sortable: true
                            },
                            {
                                id: 'actions',
                                name: 'Action',
                            }
                        ],
                        pagination: {
                            enabled: true,
                            limit: 20,
                            page: 1,
                            server: {
                                url: (prev, page, limit) =>
                                    `${prev}?limit=${limit}&page=${page}&offset=${page * limit}`
                            }
                        },

                        search: {
                            server: {
                                url: (prev, keyword, next) => `${prev}?search=${keyword}&${next}`
                            }
                        },
                        sort: true,
                        server: {
                            url: '{{ route('users.grid') }}',
                            then: data => data.data.map((user) => [
                                user.id,
                                user.name,
                                user.email,
                                user.role,
                                '' // actions column handled by formatter
                            ]),
                            total: data => data.total
                        },
                        fixedHeader: true,
                    }).render(document.getElementById("gridjs-wrapper"));
                }
            }
        }
    </script>
</x-app-layout>
