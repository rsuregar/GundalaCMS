<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Auth;
use Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('GlobalOwnership', ['except' => ['index', 'create', 'store', 'show']]);
    }

    public function index(Request $request)
    {
        //
        $q = $request->input('search');
        $title = 'Manajemen Page';
        $data = Page::where('title', 'like','%'.$q.'%')->orWhere('status', 'like', '%'.$q.'%')->paginate(10);
        $data->appends(['search' => $q]);
        return view('CMS.theme.default.admin.Page.index', compact('title', 'data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add New Page';
        return view('CMS.theme.default.admin.Page.form', compact('title'));
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
            'status' => $request->has('publish') ? 'published':'draft',
        ]);

        try {
            // Validate the value...
            $save = Page::create($request->except('publish', 'draft', 'files'));
            return redirect()->route('page.edit', $save->id);
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show($page)
    {
        //
        $data = Page::where(['slug' => $page, 'status' => 'published'])->firstOrFail();
        $judul = $data->title;
        return view('CMS.theme.default.page', compact('data', 'judul'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //
        $title = 'Edit Page';
        $data = $page;
        return view('CMS.theme.default.admin.Page.form', compact('title', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        //
        $request->request->add([
            'slug' => $request->slug,
            'status' => $request->has('publish') ? 'published':'draft',
        ]);

        try {
            // Validate the value...
            $page->update($request->except('publish', 'draft', 'files'));
            return redirect()->back();
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
        $page->delete();
        return redirect()->back();
    }
}
