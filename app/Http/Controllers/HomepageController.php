<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    //
    public function index(Request $request)
    {

        $menus = \App\Menu::where(['menu_location' => 'top', 'menu_position' => 'left', 'is_active' => 1])->first();
        $data = \App\Post::where('status', 'published')->where('visibility', 'public')->latest()->paginate(9);
        $featured = \App\Menufeatured::where('is_active', 1)->get();
        $slider = \App\Slider::where('status', 'published')->get();
        $config = \App\About::find(1);
        $judul = !empty($config) ? $config->title:'Gundala CMS';
        $tagline = !empty($config) ? $config->tagline:'Gundala CMS';
        $footer = !empty($config) ? $config->copyright:'GundalaCMS';

        // return $slider;

        return view('CMS.theme.default.index', compact('data', 'featured', 'slider', 'judul', 'tagline', 'footer', 'menus'));
    }
}
