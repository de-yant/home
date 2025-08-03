<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    protected $primaryKey = 'id_evaluasi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_evaluasi',
        'id_progres',
        'status',
        'catatan',
        'foto',
    ];

    public function progres()
    {
        return $this->belongsTo(Progress::class, 'id_progres', 'id_progres');
    }
}
