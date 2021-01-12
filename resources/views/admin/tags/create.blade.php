@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear etiquetas</h1>
@stop

@section('content')
    <p>Aquí se crean etiquetas.</p>
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.tags.store']) !!}
                @include('admin.tags.partials.form')
                {!! Form::submit('Crear etiqueta', ['class' => 'btn btn-primary']) !!}    
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