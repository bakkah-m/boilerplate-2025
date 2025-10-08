<h3 class="text-lg font-bold mb-4">Tambah Anak</h3>

<form id="createForm" class="space-y-4" method="POST" action="{{ route('habeahan.store') }}">
    @csrf

    <fieldset class="fieldset">
        <legend class="fieldset-legend">Orang Tua</legend>
        <input type="text" class="input w-full" value="{{ $parent->nama }}" disabled />
        <input type="hidden" class="input w-full" name="parent_id" value="{{ $parent->id }}" />
    </fieldset>

    <fieldset class="fieldset">
        <legend class="fieldset-legend">Generasi Anak</legend>
        <input type="text" class="input w-full" value="{{ $parent->sundut + 1 }}" disabled />
        <input type="hidden" class="input w-full" name="sundut" value="{{ $parent->sundut + 1 }}" />
    </fieldset>

    
    <fieldset class="fieldset">
        <legend class="fieldset-legend">Nama Anak<span class="text-red-500">*</span></legend>
        <input type="text" class="input w-full" name="nama" />
    </fieldset>

    <fieldset class="fieldset">
        <legend class="fieldset-legend">Jenis Kelamin<span class="text-red-500">*</span></legend>
        <select name="jenis_kelamin" class="select w-full">
            <option value="L" >Laki - Laki</option>
            <option value="P" >Perempuan</option>
        </select>
    </fieldset>
    
    <fieldset class="fieldset">
        <legend class="fieldset-legend">Urutan Lahir <span class="text-red-500">*</span></legend>
        <input type="number" class="input w-full" name="urutan_lahir" />
    </fieldset>
    
    <fieldset class="fieldset">
        <legend class="fieldset-legend">Total Saudara Sejenis Kelamin<span class="text-red-500">*</span></legend>
        <input type="number" class="input w-full" name="jumlah_saudara" />
    </fieldset>
    
    <fieldset class="fieldset">
        <legend class="fieldset-legend">Wilayah/Tempat Tinggal</legend>
        <input type="text" class="input w-full" name="wilayah" />
    </fieldset>

    <div class="flex gap-2 justify-end">
        <button class="btn" type="button" onclick="createModal.close()">Batalkan</button>
        <button class="btn btn-success" type="submit">Simpan</button>
    </div>
</form>