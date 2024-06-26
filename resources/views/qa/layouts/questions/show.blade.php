@extends('qa.layouts.app')
@section('page-level-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>{{ $question->title }}</h1>
                    </div>
                    <div class="card-body">
                        {!! $question->body !!}
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between mr-3">
                            <div>
                                <div class="d-flex">
                                    <div>
                                        @auth
                                            <form action="{{ route('questions.vote', [$question, 1]) }}" method="POST">
                                                @csrf
                                                <button type="submit" title="Up Vote"
                                                    class="vote-up d-block text-center {{ auth()->user()->hasUpVoteForQuestion($question) ? 'text-success' : 'text-dark' }}">
                                                    <i class="fa fa-caret-up fa-3x"></i>
                                                </button>
                                            </form>
                                            <h4 class="votes-count textmuted text-center m-0">{{ $question->votes_count }} </h4>
                                            <form action="{{ route('questions.vote', [$question, -1]) }}" method="POST">
                                                @csrf
                                                <button type="submit" title="Down Vote"
                                                    class="vote-up d-block text-center {{ auth()->user()->hasDownVoteForQuestion($question) ? 'text-danger' : 'text-dark' }}">
                                                    <i class="fa fa-caret-down fa-3x"></i>
                                                </button>
                                            </form>
                                        @endauth

                                    </div>
                                    <div
                                        class="m-4 text-center {{ $question->is_favorites ? 'text-warning' : 'text-black' }}">
                                        <form
                                            action="{{ route($question->is_favorites ? 'questions.unfavorite' : 'questions.favorite', $question) }}"
                                            method="post">
                                            @csrf
                                            @if ($question->is_favorites)
                                                @method('delete')
                                            @endif
                                            <button type="submit"
                                                title="{{ $question->is_favorites ? 'Mark as Unfav' : 'Mark as Fav' }}">
                                                <i class="fa fa-star fa-2x"></i>
                                                <h4>{{ $question->favorites_count }}</h4>
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <div class="text-muted mb-2 text-right">
                                    Asked At: {{ $question->created_date }}
                                </div>
                                <div class="d-flex mb-2 ">
                                    <div>
                                        <img src="{{ $question->owner->avatar }}"
                                            alt="Avatar of{{ $question->owner->name }}">
                                    </div>
                                    <div class="m-2">
                                        {{ $question->owner->name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('qa.answers._index')
        @include('qa.answers._create')

    </div>
@endsection
@section('page-level-scripts')
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
@endsection
