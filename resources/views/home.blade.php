@extends('layouts.app')
@section('content')
    <section class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="jumbotron">
                        <h2 class="display-4">Bienvenido</h2>
                        <p class="lead text-primary">En esta sección veras todas tus tareas creadas.</p>
                    </div>
                </div>
            </div>
            <!-- General List of Tarea -->
            <single-list-component>
            </single-list-component>
        </div>
    </section>
@endsection
