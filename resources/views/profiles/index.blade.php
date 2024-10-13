@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <!--<img class="w-100 rounded-circle p-4" src="/storage/{{$user->profile->image ?? 'profile/noimg.jpg'}}" alt="PROFILE IMG"> -->
            <img class="w-100 rounded-circle p-4" src="{{ $user->profile->profileImage() }}" alt="PROFILE IMG">
        </div>
        <div class="col-9 p-5">
            <div><h3>The username is:&nbsp {{$user->username}}</h3></div>
            <div><h3>The profile title is:&nbsp {{$user->profile->title ?? "N/A"}}</h3></div>
            
            @can('update',$user->profile) <!-- POLICY -->
                <div class="p-3"><a href="/p/create">Add New Post</a></div>
            @endcan

            @can('update',$user->profile)
                <div class="p-3"><a href="/profile/{{$user->id}}/edit"><h4>Edit Profile</h4></a></div>
            @endcan


            <!-- Should be the vue or some component down here -->
            <div class="row">
                <div class="col-6 m-4">
                    <button id="followBtn" onclick="followFunction()" class="btn btn-primary">Follow</button>
                    <script>
                        let followBtn = document.getElementById('followBtn');
                        function followFunction(){
                            axios.post("/follow/{{$user->id}}").then(response => {
                                console.log(response.data.attached[0]);
                                let btnText = response.data.attached[0] ? 'Unfollow' : 'Follow';
                                followBtn.textContent = btnText;

                            })
                            .catch(errors=>{
                                if(errors.response.status == 401){ 
                                    window.location = '/login';

                                }
                            });
                        }
                        
                    </script>
                </div>
            </div>



            <div class="d-flex justify-content-between">
                <div><strong>{{$postCount}}</strong>&nbsp posts</div>
                <div><strong>{{$followersCount}}</strong>&nbsp followers</div>
                <div><strong>{{$followingCount}}</strong>&nbsp following</div>
            </div>
            <div class="p-2 font-weight-bold??? text-uppercase">Laravel Projects</div>
            <div>
                <p>{{ $user->profile->description ?? "N/A"}}</p>
            </div>
            <div>
                <a href="{{$user->profile->url ?? 'https://www.google.com'}}">URL link: {{$user->profile->url ?? 'Google com' }}</a>
            </div>
        </div>
    </div>
    <div class="row pt-4" >
        @foreach($user->posts as $post)
        <div class=" pb-4 col-sm-12 col-md-6 col-xl-4">
            <a href="/p/{{$post->id}}"><img class="w-100" src="/storage/{{$post->image}}" alt="IMG"></a>
        </div>
        @endforeach
    </div>
</div>
@endsection
