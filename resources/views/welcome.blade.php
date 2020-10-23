<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'TODO List') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
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
    </body>
</html>
