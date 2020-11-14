<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Post\Store;
use App\Http\Requests\Post\Update;
use App\Post;
use App\Http\Resources\Post as PostResource;

class PostController extends Controller
{
	public function index()
	{
		return PostResource::collection(Post::with('user')->get());
	}

	public function show($id)
	{
		$post = Post::with('user')->where('id', $id)->firstOrFail();
		return new PostResource($post);
	}

	public function store(Store $request){

		$validatedData = $request->validated();

		$post = Post::create($validatedData);

		return new PostResource($post);

	}

	public function update(Update $request, Post $post)
	{
		$post->update($request->validated());

		$post = Post::with('user')->where('id', $post->id)->firstOrFail();

		return new PostResource($post);
	}

	public function destroy(Post $post){

		$post->delete();

		return new PostResource($post);
	}
}
