<?php

namespace App\Http\Controllers;

use App\Tarea;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TareaController extends Controller
{

    /**
     * Requerir autenticación
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Here we return the User ID
        return DB::table('tareas')
        ->join('users', 'tareas.user_id', '=', 'users.id')
        ->select('users.id', 'users.name', 'users.email', 'tareas.*',)
        ->where('user_id', auth()->id())
        // ->orderBy('updated_at', 'DESC')
        ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'descripcion' => 'required',
            'estado' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('crear-tarea')->withErrors($validator)->withInput();
        }

        // Creamos una nueva tarea
        $tarea = new Tarea();

        /**
         * Hacemos una solicitud de los campos, y guardamos sus datos.
         * El user_id es el usuario el cual esta creando su nueva tarea, de esta manera cada usuario conserva su propia tarea
         * y no puede acceder a ella y/o verla si no esta autenticado.
         * Cada usuario posee sus tareas en particular.
         * nadie mas puede verlas.
         */
        $tarea->nombre = $request->nombre;
        $tarea->descripcion = $request->descripcion;
        $tarea->estado = $request->estado;
        $tarea->user_id = auth()->id();
        $tarea->save();

        return $tarea;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tarea = Tarea::find($id);
        $tarea->nombre = $request->nombre;
        $tarea->descripcion = $request->descripcion;
        $tarea->estado = $request->estado;
        $tarea->save();

        return $tarea;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tarea = Tarea::find($id);
        $tarea->delete();
    }
}
