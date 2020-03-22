{{-- <div class="container"> --}}


    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        {{-- <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
        </ol> --}}
        <div class="carousel-inner">
            @forelse ($slider as $item)
            <div class="carousel-item {{$item->ordered == 1 ? 'active':''}}">
                <a href="{{ $item->link !=null ? $item->link:'#' }}">
                <img class="d-block img-fluid" src="{{ $item->image !=null ? $item->image:'https://via.placeholder.com/1920x600.png/dc3545' }}" alt="{{ $item->title }}">
                {{-- <div class="container">
                  <div class="carousel-caption text-left">
                    <h1>Example headline.</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
                  </div>
                </div> --}}
                </a>
              </div>
            @empty
            <div class="carousel-item active">
                <img class="d-block img-fluid first-slide" src="https://via.placeholder.com/1920x600.png/ffc107/00000" alt="First slide">
                <div class="container">
                  <div class="carousel-caption text-center text-dark">
                    <h1>Demo Slide.</h1>
                    <p>Silakan login untuk memulai website Anda. Gunakan username: admin & kata sandi: password</p>
                  <p><a class="btn btn-lg btn-light" href="{{ route('login') }}" role="button">Mulai kelola website</a></p>
                  </div>
                </div>
              </div>
            @endforelse
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
    </div>
{{-- </div> --}}
