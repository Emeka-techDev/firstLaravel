<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request) {
        $incomingFields = $request->validate([
            "title" => "required",
            "body" => "required"
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth() -> id();

        $post = Post::create($incomingFields);

        return redirect('/');
       


    }

    // public function displayAllPost() {
    //     $posts = Post::all();

    //     return redirect('/', $posts);
    // }



    public function showEditScreen(Post $post) {
        if ( auth()->user()->id !== $post['user_id'] ) {
            return redirect('/');
        }  

        return view('edit-post', ['post' => $post]);
    }

    public function submitEdit(Post $post, Request $request) {
        if ( auth()->user()->id !== $post['user_id'] ) {
            return redirect('/');
        } 
        
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
       
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $post->update($incomingFields);

        return redirect('/');
    }


    public function deletePost(Post $post) {
        if ( auth()->user()->id === $post['user_id'] ) {
            $post->delete();
        } 

        return redirect('/');
    }

// you can ignore the codes commmented below as different trial and attempts 
// to replicate result above in different way 



    // submit script
    // public function submitEdit(Request $request) {
    //     $id = $request->submitId;
    //     $post = Post::find($id);
    //     $post->update($post);
    // }    

    // public function deletePost(Request $request) {
    //     $postId = $request->id;
    //     $post = Post::find($postId);
        
    //     $post -> delete();
    // }

    // public function showEditScreen(Request $request) {
    //     $reqId = $request->post;
        
    //     $postToEdit = Post::find(reqId);


    //     return redirect('/editting-post', ["postToEdit" => $postToEdit]);
    // }

    // public function myEdit(Request $requeset) {
    //     $postToEdit = Post::find(reqId);
    //     $postToEdit->update($request);
    // }
    // myOwn submit script
    // public function submitEdit(Request $request) {
    //     $id = $request->submitId;
    //     $post = Post::find($id);
    //     $post->update($post);
    // }    

    // public function deletePost(Request $request) {
    //     $postId = $request->id;
    //     $post = Post::find($postId);
        
    //     $post -> delete();
    // }

    // public function showEditScreen(Request $request) {
    //     $reqId = $request->post;
        
    //     $postToEdit = Post::find(reqId);


    //     return redirect('/editting-post', ["postToEdit" => $postToEdit]);
    // }

    // public function myEdit(Request $requeset) {
    //     $postToEdit = Post::find(reqId);
    //     $postToEdit->update($request);
    // }
    // myOwn submit script
    // public function submitEdit(Request $request) {
    //     $id = $request->submitId;
    //     $post = Post::find($id);
    //     $post->update($post);
    // }    

    // public function deletePost(Request $request) {
    //     $postId = $request->id;
    //     $post = Post::find($postId);
        
    //     $post -> delete();
    // }

    // public function showEditScreen(Request $request) {
    //     $reqId = $request->post;
        
    //     $postToEdit = Post::find(reqId);


    //     return redirect('/editting-post', ["postToEdit" => $postToEdit]);
    // }

    // public function myEdit(Request $requeset) {
    //     $postToEdit = Post::find(reqId);
    //     $postToEdit->update($request);
    // }


    // public function editPost(Request $request) {
    //     $postId = $request -> Id();
    //     $post = Post::find($postId);
    //     $post -> update(['title' => 'updated Title']);

    //     $posts = Post::all();
    //     return redirect('/', $posts); 

    // }


}
