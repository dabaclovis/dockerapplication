@extends('layouts.public')

@section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-header w3-center">
                    <h3>Create Article</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'articles.store','method' => 'post','enctype' => 'multipart/form-data']) !!}
                        <div class=" form-group">
                            {!! Form::label('title', 'Title', ['class' => 'w3-xlarge']) !!}
                            {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            @error('title')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class=" form-group">
                            {!! Form::label('body', 'Content:', ['class' => 'w3-xlarge']) !!}
                            {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                            @error('body')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class=" form-group">
                            {!! Form::file('imaged',  ['class' => 'mb-1']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Create', ['class' => 'btn btn-secondary']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
