@extends('layouts.app')
@section('content')
    <header class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="jumbotron">
                        <h1 class="display-3 text-dark">Todo List</h1>
                        <p class="lead text-secondary">Este proyecto esta basado en un TODO LIST (Lista Para Hacer).</p>
                        <a href="{{ route('home') }}" class="btn btn-success text-capitalize">Crear Nueva Tarea</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="text-capitalize text-dark">Últimas tareas creadas (Usuarios)</h2>
                    <p class="text-black-50 lead">Estas son las ultimas tareas creadas por nuestros usuarios.</p>
                </div>
            </div>
            <index-component></index-component>
        </div>
    </header>
@endsection
