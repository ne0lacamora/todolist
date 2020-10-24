<?php

use App\Tarea;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TareaIndividualController extends Controller
{

    /**
     * Requerir autenticación
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Mostrar las tareas del usuario individualmente
     * @return view
     */
    public function index()
    {
        // $tarea = Tarea::where('user_id', auth()->id())->get();
        return view('mis-tareas');
    }
}
