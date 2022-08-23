<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Request;

class PostController extends Controller
{
    public function create(PostRequest $request)
    {

        $post = new Post;

        $post->fill($request->all());
        $post->save();

        return response()->json($request);
    }

    public function listPosts(Request $request)
    {
        return response()->json(Post::all());
    }

    public function delete( $id)
    {
        $post=Post::find($id);
        $post->delete();
        
        return response()->json("Delete successful");
    }
}
