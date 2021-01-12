@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <a class="btn btn-success float-right" href="{{ route('admin.posts.create') }}">Agregar post</a>
    <h1>Lista de posts</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <p>Aquí se listan posts.</p>
    @livewire('admin.posts-index')
@stop