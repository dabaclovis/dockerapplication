@extends('layouts.users')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header w3-teal w3-xlarge w3-padding-24">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in as Normal USer with !') }}
                    <hr>

                   {{-- {{ dd($users) } --}}
                        @if (count($articles) > 0)
                            @foreach ($articles as $article)
                                <div class=" d-flex justify-content-between mb-1">
                                    <div class="">
                                        <a href="{{ route('articles.show',$article->id) }}">{{ Str::ucfirst($article->title) }}</a>
                                    </div>
                                    @if (Auth::user()->id == $article->user_id)
                                        <div class="row">
                                            <a href="{{ route('articles.show',$article->id) }}" class=" btn-sm btn-success mx-1">show</a>
                                            <a href="{{ route('articles.edit',$article->id) }}" class=" btn-sm btn-success mx-1"><i
                                                    class="fa fa-edit fa-xs fa-fw"></i></a>
                                            <form action="{{ route('articles.destroy', $article->id) }}" method="post">
                                                @csrf
                                                <small>
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                </small>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class=" d-flex justify-content-center text-info">
                                <p>{{ __('You have no Article Created') }}</p>
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
@endsection
