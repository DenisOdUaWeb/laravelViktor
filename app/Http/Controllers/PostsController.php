<?php

namespace App\Http\Controllers;

//use App\Models\Post;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Events\PostWasCreatedEvent;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() //when we loged in 
    {
        $users = auth()->user()->following()->pluck('profiles.user_id'); //grab all our following users 
        //$posts = Post::whereIn('user_id', $users)->latest()->get(); //all their posts
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5); //paginated yo 5 their posts
        //latest() == orderBy('created_at, 'DESC')
        //>with('user') relationship Model/Post - 'user' method <$this->belongsTo(User::class)>

        //dd($posts);
        return view('posts/index', compact('posts'));

        //return view('/index');
    }

    public function create()
    {

        return view('posts/create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            //'image' => ['required', 'image'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("/storage/{$imagePath}"))->fit(1200, 1200); // important " "
        $image->save();


        // \App\Models\Post::create($data);
        //auth()->user()->posts()->create($data);
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);
        echo "BY by, REDIR ";

        event(new PostWasCreatedEvent($imagePath));
         PostWasCreatedEvent::dispatch($imagePath);
        //dd(request()->all());
        return redirect('/profile/' . auth()->user()->id);
        //dd(request()->all());
    }

    public function show(\App\Models\Post $post) //($post)!!!!!!  was like this (fetching only id ) and not given error 404 not found
    {
        //dd($post);
        return view('posts.show', compact('post')); // compact instead of array 
        //return view('posts/show', [
        //  'post' => $post,
        //]);
    }
}