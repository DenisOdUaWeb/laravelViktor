<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index($user)
    {
        $user = User::findOrFail($user); // we can use \App\Models\Profile instead find or fail or find
        
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        //$postCount = $user->posts->count(); or CACHE:
        $postCount = Cache::remember('count.posts.'.$user->id, now()->addSeconds(30), function() use($user) {
            return $user->posts->count(); 
        });

        //$followersCount = $user->profile->followers->count(); OR CACHE
        $followersCount = Cache::remember('count.followers.'.$user->id, now()->addSeconds(30), function() use($user) {
            return $user->profile->followers->count(); 
        });

        //$followingCount = $user->following->count(); OR CACHE
        $followingCount = Cache::remember('count.following.'.$user->id, now()->addSeconds(30), function() use($user) {
            return $user->following->count(); 
        });

        //dd($follows);  // true or false (follow or not)
        
        return view('profiles/index', [ // compact('user', 'follows')); 
            'user' => $user,
            'follows' => $follows, // trans $follows to  the view
            'postCount' => $postCount,
            'followersCount' => $followersCount,
            'followingCount' => $followingCount,
        ]);
    }

    public function edit (\App\Models\User $user) // \App\Models\ no need as it exported (just User $user)
    {
        $this->authorize('update', $user->profile); // policy

        return view('profiles/edit', compact('user')); 
    }

    public function update(User $user) // \App\Models\User no need as its imported
    {
        $this->authorize('update', $user->profile);  // policy

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'required|url',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //dd($data);
        
        if(request('image')){
            $imagePath = request('image')->store('profile', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(300, 300);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }
        /*dd(array_merge(
            $data,
            ['image' => $imagePath]
        ));*/
        auth()->user()->profile->update(
            array_merge(
                $data,
                $imageArray ?? [],
            )
        );

        return redirect("/profile/{$user->id}");
    }
}
