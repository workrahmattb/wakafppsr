<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datawakif extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'notelpon',
        'tglwakaf',
        'wakafpembangunan',
        'wakafproduktif',
        'donasipendidikan',
        'banktransfer',
        'image',
        'catatan',
    ];
}
