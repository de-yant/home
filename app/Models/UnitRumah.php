<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitRumah extends Model
{
    protected $primaryKey = 'id_unit';
    public $incrementing = false; // karena bukan integer
    protected $keyType = 'string';

    protected $fillable = ['id_unit', 'no_rumah', 'type', 'alamat', 'id_penghuni', 'status'];
}
