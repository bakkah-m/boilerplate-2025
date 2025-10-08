<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habeahan extends Model
{
    protected $table = 'habeahans';

    protected $fillable = [
        'identifier',
        'nama',
        'jenis_kelamin',
        'sundut',
        'urutan_lahir',
        'jumlah_saudara',
        'parent_id',
        'wilayah',
    ];

    /**
     * Relasi ke orang tua
     */
    public function parent()
    {
        return $this->belongsTo(Habeahan::class, 'parent_id');
    }

    /**
     * Relasi ke anak-anak
     */
    public function children()
    {
        return $this->hasMany(Habeahan::class, 'parent_id');
    }
}
