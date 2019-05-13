<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

class Post {
	public $id;
	public $title;
	public $body;

	function __construct($id, $title, $body) {
		$this->id = $id;
		$this->title = $title;
		$this->body = $body;
	}
}

function getPosts() {
	$posts = array();
	array_push($posts, new Post(1, 'Post 1', 'Lorem ipsum dolor sit amet.'));
	array_push($posts, new Post(2, 'Post 2', 'Lorem ipsum dolor sit amet.'));
	return $posts;
}


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', function() {
	$posts = getPosts();
	return response()->json($posts);
});

Route::post('/posts', function(Request $request) {
	$body = $request->getContent();
	$data = json_decode($body);

	$post = new Post($data->id, $data->title, $data->body);
	return response()->json($post);
});

Route::get('/posts/{id}', function(int $id) {
	$posts = getPosts();
	$post = $posts[$id];
	return response()->json($post);
});

Route::delete('/posts/{id}', function(int $id) {
	$posts = getPosts();
	array_splice($posts, $id, 1);
	return response()->json($posts);
});

Route::patch('/posts/{id}', function(int $id, Request $request) {
	$posts = getPosts();
	$body = json_decode($request->getContent());

	$update = array_map(function($post) use ($id, $body) {
		if($post->id == $id) {
			return (object) array_merge((array) $post, (array) $body);
		} else {
			return $post;
		}
	}, $posts);

	return response()->json($update);
});













