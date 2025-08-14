<dialog id="logoutModal" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="text-lg font-bold mb-4">Logout</h3>
        <form class="space-y-4" action="{{ route('logout') }}" method="POST">
            @csrf
            <p>Apakah anda yakin ingin keluar?</p>

            <div class="flex gap-2 justify-end">

                <button class="btn" type="button" onclick="logoutModal.close()">Batalkan</button>
                <button class="btn btn-error" type="submit">Logout</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
