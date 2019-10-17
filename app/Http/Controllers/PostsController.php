<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;

use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostsRequest;
use Illuminate\Support\Facades\Storage;
use JD\Cloudder\Facades\Cloudder;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        $image = $request->file('image')->getRealPath();
        Cloudder::upload($image, null);
        list($width, $height) = getimagesize($image);
        $publicId = Cloudder::getPublicId();
        $imageUrl = Cloudder::show($publicId, [
            'width'     => $width,
            'height'    => $height
        ]);
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $imageUrl,
            'publicid' => $publicId,
            'published_at' => $request->published_at,
            'category_id' => $request->category,
            'user_id' => auth()->user()->id
        ]);

        if($request->tags){
            $post->tags()->attach($request->tags);
        }

        session()->flash('success', 'Post Created Successfully.');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'content', 'published_at', 'category', 'tags']);

        if($request->hasFile('image')){
            Cloudder::destroyImage($post->publicid);
            $image = $request->file('image')->getRealPath();
            Cloudder::upload($image, null);
            list($width, $height) = getimagesize($image);
            $publicId = Cloudder::getPublicId();
            $imageUrl = Cloudder::show($publicId, [
                'width'     => $width,
                'height'    => $height
            ]);
            $data['image'] = $imageUrl;
            $data['publicid'] = $publicId;
        }

        if($request->tags){
            $post->tags()->sync($request->tags);
        }
        if($request->category){
            $post->category()->associate($request->category);
        }
        $post->update($data);
        session()->flash('success', 'Post Updated Successfully.');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if ($post->trashed()) {
            Cloudder::destroyImage($post->publicid);
            $post->forceDelete();
        }
        else {
            $post->delete();
        }

        session()->flash('success', 'Post Deleted Successfully.');
        return redirect(route('posts.index'));
    }

    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->withPosts($trashed); //  withPosts($trashed)はwith('posts', $trashed)と一緒
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();
        session()->flash('success', 'Post Restored Successfully.');
        return redirect()->back();
    }
}
