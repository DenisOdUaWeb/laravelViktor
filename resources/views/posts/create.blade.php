@extends('layouts.app')

@section('content')
<div class="container">
    
        <form action="/p" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row mb-3">
                        <label for="caption" class="col-md-4 col-form-label text-md-end">{{ __('Post Caption') }}</label>

                        <div class="col-md-6">
                            <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}"  autocomplete="caption">

                        @error('caption')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Post Image') }}</label>

                <input type="file" class="form-control-file" name="image" id="image">
                @error('image')
                        
                            <strong style="color:#dc3545">{{ $message }}</strong>
                        
                 @enderror
            </div>
            <div class="row">
                <button class="btn btn-primary m-4">Create new Post</button>
            </div>
        </form>
    
</div>
@endsection
