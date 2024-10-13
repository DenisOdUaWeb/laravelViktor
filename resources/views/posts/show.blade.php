@extends('layouts.app')

@section('content')
<div class="container">
    
        <div class="row">
            <div class="col-6">
                <img class="w-100" src="/storage/{{$post->image}}" alt="img">
            </div>
            <div class="col-2"> 
                <a href="#">Follow</a>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-4">
                        <img class="w-100" src="{{$post->user->profile->profileImage()}}" alt="img">
                    </div>
                    <div class="col-8">
                        <h3>{{$post -> user -> username}}</h3>
                    </div>
                </div>
                <hr>
                <a href="/profile/{{$post->user->id}}">Author of the post</a>
                <div class="m-4">
                    <h3>post caption: </h3>
                    <p>{{$post -> caption}}</p>
                </div>
                
            </div>
        </div>
    
</div>
@endsection
