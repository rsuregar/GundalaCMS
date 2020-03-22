<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    //
    public function index()
    {
        $menus = \App\Menu::where(['menu_location' => 'top', 'menu_position' => 'left', 'is_active' => 1])->first();
        $data = \App\Post::where('status', 'published')->where('visibility', 'public')->paginate(9);
        $featured = \App\Menufeatured::where('is_active', 1)->get();
        $slider = \App\Slider::where('status', 'published')->get();
        $config = \App\About::find(1);
        $judul = $config->title;
        $tagline = $config->tagline;
        $footer = $config->copyright;

        return view('CMS.theme.default.index', compact('data', 'featured', 'slider', 'judul', 'tagline', 'footer', 'menus'));
    }
}
