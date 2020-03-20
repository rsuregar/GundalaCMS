<div class="d-none d-sm-block">
    {{-- {{ $random }} --}}
    <div class="row pb-2">
        @forelse ($random as $item)
        <div class="col-lg-3 col-sm-6">
        <a href="{{ route('blog', $item->slug) }}" style="text-decoration: none;">
                <img class="rounded img-fluid mb-2" style="height:100px; object-fit:cover" src="{{ $item->thumbnail != NULL ? $item->thumbnail:'https://via.placeholder.com/660x360.png' }}">
                <p style="line-height: 11pt; font-size:11pt">{{ $item->title }}</p>
            </a>
        </div>
        @empty
        <div class="col-sm-12"><p class="text-muted">No related post found.</p></div>
        @endforelse
    </div>
    </div>
    <ul class="list-unstyled d-xl-none d-lg-none">
        @forelse ($random as $item)
        <li class="media border-bottom mb-2">
            <img class="mr-3 rounded img-fluid" style="max-width: 64px; max-height: 64px; object-fit:cover" src="{{ $item->thumbnail != NULL ? $item->thumbnail:'https://via.placeholder.com/660x360.png' }}" alt="Generic placeholder image">
            <a href="{{ route('blog', $item->slug) }}" style="text-decoration: none;">
                <div class="media-body">
                    <p style="line-height: 10pt; font-size: 10pt" class="mt-0 mb-1">{{ $item->title }}</p>
                </div>
            </a>
        </li>
        @empty
        <li class="col-sm-12"><p class="text-muted">No related post found.</p></li>
        @endforelse
    </ul>

