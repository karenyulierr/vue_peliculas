<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use App\Models\Peliculas_categorias;
use App\Models\Peliculas;

class CategoriasController extends Controller
{

    //metodo que carga todas las categorias
    public function getCategorias()
    {
        $cagetgorias = Categorias::get();
        return response()->json($cagetgorias);
    }

    public function aregar_categoria(Request $request)
    {
        for ($i = 0; $i < count($request->categorias); $i++) {
            $response = Peliculas_categorias::create([
                'id_pelicula' => $request->idPelicula,
                'id_categoria' => $request->categorias[$i]['id'],
            ]);
        }
        return response()->json($response);
    }

    public function getAgregar($id)
    {
        $peliculas = Peliculas::select('pel_titulo')->where('id_pelicula', $id)->get();
        return response()->json($peliculas);
    }
    // metodo que me trae todas la calificaciones de las peliculas
    public function getListaCategorias()
    {
        $response = \DB::table('peliculas')
            ->join('peliculas_categorias', 'peliculas_categorias.id_pelicula', '=', 'peliculas.id_pelicula')
            ->join('categorias', 'categorias.id_categoria', '=', 'peliculas_categorias.id_categoria')
            ->select('peliculas.pel_titulo', 'categorias.cat_nombre')
            ->orderby('categorias.cat_nombre')
            ->get();
        return response()->json($response);
    }
}
