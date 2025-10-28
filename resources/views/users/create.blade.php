<dialog id="createModal" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="text-lg font-bold mb-4">Tambah Data</h3>
        <form class="space-y-4" action="{{ route('users.store') }}" method="POST" id="createForm">
            @csrf
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Nama<span class="text-red-500">*</span></legend>
                <input type="text" class="input w-full" name="name" required />
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Email<span class="text-red-500">*</span></legend>
                <input type="text" class="input w-full" name="email" required />
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Role<span class="text-red-500">*</span></legend>
                @php
                    $roles = collect([(object)['id' => 'admin', 'name' => 'Admin'], (object)['id' => 'user', 'name' => 'User']]);
                @endphp
                <x-select-search :name="'role'" :value="'id'" :label="['name']" :options="$roles" />
            </fieldset>
            
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Password<span class="text-red-500">*</span></legend>
                <input type="password" class="input w-full" name="password" required />
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Password Confirmation<span class="text-red-500">*</span></legend>
                <input type="password" class="input w-full" name="password_confirmation" required />
            </fieldset>

            <div class="flex gap-2 justify-end">

                <button class="btn" type="button" onclick="createModal.close()">Batalkan</button>
                <button class="btn btn-success" type="submit">Simpan</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
