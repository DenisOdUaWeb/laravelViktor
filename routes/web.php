<?php

use App\Mail\NewUserWelcomeMail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\ProfilesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
 //   return view('welcome');
//});
//Route::get('/', PostsController::class, 'index'); //was what on top (now it down)

Auth::routes();

Route::get('/email', function(){
    return new NewUserWelcomeMail();
});

Route::post('follow/{user}', [FollowsController::class, 'store'])->name('follow.store');


Route::get('/', [PostsController::class, 'index']); //was what on top
Route::post('/p', [PostsController::class, 'store']);
Route::get('/p/create', [PostsController::class, 'create']);
Route::get('/p/{post}', [PostsController::class, 'show']); //this taking anything inside {} so must be last one otherwise conflict



Route::get('/profile/{user}', [ProfilesController::class, 'index'])->name('profile.show');
Route::patch('/profile/{user}', [ProfilesController::class, 'update'])->name('profile.update');
Route::get('/profile/{user}/edit', [ProfilesController::class, 'edit'])->name('profile.edit');
