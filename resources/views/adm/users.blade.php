@extends('layouts.app')

@section('title', 'Administrar Usuarios')

@section('content')
    <div class="container my-4">
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center">{{ __('Administrar Usuarios') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('Rut') }}</th>
                                        <th>{{ __('Nombre') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Perfil') }}</th>
                                        <th>{{ __('Acciones') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->formatedRut() }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->perfil->nombre }}</td>
                                            <td>
                                                <a href="{{ route('admin.users.show', $user) }}"
                                                    class="btn btn-secondary btn-sm">{{ __('Detalles') }}</a>



                                                @if (Auth::user()->rut == $user->rut)
                                                    <a href="{{ route('perfil.editar', $user) }}"
                                                        class="btn btn-primary btn-sm">{{ __('Editar') }}</a>
                                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                        type="button" data-bs-target="#cantdeletemodal">
                                                        Eliminar
                                                    </button>
                                                @else
                                                    <a href="{{ route('admin.users.edit', $user) }}"
                                                        class="btn btn-primary btn-sm">{{ __('Editar') }}</a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $user->rut }}">
                                                        {{ __('Eliminar') }}
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal{{ $user->rut }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel{{ $user->rut }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $user->rut }}">
                                                            {{ __('Eliminar Usuario') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>{{ __('¿Estás seguro de que deseas eliminar este usuario?') }}
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
                                                        <form action="{{ route('admin.users.destroy', $user) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ __('Eliminar') }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Delete Modal -->
                                    @endforeach
                                    {{-- fun modal --}}
                                    <div class="modal fade" id="cantdeletemodal" tabindex="-1"
                                        aria-labelledby="deleteModalLabel{{ $user->rut }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $user->rut }}">
                                                        {{ __('Eliminar Usuario') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <p>No te puedes eliminar a ti mismo</p>
                                                    <img src="{{ asset('img/smiley.png') }}" alt="haha">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end fun modal --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">{{ __('Nuevo Usuario') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
