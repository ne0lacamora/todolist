@extends('layouts.app')
@section('content')
    <header class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="jumbotron">
                        <h1 class="display-4">Todo List</h1>
                        <p class="lead">Este proyecto esta basado en un TODO LIST (Lista Para Hacer).</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">Crear Nueva Tarea</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection
