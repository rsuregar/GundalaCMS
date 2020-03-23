@extends('CMS.theme.default.layouts.default')
@section('content')
<div class="hero-mini pb">
    <div class="container-fluid">
        <div class="row justify-content-center text-left">
            <div class="col-lg-10">
            <h1 class="blog-title">Arsip: {{ ucwords(Request::segment(1)) }} {{ isset($user) ? $user->name:$cat->name }}</h1>
            </div>
        </div>
    </div>
</div>
<section class="hero-mini-up">
    <div class="container-fluid">
        <div class="row justify-content-center">
        <div class="col-lg-10">
                <article class="article article-detail pl-4 pr-4 pt-5 pb-2">
                <div class="row justify-content-center">
                    @if (Request::segment(1) == 'author')
                        @foreach ($user->posts->sortByDesc('id') as $item)
                        <div class="col-md-3 col-xl-3 col-sm-6 col-xs-6 mb-5">
                            <a class="card post-preview lift h-100" href="{{ route('blog', $item->slug )}}"><img style="height:200px; object-fit:cover" class="card-img-top" src="{{ $item->thumbnail != NULL ? $item->thumbnail:asset('CMS/theme/default/images/placeholder.jpg') }}" alt="{{$item->title}}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->title }}</h5>
                                    <p class="card-text">{!! \Str::words(htmlspecialchars(trim(strip_tags($item->content))), 10, ' ...') !!}</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="post-preview-meta">
                                            <img class="post-preview-meta-img" style="object-fit:cover" src="https://i.pravatar.cc/100">
                                            <div class="post-preview-meta-details">
                                                <div class="post-preview-meta-details-name">{{ $item->user->name }}</div>
                                            <div class="post-preview-meta-details-date">{{ \Carbon\Carbon::parse($item->published_at)->translatedFormat('d M Y')}} · {{ \Carbon\Carbon::parse($item->published_at)->diffForHumans() }}</div>
                                            </div>
                                        </div>
                                    </div></a>
                        </div>
                        @endforeach
                    @else
                        @foreach ($cat->blog->sortByDesc('id') as $item)
                        <div class="col-md-3 col-xl-3 mb-5">
                            <a class="card post-preview lift h-100" href="{{ route('blog', $item->slug )}}"><img style="height:200px; object-fit:cover" class="card-img-top" src="{{ $item->thumbnail != NULL ? $item->thumbnail:asset('CMS/theme/default/images/placeholder.jpg') }}" alt="{{$item->title}}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->title }}</h5>
                                    <p class="card-text">{!! \Str::words(htmlspecialchars(trim(strip_tags($item->content))), 10, ' ...') !!}</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="post-preview-meta">
                                            <img class="post-preview-meta-img" style="object-fit:cover" src="https://i.pravatar.cc/100">
                                            <div class="post-preview-meta-details">
                                                <div class="post-preview-meta-details-name">{{ $item->user->name }}</div>
                                            <div class="post-preview-meta-details-date">{{ \Carbon\Carbon::parse($item->published_at)->translatedFormat('d M Y')}} · {{ \Carbon\Carbon::parse($item->published_at)->diffForHumans() }}</div>
                                            </div>
                                        </div>
                                    </div></a>
                        </div>
                        @endforeach
                    @endif
                </div>
                </article>
            </div>
        </div>
    </div>
</section>
@endsection
