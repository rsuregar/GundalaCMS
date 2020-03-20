@extends('CMS.theme.default.layouts.default')
@section('content')
<div class="hero-mini pb">
    <div class="container">
        {{-- <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="#"></a></li>
            </ol>
        </nav> --}}
        <div class="row justify-content-center text-left">
            <div class="col-lg-{{ $data->sidebar == 1 ? 12:10 }}">
                <h1 class="blog-title">{{ $data->title }}</h1>
                <small>Oleh <a href="#" style="color:white; text-decoration:none">{{ $data->user->name }}</a> <span class="ml-3">Dipublikasikan pada {{ \Carbon\Carbon::parse($data->published_at)->translatedFormat('d M Y') }}</span></small>
            </div>
        </div>
    </div>
</div>
<section class="hero-mini-up">
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-lg-{{ $data->sidebar == 1 ? 8:10 }}">
                <article class="article article-detail">
                    <figure class="article-image text-center">
                    <img style="object-fit:cover" src="{{ $data->thumbnail != NULL ? $data->thumbnail:'https://via.placeholder.com/660x360.png' }}" alt="{{ $data->title }}" class="img-fluid">
                    </figure>
                    <div class="p-5">
                        {{-- <div class="article-metas border-bottom pb-3">
                            <div class="article-meta">By <a href="javascript:;">Muhamad Nauval Azhar</a></div>
                            <div class="article-meta">Published at Jan 30, 2019</div>
                        </div> --}}
                        <div class="article-description">
                            {!! $data->content !!}
                        </div>
                    </div>
                </article>
                <hr class="featurette-divider">
                <p class="lead font-weight-bold">Related Post</p>
                @include('CMS.theme.default.components.blog-related')
                <hr class="featurette-divider">
                <p class="lead font-weight-bold">Berikan pendapat dan komentar kamu disini</p>
                @php
                    $commentId = 'facebook';
                    $title = 'http://mycms.id/blog/halo-ini-slug';
                @endphp
                @if ($commentId == 'facebook')
                {{-- <div class="fb-comments" data-href="{{ $title }}" data-width="550" data-numposts="5"></div> --}}
                <div class="fb-comments" data-href="{{ $title }}" data-width="720" data-numposts="5"></div>
                @else

                @endif
            </div>
            @if ($data->sidebar == 1)
                @include('CMS.theme.default.components.blog-widget')
            @endif
        </div>
    </div>
</section>
@endsection
