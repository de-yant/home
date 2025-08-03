<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $table = 'progress'; // pastikan sesuai nama tabel

    protected $primaryKey = 'id_progres';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_progres',
        'id_unit',
        'id_pengawas',
        'tanggal',
        'foto',
        'deskripsi',
        'status',
        'jenis',
    ];

    public function unit()
    {
        return $this->belongsTo(UnitRumah::class, 'id_unit', 'id_unit');
    }


    public function pengawas()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_pengawas');
    }

}
