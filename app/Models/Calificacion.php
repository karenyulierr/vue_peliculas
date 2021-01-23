<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $table = 'calificacion';
    protected $fillable = [
        'cal_pelicula',
        'id_pelicula',
    ];
}
