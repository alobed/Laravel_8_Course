<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('posts', [
        'posts' => Post::all()
    ]);
});

/* Laravel smart enough to see the similaration between model and
 name of attribute to go and search for a post with the given id.

 This called Route Model Binding

 note: the name of the attribute should be the same of it's data type*/

Route::get('posts/{post}', function (Post $post) {
// it could also search by the slug  // Route::get('posts/{post:slug}', function (Post $post) { // Post::where('slug', $post)->firstOrFail()

    return view('post', [
        'post' => $post
    ]);
})->where('slug', '[A-z_\-]+');
// There are also a ready-made where functions like whereAlpha

Route::get('register',[RegisterController::class,'create'])->middleware('guest');
Route::post('register',[RegisterController::class,'store'])->middleware('guest');

Route::get('login',[RegisterController::class,'create'])->middleware('guest');
Route::post('login',[LoginController::class,'store'])->middleware('guest');
Route::post('logout',[LoginController::class,'destroy'])->middleware('auth');
