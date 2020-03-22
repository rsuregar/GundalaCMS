<?php

namespace App\Http\Controllers;

use App\About;
use App\Commentsetting;
use Auth;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $folder = 'About';
    public function index()
    {
        //
        $comment = Commentsetting::where('comment_type', '<>', 'google')->get();
        $data = About::find(1);
        $google = Commentsetting::where('comment_type', 'google')->first();
        // return $google;
        return view(env('DEFAULT_ADMIN').$this->folder.'.index', compact('data','comment', 'google'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    if ($request->current == 'comset') {
        $nav1 = '#';
        $nav2 = 'show active';
        $nav3 = '#';
        $save = Commentsetting::create($request->all());
        $comment = Commentsetting::where('comment_type', '<>', 'google')->get();
        return view(env('DEFAULT_ADMIN').$this->folder.'.index', compact('nav3', 'nav2', 'nav1', 'comment'));
    }elseif($request->current == 'google'){
        $nav1 = '#';
        $nav2 = '#';
        $nav3 = 'show active';
        $save = Commentsetting::create($request->all());
        $google = Commentsetting::where('comment_type', 'google')->first();
        return view(env('DEFAULT_ADMIN').$this->folder.'.index', compact('nav3', 'nav2', 'nav1', 'google'));
    }else{
        $nav1 = 'show active';
        $nav2 = '#';
        $nav3 = '#';
        $data = About::create($request->all());
        return view(env('DEFAULT_ADMIN').$this->folder.'.index', compact('nav3', 'nav2', 'nav1', 'data'));
    }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit($about)
    {
        //
        $comset = Commentsetting::find($about);
        $nav1 = '#';
        $nav2 = 'show active';
        $nav3 = '#';
        $comset = Commentsetting::find($about);
        $comment = Commentsetting::where('comment_type', '<>', 'google')->get();
        return view(env('DEFAULT_ADMIN').$this->folder.'.index', compact('nav3', 'nav2', 'nav1', 'comment', 'comset'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $about)
    {
        //
        // return $request;
        if ($request->current == 'comset') {
            // return $request;
            $nav1 = '#';
            $nav2 = 'show active';
            $nav3 = '#';
            $comment = Commentsetting::where('comment_type', '<>', 'google')->update(['status' => 0]);
            $find = Commentsetting::find($about)->update($request->all());
            // return $comment;
            // return view(env('DEFAULT_ADMIN').$this->folder.'.index', compact('nav3', 'nav2', 'nav1', 'comment'));
            return redirect()->back();
        }elseif($request->current == 'google'){
            // return $request;
            $nav1 = '#';
            $nav2 = '#';
            $nav3 = 'show active';
            $google = Commentsetting::find($about);
            $google->update($request->all());
            // return view(env('DEFAULT_ADMIN').$this->folder.'.index', compact('nav3', 'nav2', 'nav1', 'google'));
            return redirect()->route('about.index');
        }else{
            // return $request;
            $nav1 = 'show active';
            $nav2 = '#';
            $nav3 = '#';
            $data = About::find($about);
            $data->update($request->all());
            // return $data;
            // return view(env('DEFAULT_ADMIN').$this->folder.'.index', compact('nav3', 'nav2', 'nav1', 'data'));
            return redirect()->route('about.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        //
    }
}
