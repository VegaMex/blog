@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear post</h1>
@stop

@section('content')
    <p>Aquí se crean posts.</p>
    <div class="card">
        <div class="card-body">
            {!! Form::open([ 'route' => 'admin.posts.store', 'autocomplete' => 'off']) !!}
                {!! Form::hidden('user_id', auth()->user()->id) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del post']) !!}
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('slug', 'Slug') !!}
                    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del post', 'readonly']) !!}
                    @error('slug')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('category', 'Categoría') !!}
                    {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                    @error('category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror                    
                </div>
                <div class="form-group">
                    <p class="font-weight-bold">
                        Etiquetas
                    </p>
                    @foreach ($tags as $tag)
                        <label class="mr-2">
                            {!! Form::checkbox('tags[]', $tag->id, null) !!}
                            {{ $tag->name }}
                        </label>
                    @endforeach
                    @error('tags')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror                    
                </div>
                <div class="form-group">
                    <p class="font-weight-bold">
                        Estado
                    </p>
                    <label>
                        {!! Form::radio('status', 1, true) !!}
                        Borrador
                    </label>
                    <label>
                        {!! Form::radio('status', 2) !!}
                        Publicado
                    </label>                    
                </div>
                <div class="form-group">
                    {!! Form::label('extract', 'Extracto') !!}
                    {!! Form::textarea('extract', null, ['class' => 'form-control']) !!}
                    @error('extract')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror                    
                </div>
                <div class="form-group">
                    {!! Form::label('body', 'Cuerpo del post') !!}
                    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                    @error('body')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror                    
                </div>
                {!! Form::submit('Crear post', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/speakingurl/14.0.1/speakingurl.min.js"></script>
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-2.1.0/src/jquery.stringtoslug.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
    <script>
        $(document).ready( function() {
          $("#name").stringToSlug({
            setEvents: 'keyup keydown blur',
            getPut: '#slug',
            space: '-'
          });
        });
        ClassicEditor
            .create( document.querySelector( '#extract' ) )
            .catch( error => {
                console.error( error );
        } );
        ClassicEditor
            .create( document.querySelector( '#body' ) )
            .catch( error => {
                console.error( error );
        } );            
    </script>
@endsection