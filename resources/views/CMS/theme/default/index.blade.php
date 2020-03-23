@extends('CMS.theme.default.layouts.default')
@section('content')
@include('CMS.theme.default.components.slider')
@if($featured->count() > 0)
@include('CMS.theme.default.components.featured-menu')
@endif
{{-- <br> --}}

<div class="container mt-5">
    {{-- <hr class="featurette-divider"> --}}
    <h2 class="product-header mt-5">
        Berita Terkini
      </h2>
</div>
  <div class="container marketing" style="margin-top:-80px">
      <br>
    <div class="row justify-content-center featurette">
      <div class="col-md-8">
        <hr class="featurette-divider">
        <div class="row justify-content-center">
            @forelse ($data as $item)
            <div class="col-md-6 col-xl-6 mb-5">
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
            @empty
                <div class="text-center">Belum Ada Postingan.</div>
            @endforelse
        </div>
        <div class="text-center">
            {{ $data->links() }}
        </div>
      </div>
      @include('CMS.theme.default.components.widget')
    </div>

    {{-- <hr class="featurette-divider">
    <div class="row ustify-content-center featurette">

      <div class="col-md-7">
        <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>
      <div class="col-md-5">
        <div class="widget-title divider left">
            <hr/>
            <label>Seminar</label>
        </div>
        <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
      </div>
    </div> --}}
    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->
@endsection
