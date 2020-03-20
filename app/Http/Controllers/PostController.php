<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Auth;
use DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $q = $request->input('search');
        $title = 'Manajemen Post';
        $data = Post::where('title', 'like','%'.$q.'%')->orWhere('status', 'like', '%'.$q.'%')->paginate(10);
        // $data = Post::with('categories')->where('title', 'like','%'.$q.'%')->join('users', 'author', '=', 'users.id')->orWhere('name', 'like', '%'.$q.'%')->orWhere('status', 'like', '%'.$q.'%')->paginate(10);

        $data->appends(['search' => $q]);

        return view(env('DEFAULT_ADMIN').'Post.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Add New Post';
        return view(env('DEFAULT_ADMIN').'Post.form', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->request->add([
            'slug' => $request->title,
            'author' => Auth::id(),
            'editor' => Auth::id(),
            'status' => $request->has('publish') ? 'published':'draft',
            'published_at' => $request->has('publish') ? now():NULL,
            'date_created' => date('Y')
        ]);

        try {
            $save = Post::create($request->except('category_id', 'publish', 'draft', 'files'));
            $save->categories()->attach($request->category_id);
            return redirect()->route('post.edit', $save->id);
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        //
        $data = Post::where(['slug' => $post, 'status' => 'published'])->firstOrFail();
        $random = Post::where('slug', '<>', $post)->where('status', 'published')->inRandomOrder()->limit(4)->get();
        // return $random;
        $judul = $data->title;
        // return $title;
        return view('CMS.theme.default.blog', compact('data', 'random','judul'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        $title = 'Edit Post';
        $data = $post;
        return view(env('DEFAULT_ADMIN').'Post.form', compact('title', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        $request->request->add([
            'slug' => $request->slug,
            'editor' => Auth::id(),
            'status' => $request->has('publish') ? 'published':'draft',
            'published_at' => $request->has('publish') ? now():NULL,
        ]);

        try {
            // Validate the value...
            $post->categories()->sync($request->category_id);
            $post->update($request->except('category_id', 'publish', 'draft', 'files'));
            return redirect()->back();
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return redirect()->back();
    }
}
