@extends('qa.layouts.app')
@section('page-level-styles')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">

@endsection
@section('content')
    <div class="row mt-4 justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Answer!</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('questions.answers.update',[$question->id,$answer->id])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-4">
                            <input id="body" type="hidden" name="body" value="{{old('body',$answer->body)}}">
                            <trix-editor input="body"
                                         class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"></trix-editor>

                            @error('body')
                            <div class="text-danger text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>

@endsection
@section('page-level-scripts')
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
@endsection
