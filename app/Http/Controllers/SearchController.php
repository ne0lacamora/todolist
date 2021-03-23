<?php

namespace App\Http\Controllers;

use App\Events\SearchEvent;
use Illuminate\Http\Request;
use App\Tarea;
// use App\User;

class SearchController extends Controller
{
    public function search(Request $request) {
        // search form
        $query = $request->query("query");
        // query
        $tareas = Tarea::where("nombre", "LIKE", "%" . $query . "%")->orWhere("descripcion", "LIKE", "%" . $query . "%")->get();
        // broadcast search results with Pusher channels
        event(new SearchEvent($tareas));
        // response
        return response()->json("ok");
    }

    public function get(Request $request) {
        $tareas = Tarea::all();

        return response()->json($tareas);
    }
}
