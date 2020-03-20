<?php

namespace App\Http\Controllers;

use App\Menuitem;
use Illuminate\Http\Request;

class MenuitemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $folder = 'menuitem';
    public function index()
    {
        //
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
        $request->request->add([
            'link' => $request->inlink != null ? $request->inlink:($request->has('exlink') ? $request->exlink:'#')
        ]);
        // return $request;
        try {
            $save = Menuitem::create($request->except('inlink', 'exlink'));
            return redirect()->back();
            // return redirect()->route(strtolower($this->folder).'.edit', $save->id);
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menuitem  $menuitem
     * @return \Illuminate\Http\Response
     */
    public function show(Menuitem $menuitem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menuitem  $menuitem
     * @return \Illuminate\Http\Response
     */
    public function edit(Menuitem $menuitem)
    {
        //
        $menuitem = $menuitem;
        $method = 'PATCH';
        $action = route('menuitem.update', $menuitem->id);
        return view('CMS.theme.default.admin.Menu.edit', compact('menuitem', 'method', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menuitem  $menuitem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menuitem $menuitem)
    {
        //
        $request->request->add(['link' => ($request->has('link') && $request->link != null) ? $request->link:$request->inlink ]);
        $menuitem->update($request->except('inlink'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menuitem  $menuitem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menuitem $menuitem)
    {
        //
        $menuitem->delete();
        return redirect()->back();
    }
}
