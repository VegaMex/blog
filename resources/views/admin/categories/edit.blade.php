@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar categoría</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <p>Aquí se editan categorías.</p>
    <div class="card">
        <div class="card-body">
            {!! Form::model($category, ['route' => ['admin.categories.update', $category], 'method' => 'PUT']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese nombre de la categoría']) !!}
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('slug', 'Slug') !!}
                    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ingrese nombre de la categoría', 'readonly']) !!}
                    @error('slug')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                {!! Form::submit('Actualizar categoría', ['class' => 'btn btn-primary']) !!}    
            {!! Form::close() !!}
        </div>
    </div>    
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/speakingurl/14.0.1/speakingurl.min.js"></script>
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-2.1.0/src/jquery.stringtoslug.js') }}"></script>
    <script>
        $(document).ready( function() {
          $("#name").stringToSlug({
            setEvents: 'keyup keydown blur',
            getPut: '#slug',
            space: '-'
          });
        });
    </script>
@endsection