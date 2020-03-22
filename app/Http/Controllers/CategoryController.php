<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Auth;

class CategoryController extends Controller
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
        $title = 'Manajemen Category';
        $data = Category::where('name', 'like','%'.$q.'%')->paginate(10);
        $data->appends(['search' => $q]);

        return view('CMS.theme.default.admin.Category.index', compact('title', 'data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Add New Category';
        return view('CMS.theme.default.admin.Category.form', compact('title'));
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
        Category::create([
            'name' => $request->name,
            'slug' => $request->name
        ]);
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($category)
    {
        //
        return $category = Category::with('blog', 'blog.author', 'blog.editor')->where('slug', $category)->firstOrFail();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        $title = 'Edit Category';
        $data = $category;
        return view('CMS.theme.default.admin.Category.form', compact('title', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        // return $request;
        try {
            $category->update([
                'name' => $request->name,
                'slug' => $request->slug != NULL ? $request->slug:$request->name
            ]);
            return redirect()->back();
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        // return $category;
        $category->delete();
        return redirect()->back();
    }
}
