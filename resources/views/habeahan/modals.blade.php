<dialog id="deleteModal" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="text-lg font-bold mb-4">Hapus Data</h3>
        <form id="deleteForm" class="space-y-4" method="POST">
            @csrf
            @method('DELETE')
            <p>Apakah anda yakin ingin menghapus data ini? <br />
                <span class="text-error">Data anak akan ikut terhapus secara permanen.</span>
            </p>

            <div class="flex gap-2 justify-end">
                <button class="btn" type="button" onclick="deleteModal.close()">Batalkan</button>
                <button class="btn btn-error" type="submit">Hapus</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>


<dialog id="createModal" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>

        <div id="createModalContent">

        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>


<dialog id="editModal" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>


        <div id="editModalContent">

        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<script>
    function openDeleteModal(actionUrl) {
        const form = document.getElementById('deleteForm');
        form.action = actionUrl;
        deleteModal.showModal();
    }

    async function openCreateModal(id) {
        const modal = document.getElementById('createModal');
        const modalContent = document.getElementById('createModalContent');

        modalContent.innerHTML = `<div class="flex justify-center items-center p-8">
            <span class="loading loading-spinner loading-lg"></span>
        </div>`;

        modal.showModal();

        try {
            const res = await fetch(`/habeahan/create?id=${id}`);
            if (!res.ok) throw new Error("Gagal load data");

            const html = await res.text();
            modalContent.innerHTML = html;
        } catch (err) {
            modalContent.innerHTML = `<div class="p-4 text-error">Error: ${err.message}</div>`;
        }
    }

    async function openEditModal(id) {
        const modal = document.getElementById('editModal');
        const modalContent = document.getElementById('editModalContent');

        modalContent.innerHTML = `<div class="flex justify-center items-center p-8">
            <span class="loading loading-spinner loading-lg"></span>
        </div>`;

        modal.showModal();

        try {
            const res = await fetch(`/habeahan/${id}/edit`);
            if (!res.ok) throw new Error("Gagal load data");

            const html = await res.text();
            modalContent.innerHTML = html;
        } catch (err) {
            modalContent.innerHTML = `<div class="p-4 text-error">Error: ${err.message}</div>`;
        }
    }
</script>