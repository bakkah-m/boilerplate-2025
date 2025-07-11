<dialog id="editModal{{ $d->id }}" class="modal">
    <div class="modal-box">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="text-lg font-bold mb-4">Edit Data</h3>
        <form class="space-y-4" action="{{ route('users.update', $d->id) }}" method="POST">
            @csrf
            @method('PUT')
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Nama<span class="text-red-500">*</span></legend>
                <input type="text" class="input w-full" name="name" required value="{{ $d->name }}" />
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Email<span class="text-red-500">*</span></legend>
                <input type="text" class="input w-full" name="email" required value="{{ $d->email }}" />
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Role<span class="text-red-500">*</span></legend>
                @php
                    $roles = collect([
                        (object) ['id' => 'admin', 'name' => 'Admin'],
                        (object) ['id' => 'user', 'name' => 'User'],
                    ]);
                @endphp
                <x-select-search :name="'role'" :value="'id'" :label="['name']" :options="$roles" :preselectedValue="$d->role"/>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Password</legend>
                <input type="password" class="input w-full" name="password" />
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Password Confirmation</legend>
                <input type="password" class="input w-full" name="password_confirmation" />
            </fieldset>

            <div class="flex gap-2 justify-end">

                <button class="btn" type="button" onclick="editModal{{ $d->id }}.close()">Batalkan</button>
                <button class="btn btn-success" type="submit">Simpan</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
