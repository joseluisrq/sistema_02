<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class CursoControlador extends Controller
{
    public function index(Request $request)
    {
       $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $cursos = Curso::select(
                'idespecialidad', 
                'nombre_es', 
                'abreviatura_es', 
                'descripcion_es', 
                'duracion_es' )
            ->orderBy('idespecialidad', 'desc')->paginate(30);
        }
        else if($criterio=='nombre_es' || $criterio=='abreviatura_es'  || $criterio=='descripcion_es'){
                $cursos = Curso::select(
                'idespecialidad', 
                'nombre_es', 
                'abreviatura_es', 
                'descripcion_es', 
                'duracion_es')
                ->where($criterio, 'like', '%'. $buscar . '%')
                ->orderBy('idespecialidad', 'asc')->paginate(10);
            }  
        return [
            'pagination' => [
                'total'        => $cursos->total(),
                'current_page' => $cursos->currentPage(),
                'per_page'     => $cursos->perPage(),
                'last_page'    => $cursos->lastPage(),
                'from'         => $cursos->firstItem(),
                'to'           => $cursos->lastItem(),
            ],
            'cursos' => $cursos
        ];
    



    } 
}
