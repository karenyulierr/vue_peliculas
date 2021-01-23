<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peliculas extends Model
{
    protected $fillable = [
        'pel_imagen',
        'pel_titulo',
        'pel_descripcion',
        'pel_duracion',
        'pel_trailer',
        'pel_fecha_estreno',
    ];
}
