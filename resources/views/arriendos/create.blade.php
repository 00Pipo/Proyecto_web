@extends('layouts.app')

@section('title', 'Arriendo de Vehiculo')

@section('content')
    <style>
        .preview-images-zone {
            width: 100%;
            border: 1px solid #ddd;
            min-height: 90px;
            padding: 5px 5px 0px 5px;
            position: relative;
            overflow: auto;
        }

        .preview-images-zone>.preview-image {
            height: 90px;
            width: 90px;
            position: relative;
            margin-right: 5px;
            float: left;
            margin-bottom: 5px;
        }

        .preview-images-zone>.preview-image>.image-zone {
            width: 100%;
            height: 100%;
        }

        .preview-images-zone>.preview-image>.image-zone>img {
            width: 100%;
            height: 100%;
        }

        .preview-images-zone>.preview-image>.image-cancel {
            font-size: 1.3rem;
            position: absolute;
            top: 0;
            right: 0;
            font-weight: bold;
            margin-right: 10px;
            cursor: pointer;
            display: none;
            z-index: 100;
            color: white;
            text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.9);
        }

        .preview-image:hover>.image-cancel {
            display: block;
        }
    </style>
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
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">{{ __('Arriendo de Vehiculo') }}</div>
                    <div class="card-body">
                        <form action="{{ route('arriendos.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="vehiculo_id"
                                        class="form-label @error('vehiculo_id') is-invalid @enderror">Vehiculo *</label>
                                    <select name="vehiculo_id" id="vehiculo_id" class="form-select">
                                        @foreach ($vehiculos as $vehiculo)
                                            <option value="{{ $vehiculo->id }}"
                                                {{ old('vehiculo_id') == $vehiculo->id ? 'selected' : '' }}>
                                                {{ $vehiculo->marca }} {{ $vehiculo->modelo }}</option>
                                        @endforeach
                                    </select>
                                    @error('vehiculo_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="vehiculohelp" class="form-text">
                                        Solamente se muestran los vehiculos disponibles
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="cliente_rut"
                                        class="form-label @error('cliente_rut') is-invalid @enderror">Cliente</label>
                                    <select name="cliente_rut" id="cliente_rut" class="form-select">
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->rut }}"
                                                {{ old('cliente_rut') == $cliente->rut ? 'selected' : '' }}>
                                                {{ $cliente->nombre }} - {{ $cliente->rut }}</option>
                                        @endforeach
                                    </select>
                                    @error('cliente_rut')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="clientehelp" class="form-text">
                                        Clientes ordenados por nombre
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="fecha_inicio"
                                            class="form-label @error('fecha_inicio') is-invalid @enderror">Fecha
                                            Inicio</label>
                                        <input type="date"
                                            class="form-control @error('fecha_inicio') is-invalid @enderror"
                                            id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}"
                                            min="{{ date('Y-m-d') }}">
                                        @error('fecha_inicio')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="fechainiciohelp" class="form-text">
                                            Fecha de inicio del arriendo
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="fecha_termino"
                                            class="form-label @error('fecha_termino') is-invalid @enderror">Fecha
                                            termino</label>
                                        <input type="date"
                                            class="form-control @error('fecha_termino') is-invalid @enderror"
                                            id="fecha_termino" name="fecha_termino" value="{{ old('fecha_termino') }}"
                                            min="{{ date('Y-m-d') }}">
                                        @error('fecha_termino')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="fechaterminohelp" class="form-text">
                                            Fecha de termino del arriendo
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="valor_total" class="form-label @error('valor_total') is-invalid @enderror">Valor
                                    total del
                                    Arriendo</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input placeholder="valor en pesos chilenos" type="number"
                                        class="form-control @error('valor_total') is-invalid @enderror" id="valor_total"
                                        name="valor_total" value="{{ old('valor_total') }}">
                                </div>
                                @error('valor_total')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                {{-- fotos de entrega --}}
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="pro-image"
                                            class="form-label @error('fotos_entrega') is-invalid @enderror">Foto
                                            Entrega *</label>
                                        <input type="file" required
                                            class="form-control @error('fotos_entrega') is-invalid @enderror" id="pro-image"
                                            name="fotos_entrega[]" multiple accept="image/*"
                                            aria-label="Seleccionar fotos de entrega">
                                        @error('fotos_entrega')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="preview-images-zone">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ route('arriendos.index') }}"
                                        class="btn btn-secondary">{{ __('Cancelar') }}</a>
                                    <button type="submit" class="btn btn-success">{{ __('Arrendar') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('pro-image').addEventListener('change', readImage, false);

                var previewImagesZone = document.querySelector('.preview-images-zone');
                var num = 1;

                function readImage() {
                    var files = event.target.files;

                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];
                        if (!file.type.match('image')) continue;

                        var picReader = new FileReader();
                        picReader.addEventListener('load', function(event) {
                            var picFile = event.target;
                            var html = `
                                <div class="preview-image preview-show-${num}">
                                    <div class="image-cancel" data-no="${num}">x</div>
                                    <div class="image-zone">
                                        <img id="pro-img-${num}" src="${picFile.result}">
                                    </div>
                                </div>
                            `;
                            previewImagesZone.insertAdjacentHTML('beforeend', html);
                            num = num + 1;
                        });

                        picReader.readAsDataURL(file);
                    }

                    previewImagesZone.addEventListener('click', function(event) {
                        if (event.target.classList.contains('image-cancel')) {
                            var no = event.target.getAttribute('data-no');
                            var deleteEl = document.querySelector(`.preview-image.preview-show-${no}`);
                            deleteEl?.remove();
                        }
                    });
                }
            });
        </script>
    @endsection
