<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostStoreRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Resources\Product\PostResource;
use App\Models\Product;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();
    }

    public function store(PostStoreRequest $request)
    {
        try {
            $imageName = Str::random(32) . "." . $request->image->getClientOriginalExtension();
            Post::create([
                'name' => $request->name,
                'image' => $imageName
            ]);
            // save image in storage folder
            Storage::disk('public')->put($imageName,file_get_contents($request->image));
       
        } catch (\Exception $e) {
            return response()->json(['message' => 'Post creation failed', 'error'], 500);
        }
    }

    
}
