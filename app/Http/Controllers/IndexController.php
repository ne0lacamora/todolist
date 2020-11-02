<?php

namespace App\Http\Controllers;

use App\Tarea;
use Illuminate\Http\Request;

/**
 * Undocumented class
 * @ Controller
 */
class IndexController extends Controller
{
    /**
     * Undocumented function
     *
     * @return return
     */
    public function index()
    {
        // Fetch all the users's todos from the db
        $usuariosTarea = Tarea::where('id', '>', 0)->get();
        // Return the index page with the todos
        return view('welcome')->with($usuariosTarea);
    }
}
