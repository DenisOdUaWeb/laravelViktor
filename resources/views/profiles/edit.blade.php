@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h2>Edit Profile</h2>
        <div class="col-6">
        <form action="/profile/{{$user->id}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-10 offset-2">
                    <div class="row mb-3">
                        <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Profile Title') }}</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $user->profile->title }}"  autocomplete="title">

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-10 offset-2">
                    <div class="row mb-3">
                        <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Profile Description') }}</label>

                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? $user->profile->description }}"  autocomplete="description">

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-10 offset-2">
                    <div class="row mb-3">
                        <label for="url" class="col-md-4 col-form-label text-md-end">{{ __('Profile Url') }}</label>

                        <div class="col-md-6">
                            <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') ?? $user->profile->url }}"  autocomplete="url">

                        @error('url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Profile Image') }}</label>

                <input type="file" class="form-control-file" name="image" id="image">
                @error('image')
                        
                            <strong style="color:#dc3545">{{ $message }}</strong>
                        
                 @enderror
            </div>
            <div class="row">
                <button class="btn btn-primary m-4">Update Profile</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
