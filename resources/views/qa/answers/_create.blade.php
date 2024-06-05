<div class="row mt-4 justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Your Answer!</h3>
            </div>
            <div class="card-body">
                <form action="{{route('questions.answers.store',$question->id)}}" method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <input id="body" type="hidden" name="body" value="{{old('body')}}">
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

