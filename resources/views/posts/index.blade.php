@extends('layouts.app')

@section('content')
<div class="container">
    
      @foreach($posts as $post)
      <div class="row">
            <div class="offset-2 col-8">
            <a href="/profile/{{$post->user->id}}">
                <img class="w-100" src="/storage/{{$post->image}}" alt="img">
            </a>
                
            </div>
            <div class="col-2"> 
                <a href="#">Follow</a>
            </div>
            <div class="row">
                <div class="col-12">
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
                <hr>
                <div>
                   if we have  next post 

                </div>
            </div>
                </div>
            </div>
            
        </div>
      @endforeach
      
      <div class="row">
        <div class="col-12">
            <div class="w-100" style="width:200px;height:100px;">{{$posts->links()}}</div>
        </div>
      </div>      
    
</div>
@endsection
