<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $title = 'Manajemen Menu';
        $action = $request->action;
        $data = Menu::all();
        $menu = [];
        $get = Menu::find($request->menu_id);
        return view('CMS.theme.default.admin.Menu.index', compact('data', 'title', 'action', 'get', 'menu'));
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
        if ($request->action == 'location') {
            $update = Menu::find($request->id)->update($request->only('menu_location'));
            return redirect()->back();
        }
        $save= Menu::create($request->all());
        $url = url()->current().'?action=edit&menu_id='.$save->id;
        return redirect($url);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
        if ($request->is_active == 1) {
            $set = Menu::where('is_active', 1)->update(['is_active' => 0]);
            $menu->update($request->except('action'));
        }
        $menu->update($request->except('action'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
        $menu->forceDelete();
        return redirect()->route('menu.index');
    }
}
