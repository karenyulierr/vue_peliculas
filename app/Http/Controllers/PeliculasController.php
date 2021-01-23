<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;

use App\Models\Peliculas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\Environment\Console;

class PeliculasController extends Controller
{
    public function index()
    {
        return view('Peliculas.index');
    }

    public function getPeliculas()
    {

        $peliculas = Peliculas::select('peliculas.*')->get();
        return response()->json($peliculas);

        /*$response = \DB::table('peliculas')
            ->join('peliculas_categorias', 'peliculas_categorias.id_pelicula', '=', 'peliculas.id_pelicula')
            ->join('categorias', 'categorias.id_categoria', '=', 'peliculas_categorias.id_categoria')
            ->select('peliculas.*', 'categorias.cat_nombre')
            ->orderby('categorias.cat_nombre')
            ->get();
        return response()->json($response);*/
    }

    public function crearPelicula(Request $request)
    {
        $file = $request->file('imagen');
        $fileName =$file->getClientOriginalName();
        Storage::disk('public')->put($fileName, file_get_contents($file->getRealPath()));
        $response = Peliculas::create([
            'pel_imagen' => $fileName,
            'pel_titulo' => $request->titulo,
            'pel_descripcion' => $request->descripcion,
            'pel_duracion' => $request->duracion,
            'pel_trailer' => $request->youtube,
            'pel_fecha_estreno' => $request->fecha_estreno,
        ]);
        //$idPelicula = Peliculas::latest('id_pelicula')->first();

       /*
        for ($i = 0; $i < count(json_decode($request->categorias)); $i++) {
            $response = Peliculas_categorias::create([
                'id_pelicula' => $idPelicula->id_pelicula,
                //'id_categoria' =>$request->categorias[$i]['id'],
                'id_categoria' => json_decode($request->categorias[$i]->id),
            ]);
        }*/
        return response()->json($response);
    }
    public function getCalificar($id)
    {
        $peliculas = Peliculas::select('pel_titulo')->where('id_pelicula', $id)->get();
        return response()->json($peliculas);
    }

    public function calificar(Request $request)
    {
        $respose = Calificacion::create([
            'cal_pelicula' => $request->selected_calificacion,
            'id_pelicula' => $request->idPelicula,
        ])->id;
        return response()->json($respose);
    }
    // metodo que me trae todas la calificaciones de las peliculas
    public function getCalificaciones()
    {
        $response = \DB::table('peliculas')
            ->join('calificacion', 'calificacion.id_pelicula', '=', 'peliculas.id_pelicula')
            ->select('calificacion.cal_pelicula', 'peliculas.pel_titulo')
            ->get();
        return response()->json($response);
    }
}
