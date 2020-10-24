@extends('layouts.app')
@section('content')
    <section class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="jumbotron">
                        <h2 class="font-weight-light">Bienvenido: <b class="font-weight-bold">{{ Auth::user()->name }}</b></h2>
                        <p class="lead">En esta sección verás todas tus tareas creadas. Y su respectivo estado.</p>
                    </div>
                </div>
                <div class="col-sm-4">

                </div>
                <div class="col-sm-4">

                </div>
                <div class="col-sm-4">

                </div>
            </div>
        </div>
    </section>
@endsection
