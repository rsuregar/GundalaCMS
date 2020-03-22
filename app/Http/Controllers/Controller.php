<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Meta;
use App\About;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // return About::all();
        $me = About::first();
        # Default title
        Meta::title(!empty($me) ? $me->title: env('APP_NAME'));

        # Default robots
        Meta::set('robots', 'index,follow');

        # Default image
        Meta::set('image', $me->logo ?? asset('CMS/theme/default/images/placeholder.jpg'));
    }
}
