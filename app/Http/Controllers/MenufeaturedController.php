<?php

namespace App\Http\Controllers;

use App\Menufeatured;
use Illuminate\Http\Request;
use Auth;

class MenufeaturedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $folder = 'Menufeatured';
    public function index(Request $request)
    {
        //
        $q = $request->input('search');
        $title = 'Manajemen Menu Featured';
        $data = Menufeatured::where('title', 'like','%'.$q.'%')->orWhere('subtitle', 'like', '%'.$q.'%')->paginate(10);
        $data->appends(['search' => $q]);
        return view(env('DEFAULT_ADMIN').$this->folder.'.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Add New '.$this->folder;
        return view(env('DEFAULT_ADMIN').$this->folder.'.form', compact('title'));
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
            'link' => $request->inlink != null ? $request->inlink:$request->exlink
        ]);
        // return $request;
        try {
            $save = Menufeatured::create($request->except('inlink', 'exlink'));
            return redirect()->route(strtolower($this->folder).'.edit', $save->id);
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menufeatured  $menufeatured
     * @return \Illuminate\Http\Response
     */
    public function show($menufeatured)
    {
        //
        $page = \App\Page::where('status', 'published')->get();
        $post = \App\Post::where('status', 'published')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menufeatured  $menufeatured
     * @return \Illuminate\Http\Response
     */
    public function edit(Menufeatured $menufeatured)
    {
        //
        $title = 'Edit '.$this->folder;
        $data = $menufeatured;
        return view(env('DEFAULT_ADMIN').$this->folder.'.form', compact('title', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menufeatured  $menufeatured
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menufeatured $menufeatured)
    {
        //


        if ($request->has('inlink') && $request->inlink !=null) {
            $request->request->add(['link' => $request->inlink]);
        } elseif($request->has('exlink') && $request->exlink != null) {
            $request->request->add(['link' => $request->exlink]);
        } else {
            $request->request->add(['link' => $request->current]);
        }

        // return $request;

        try {
            // Validate the value...
            $menufeatured->update($request->except('inlink', 'exlink', 'current'));
            return redirect()->back();
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menufeatured  $menufeatured
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menufeatured $menufeatured)
    {
        //
        $menufeatured->delete();
        return redirect()->back();
    }
}
