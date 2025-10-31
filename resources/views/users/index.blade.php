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

                <div x-data="userGridController" x-init="init()">
                    <div id="gridjs-wrapper"></div>
                </div>

            </div>
        </div>
    </div>

    {{-- TABLE GRID --}}

    <script>
        /* singleton controller — safe to call repeatedly */
        const userGridController = {
            grid: null,
            wrapperId: "gridjs-wrapper",
            limit: 10,

            init(limit = 10) {
                this.limit = parseInt(limit, 10) || 10;
                const wrapper = document.getElementById(this.wrapperId);
                if (!wrapper) {
                    console.warn("Grid wrapper not found:", this.wrapperId);
                    return;
                }

                // destroy previous grid cleanly
                if (this.grid) {
                    try {
                        this.grid.destroy();
                    } catch (err) {
                        /* ignore */
                    }
                    this.grid = null;
                }

                // create new grid
                this.grid = new Grid({
                    columns: [{
                            id: "id",
                            name: "ID",
                            hidden: true
                        },
                        {
                            id: "number",
                            name: "No",
                            sortable: true
                        },
                        {
                            id: "name",
                            name: "Nama",
                            sortable: true
                        },
                        {
                            id: "email",
                            name: "Email",
                            sortable: true
                        },
                        {
                            id: "role",
                            name: "Role",
                            sortable: true
                        },
                        {
                            id: "actions",
                            name: "Action",
                            sortable: false,
                            formatter: (cell, row) => html(`
            <div class="flex space-x-2 justify-center">
              <button class="btn btn-info text-white" onclick="openEditModal(${row.cells[0].data})">
                <x-edit-icon></x-edit-icon>
              </button>
              <button class="btn btn-error text-white" onclick="openDeleteModal(${row.cells[0].data})">
                <x-delete-icon></x-delete-icon>
              </button>
            </div>
          `)
                        }
                    ],
                    pagination: {
                        server: {
                            url: (prev, page, limit) =>
                                `${prev}?page=${page}&limit=${limit}&offset=${page*limit}`
                        }
                    },
                    search: {
                        server: {
                            url: (prev, keyword) =>
                                `${prev}?search=${keyword}&page=0&limit=${userGridController.limit}`
                        }
                    },
                    sort: true,
                    server: {
                        url: '{{ route('users.grid') }}',
                        then: data => data.data.map(user => [
                            user.id, user.number, user.name, user.email, user.role, ""
                        ]),
                        total: data => data.total
                    },
                    fixedHeader: true,
                    plugins: [{
                        id: 'paginationSelector',
                        component: PaginationSelector,
                        position: PluginPosition.Header,
                    }]
                }).render(wrapper);
            },

            destroy() {
                if (this.grid) {
                    try {
                        this.grid.destroy();
                    } catch (err) {
                        /* ignore */
                    }
                    this.grid = null;
                }
            }
        };

        /* install the event listener once after DOM ready */
        document.addEventListener("pagination-selector", (e) => {
            const newLimit = parseInt(e.detail, 10);
            console.log("pagination-selector caught:", newLimit);

            if (userGridController.grid) {
                userGridController.grid.updateConfig({
                    pagination: {
                        ...userGridController.grid.config.pagination,
                        limit: newLimit
                    }
                }).forceRender();
            }

            const select = document.getElementById('gridjs-pagination-selector');
            if (select) select.value = newLimit;
        });
    </script>



    {{-- MODALS --}}

    <dialog id="editModal" class="modal">
        <div class="modal-box" id="editContent">

        </div>

        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    @include('users.delete')


    <script>
        async function openEditModal(id) {
            modalContent = document.getElementById('editContent');

            modalContent.innerHTML = `<div class="flex justify-center items-center p-8">
                <span class="loading loading-spinner loading-lg"></span>
            </div>`

            editModal.showModal();

            try {
                const res = await fetch(`/users/${id}/edit`);
                if (!res.ok) throw new Error("Gagal load data");

                const html = await res.text();
                modalContent.innerHTML = html;
            } catch (err) {
                modalContent.innerHTML = `<div class="p-4 text-error">Error: ${err.message}</div>`;
            }
        }

        function openDeleteModal(id) {
            const form = document.getElementById('deleteForm');
            form.action = `/users/${id}`
            deleteModal.showModal();
        }
    </script>
</x-app-layout>
