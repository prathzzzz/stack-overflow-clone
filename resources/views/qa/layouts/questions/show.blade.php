@extends('qa.layouts.app')
@section('page-level-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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
                                        <a href="#" title="Up Vote" class="vote-up d-block text-center text-dark">
                                            <i class="fa fa-caret-up fa-3x"></i>
                                        </a>
                                        <h4 class="votes-count textmuted text-center m-0">{{ $question->votes_count }} </h4>
                                        <a href="#" title="Down Vote" class="vote-up d-block text-center text-dark">
                                            <i class="fa fa-caret-down fa-3x"></i>
                                        </a>
                                    </div>
                                    <div class="m-4">
                                        <a href="#" title="Mark as Fav">
                                            <i class="fa fa-star fa-2x text-dark"></i>
                                        </a>
                                        <h4>123</h4>
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

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ Str::plural('Answer', $question->answers_count) }}</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($question->answers as $answer)
                            {!! $answer->body !!}
                            <div class="d-flex justify-content-between mr-3">
                                <div></div>
                                <div class="d-flex flex-column">
                                    <div class="text-muted mb-2 text-right">
                                        Answered At: {{ $answer->created_date }}
                                    </div>
                                    <div class="d-flex mb-2">
                                        <div>
                                            <img src="{{ $answer->author->avatar }}"
                                                alt="Avatar of{{ $answer->author->name }}">
                                        </div>
                                        <div>
                                            <div class="m-2">
                                                {{ $answer->author->name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
