{{-- <div class="container">
    <h2 class="product-header">
        Faetured Menu
      </h2>
</div> --}}
<div class="container">
    <div class="advantages">
        <div class="row justify-content-center m-0">
            @foreach ($featured as $item)
            <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-advantage">
                <i class="flaticon-responsive"></i>
                <a href="{{$item->link}}">
                    <div class="info-advantage">
                    <h4>{{$item->title}}</h4>
                    <p>{{\Str::words($item->subtitle, 10, ' ...')}}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
      </div>
    </div>
