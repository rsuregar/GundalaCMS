@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard Menu</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row justify-content-center">
						<div class="col-6 col-sm-4 col-lg-2 mb-4">
                            <a style="text-decoration:none" href="{{ route('post.index') }}">
                                <div class="card">
                                    <div class="card-body p-3 text-center">
                                    <div class="h1 m-0 mt-3">{{ \App\Post::all()->count() }}</div>
                                        <div class="text-muted mb-3">Post</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-sm-4 col-lg-2 mb-4">
                            <a style="text-decoration:none" href="{{ route('page.index') }}">
                                <div class="card">
                                    <div class="card-body p-3 text-center">
                                        <div class="h1 m-0 mt-3">{{ \App\Page::all()->count() }}</div>
                                        <div class="text-muted mb-3">Page</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-sm-4 col-lg-2 mb-4">
                            <a style="text-decoration:none" href="{{ route('menu.index') }}">
                                <div class="card">
                                    <div class="card-body p-3 text-center">
                                        <div class="h1 m-0 mt-3">{{ \App\Menu::all()->count() }}</div>
                                        <div class="text-muted mb-3">Menu</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-sm-4 col-lg-2 mb-4">
                            <a style="text-decoration:none" href="{{ route('slider.index') }}">
                                <div class="card">
                                    <div class="card-body p-3 text-center">
                                        <div class="h1 m-0 mt-3">{{ \App\Slider::all()->count()+\App\Post::where('is_slider', 1)->get()->count() }}</div>
                                        <div class="text-muted mb-3">Slider</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-sm-4 col-lg-2 mb-4">
                            <a style="text-decoration:none" href="{{ route('widget.index') }}">
                                <div class="card">
                                    <div class="card-body p-3 text-center">
                                        <div class="h1 m-0 mt-3">{{ \App\Widget::all()->count() }}</div>
                                        <div class="text-muted mb-3">Widget</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-sm-4 col-lg-2 mb-4">
                            <a style="text-decoration:none" href="{{ route('category.index') }}">
                                <div class="card">
                                    <div class="card-body p-3 text-center">
                                        <div class="h1 m-0 mt-3">{{ \App\Category::all()->count() }}</div>
                                        <div class="text-muted mb-3">Category</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-sm-4 col-lg-2 mb-4">
                            <a style="text-decoration:none" href="{{ route('menufeatured.index') }}">
                                <div class="card">
                                    <div class="card-body p-3 text-center">
                                        <div class="h1 m-0 mt-3">{{ \App\Menufeatured::all()->count() }}</div>
                                        <div class="text-muted mb-3">Featured Menu</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        {{-- <div class="col-6 col-sm-4 col-lg-2 mb-4">
                            <a style="text-decoration:none" href="{{ route('media.index') }}">
                                <div class="card">
                                    <div class="card-body p-3 text-center">
                                        <div class="h1 m-0 mt-3">&elinters;</div>
                                        <div class="text-muted mb-3">Gallery & Media</div>
                                    </div>
                                </div>
                            </a>
                        </div> --}}
                        <div class="col-6 col-sm-4 col-lg-2 mb-4">
                            <a style="text-decoration:none" href="{{ route('user.index') }}">
                                <div class="card">
                                    <div class="card-body p-3 text-center">
                                        <div class="h1 m-0 mt-3">{{ \App\User::all()->count() }}</div>
                                        <div class="text-muted mb-3">User Account</div>
                                    </div>
                                </div>
                            </a>
						</div>
                        <div class="col-6 col-sm-4 col-lg-2 mb-4">
                            <a style="text-decoration:none" href="{{ route('about.index') }}">
                                <div class="card">
                                    <div class="card-body p-3 text-center">
                                        <div class="h1 m-0 mt-3">&notinE;</div>
                                        <div class="text-muted mb-3">General Setting</div>
                                    </div>
                                </div>
                            </a>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
