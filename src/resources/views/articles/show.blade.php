@extends('layouts.users')

@section('content')
   <div class="card">
    <div class="card-header">
        {{ Str::ucfirst($article->title) }}
    </div>
    <div class="card-body">
        <p>{{ Str::ucfirst($article->body) }}</p>
    </div>
    <div class="card-footer">
        <a href="{{ route('articles.index') }}" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i></a>
    </div>
   </div>
@endsection
