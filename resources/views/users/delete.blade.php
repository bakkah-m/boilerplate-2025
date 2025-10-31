<dialog id="deleteModal" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="text-lg font-bold mb-4">Hapus Data</h3>
        <form class="space-y-4" method="POST" id="deleteForm" onsubmit="this.querySelector('button[type=submit]').disabled = true; this.querySelector('button[type=submit]').innerText = 'Processing...';">
            @csrf
            @method('DELETE')
            <p>Apakah anda yakin ingin menghapus data ini?</p>

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
