<?php

namespace App\Http\Controllers;

use App\Widget;
use Illuminate\Http\Request;

class WidgetController extends Controller
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
        $title = 'Manajemen Widget';
        $data = Widget::where('title', 'like','%'.$q.'%')->orWhere('show_at', 'like', '%'.$q.'%')->paginate(10);
        $data->appends(['search' => $q]);
        $tipe = collect(array('1' =>'HTML/Text', 'Menu', 'Recent Post', 'Archieve By Category'));
        // return $data;
        return view('CMS.theme.default.admin.Widget.index', compact('title', 'data', 'tipe'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Add New Widget';
        return view('CMS.theme.default.admin.Widget.form', compact('title'));
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
        $request->request->add(['show_at' => json_encode($request->show_at)]);
        if ($request->has('blog') && $request->blog == null) {
            $request->request->add(['widget_content' => json_encode($request->widget_content)]);
            $data = Widget::create($request->except('files', 'blog'));
        }else{
            $data = Widget::create($request->except('files', 'blog'));
        }
        // return $request;
        // $data = Widget::create($request->all());
        // return $request;
        return redirect()->route('widget.edit', $data->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function show(Widget $widget)
    {
        //

        return $widget;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function edit(Widget $widget)
    {
        //
        $data = $widget;
        $title = 'Edit Widget';
        return view('CMS.theme.default.admin.Widget.form', compact('data', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Widget $widget)
    {
        //
        $request->request->add(['show_at' => json_encode($request->show_at)]);
        $widget->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Widget  $widget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Widget $widget)
    {
        //
    }
}
