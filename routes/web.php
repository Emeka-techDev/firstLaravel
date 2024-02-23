<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

// home page
Route::get('/', function () {
    // post is defined outside the if statement so line 36 doesnt throw an undefined  error for $post
    $posts = [];
    
    // check if the user is authentication if not display the normal home page without posts
    if (auth() -> check()) {
        // authenticate the user, then use the userPost method declared in the User model and display all the
        // post by that particular user
       
        // another way to do this is User::userPost()->latest()->get() (i made this)
        // tho my issue would be how then do we authenticate the user maybe an Id parameter would be passed to the userPost method;

        $posts = auth()->user()->usersPost()->latest()->get();
        // another way to do this is the commented method below;
        // $posts =  Post::where('user_id', auth()-> id())->get();

    }

    return view('home', ['posts' => $posts]);
    
});



// User authentication
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

 
// Blog post
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'submitEdit']);
//Route::put('/edit-completed', [PostController::class, 'submitEdit']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);



 
//this route can be used to get all the post by everyone in the database
// you can uncomment to test it 
// Route::get('/get-all-post', function () {
//     $posts =  Post::all();
//     return view('home', ['posts' => $posts]);
// }); 


// Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
// Route::post('/editting-post', [PostController::class, 'myEdit'])