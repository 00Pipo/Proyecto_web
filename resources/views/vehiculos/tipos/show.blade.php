@extends('layouts.app')

@section('title', 'Tipo ' . $tipo->nombre)

@section('content')
    <div class="container py-3">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-12 col
        -md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">{{ __('Tipo ' . $tipo->nombre) }}</div>
                    <div class="card-body">
                        <p><strong>ID:</strong> {{ $tipo->id }}</p>
                        <p><strong>Nombre:</strong> {{ $tipo->nombre }}</p>
                        <p><strong>Creado:</strong> {{ $tipo->created_at }}</p>
                        <p><strong>Actualizado:</strong> {{ $tipo->updated_at }}</p>
                        <a class="btn btn-secondary" href="{{ route('tiposVehiculos.index') }}">Volver</a>
                        <a href="{{ route('tiposVehiculos.edit', $tipo) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('tiposVehiculos.destroy', $tipo) }}" method="POST"
                            style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
