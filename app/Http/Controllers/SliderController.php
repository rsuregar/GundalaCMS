<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Auth;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $folder = 'Slider';
    public function index(Request $request)
    {
        $q = $request->input('search');
        $title = 'Manajemen '.$this->folder;
        $data = Slider::where('title', 'like','%'.$q.'%')->orWhere('status', 'like', '%'.$q.'%')->orderBy('ordered')->paginate(10);
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
            'status' => $request->has('publish') ? 'published':'draft',
            'author' => Auth::id()
        ]);
        try {
            $save = Slider::create($request->except('publish', 'draft'));
            return redirect()->route('slider.index');
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        $title = 'Edit '.$this->folder;
        $data = $slider;
        return view(env('DEFAULT_ADMIN').$this->folder.'.form', compact('title', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        //
        $request->request->add([
            'status' => $request->has('publish') ? 'published':'draft'
        ]);
        try {
            $slider->update($request->except('publish'));
            return redirect()->route('slider.index');
        } catch (Exception $e) {
            report($e);
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        //
        $slider->delete();
        return redirect()->back();
    }
}
