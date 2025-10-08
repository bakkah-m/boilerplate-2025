<h3 class="text-lg font-bold mb-4">Edit Data</h3>

<form id="editForm" class="space-y-4" method="POST" action="{{ route('habeahan.update', $data->id) }}">
    @csrf
    @method('PUT')

    @if ($data->sundut > 1)
        <fieldset class="fieldset">
            <legend class="fieldset-legend">Orang Tua</legend>
            <input type="text" class="input w-full" value="{{ $data->parent->nama }}" disabled />
        </fieldset>
    @endif

    <fieldset class="fieldset">
        <legend class="fieldset-legend">Generasi</legend>
        <input type="text" class="input w-full" value="{{ $data->sundut }}" disabled />
    </fieldset>

    <fieldset class="fieldset">
        <legend class="fieldset-legend">Nama<span class="text-red-500">*</span></legend>
        <input type="text" class="input w-full" name="nama" value="{{ $data->nama }}"/>
    </fieldset>

    <fieldset class="fieldset">
        <legend class="fieldset-legend">Jenis Kelamin<span class="text-red-500">*</span></legend>
        <select name="jenis_kelamin" class="select w-full">
            <option value="L" {{ $data->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki - Laki</option>
            <option value="P" {{ $data->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </fieldset>

    <fieldset class="fieldset">
        <legend class="fieldset-legend">Urutan Lahir <span class="text-red-500">*</span></legend>
        <input type="number" class="input w-full" name="urutan_lahir" value="{{ $data->urutan_lahir }}"/>
    </fieldset>

    <fieldset class="fieldset">
        <legend class="fieldset-legend">Total Saudara Sejenis Kelamin<span class="text-red-500">*</span></legend>
        <input type="number" class="input w-full" name="jumlah_saudara" value="{{ $data->jumlah_saudara }}"/>
    </fieldset>

    <fieldset class="fieldset">
        <legend class="fieldset-legend">Wilayah/Tempat Tinggal</legend>
        <input type="text" class="input w-full" name="wilayah" value="{{ $data->wilayah }}"/>
    </fieldset>

    <div class="flex gap-2 justify-end">
        <button class="btn" type="button" onclick="editModal.close()">Batalkan</button>
        <button class="btn btn-success" type="submit">Simpan</button>
    </div>
</form>