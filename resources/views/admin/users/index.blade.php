@extends('adminlte::page')

@section('title', 'Blog')
    
@section('content_header')
    <h1>Lista de Usuarios</h1>
@endsection

@section('content')
    @livewire('admin.users-index')
@endsection