@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <a class="btn btn-success float-right" href="{{ route('admin.tags.create') }}">Agregar etiqueta</a>
    <h1>Lista de etiquetas</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <p>Aquí se listan etiquetas.</p>
    <div class="card">
        <div class="card-body">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <td>{{ $tag->id }}</td>
                            <td>{{ $tag->name }}</td>
                            <td width="10px">
                                <a class="btn btn-primary" href="{{ route('admin.tags.edit', $tag) }}">Editar</a>
                            </td>
                            <td width="10px">
                                <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" type="submit">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>    
@stop