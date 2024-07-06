@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Bienvenido') }}</div>
                    <div class="card-body">
                        <h3>Bienvenido a la aplicación arriendo vehiculos</h3>
                        <p>Hecho por Bruno</p>
                        <p>Tecnologias:</p>
                        <ul>
                            <li>Laravel 11.x</li>
                            <li>Bootstrap 5</li>
                            <li>MySQL</li>
                            <li>PHP 8.4</li>
                            <li>Node</li>
                            <li>Apache</li>
                        </ul>
                        <h5>Diseño y programacion Orientada a WEB</h5>
                        <p>Evaluación 3. Junio 2024</p>

                        <a class="btn btn-primary" href="{{ route('login') }}">Iniciar sesión</a>
                        <a class="btn btn-secondary" href="{{ route('register') }}">Registrarse</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
