@extends('layouts.app')
@section('content')
    <section class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="jumbotron">
                        <h2 class="display-3 text-primary">Mis Tareas</h2>
                        <p class="lead text-primary">En esta sección veras todas tus tareas.</p>
                        <a href="/crear-tarea" class="btn btn-primary text-capitalize">Crear Nueva Tarea</a>
                    </div>
                </div>
            </div>
            <!-- Lista general de tarea -->
            <lista-usuarios-component>
            </lista-usuarios-component>
        </div>
    </section>
@endsection
