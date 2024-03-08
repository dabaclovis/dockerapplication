@extends('layouts.users')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Articles</h3>
            <a href="{{ route('articles.create') }}" class=" btn btn-link"> <small> Create Article</small></a>
        </div>
    </div>
    <br>
    <br>
    <hr>
    @foreach ($articles as $article)
        <div class="form-group d-flex justify-content-between w3-light-gray">
            <div class="">
                <a href="{{ route('articles.show',$article->id) }}" class=" btn btn-link">{{ Str::ucfirst($article->title) }}</a>
            </div>
            <div class=" mt-1">{{ $article->user->name }}</div>
        </div>
    @endforeach
@endsection
