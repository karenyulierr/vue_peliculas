<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peliculas_categorias extends Model
{
    protected $table = 'peliculas_categorias';
    protected $fillable = [
        'id_pelicula',
        'id_categoria',
    ];
}

