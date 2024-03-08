@extends('layouts.users')

 @section('content')
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-header w3-center">
                    <h3>Edit Article</h3>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['articles.update', $article->id],'method' => 'post','enctype' => 'multipart/form-data']) !!}
                    <div class=" form-group">
                        {!! Form::label('title', 'Title', ['class' => 'w3-xlarge']) !!}
                        {!! Form::text('title', $article->title, ['class' => 'form-control']) !!}
                        @error('title')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class=" form-group">
                        {!! Form::label('body', 'Content:', ['class' => 'w3-xlarge']) !!}
                        {!! Form::textarea('body', $article->body, ['class' => 'form-control']) !!}
                        @error('body')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class=" form-group">
                        {!! Form::file('imaged', ['class' => 'mb-1']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Create', ['class' => 'btn btn-secondary']) !!}
                    </div>
                    @method('PUT')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

