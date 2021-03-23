@extends('layouts.app')
@section('content')
    <header class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="jumbotron">
                        <h1 class="display-3 text-dark">Todo List</h1>
                        <p class="lead text-secondary">Este proyecto esta basado en un TODO LIST (Lista Para Hacer).</p>
                        <a href="/crear-tarea" class="btn btn-success text-capitalize">Crear Nueva Tarea</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="container-fluid">
        <tareas></tareas>
    </main>
@endsection
