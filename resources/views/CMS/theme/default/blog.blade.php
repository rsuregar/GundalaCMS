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
            <small>Oleh <a href="{{ route('user.show', $data->user->username) }}" style="color:white; text-decoration:none">{{ $data->user->name }}</a> <span class="ml-3">Dipublikasikan pada {{ \Carbon\Carbon::parse($data->published_at)->translatedFormat('d M Y') }}</span></small>
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
                    <img style="object-fit:cover" src="{{ $data->thumbnail != NULL ? $data->thumbnail:asset('CMS/theme/default/images/placeholder.jpg') }}" alt="{{ $data->title }}" class="img-fluid">
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
                    $comment = \App\Commentsetting::where('status', 1)->first();
                @endphp
                @if ($comment->status == 1 && $comment->comment_type == 'facebook')
                <div class="fb-comments" data-href="{{ url()->full() }}" data-width="720" data-numposts="5"></div>
                @else
                    <div class="mb-4" id="disqus_thread"></div>
                @endif
            </div>
            @if ($data->sidebar == 1)
                @include('CMS.theme.default.components.blog-widget')
            @endif
        </div>
    </div>
</section>
@endsection
@push('script')
@if ($comment->comment_type == 'disqus' && $comment->status == 1)
<script>
    var disqus_config = function () {
    this.page.url = '{{ env('APP_URL')}}';  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = '{{ env('APP_URL')}}'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };

    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = '{{$comment->appId}}/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<script id="dsq-count-scr" src="{{$comment->appId}}/count.js" async></script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
@endif
@endpush
