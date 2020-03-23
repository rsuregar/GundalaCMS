<div class="col-md-4 widget-blog pl-4 pr-4">
    <hr class="featurette-divider d-block d-sm-none">
    {{-- title --}}
    {{-- <div class="widget-title divider left"><hr/><label>Seminar</label></div> --}}
    {{-- endtitle --}}

    {{-- content  --}}
    {{-- <section id="content" class="mb-5">
        <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
    </section> --}}
    {{-- endcontent  --}}
    @forelse (\App\Widget::where('status', 1)->where('show_at', 'like', '%page%')->orderBy('ordered')->get() as $item)
        @switch($item->widget_type)
            @case(1)
                @if ($item->title !=null)
                    {{-- title --}}
                    <div class="widget-title divider left"><label class="border-bottom">{{ ucwords(strtolower($item->title)) }}</label></div>
                    {{-- endtitle --}}
                @endif
                <section id="content" class="mb-5">
                    {!! $item->widget_content !!}
                </section>
                @break
            @case(2)
            @if ($item->title !=null)
                    {{-- title --}}
                    <div class="widget-title divider left"><label class="border-bottom">{{ ucwords(strtolower($item->title)) }}</label></div>
                    {{-- endtitle --}}
                @endif
            <section id="content" class="mb-5">
                <ul class="list-unstyled">
                    @foreach (\App\Menu::find($item->widget_content)->item->where('parent_id', 0)->where('is_active', 1)->sortBy('ordered') as $b)
                        <li class="media my-2 border-bottom">
                            <div class="media-body widget-link">
                            <a href="{{ $b->link }}"><h6 class="mt-0 mb-1" style="font-size:16px">{{ $b->name }}</h6></a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </section>
                @break
            @case(3)
                @if ($item->title !=null)
                    {{-- title --}}
                    <div class="widget-title divider left"><label class="border-bottom">{{ ucwords(strtolower($item->title)) }}</label></div>
                    {{-- endtitle --}}
                @endif
                {{-- content  --}}
                <section id="content" class="mb-5">
                    @php
                        $id = json_decode($item->widget_content);
                        if ($id[0] == 0) {
                            $blog = \App\Post::where(['status' => 'published', 'visibility' => 'public'])->limit($id[2])->orderBy('id', $id[1])->get();
                        } else {
                            // $blog = \App\Category::with('blog')->find($id[0]);
                            $blog = \App\Post::where(['status' => 'published', 'visibility' => 'public'])
                            ->with('categories')->whereHas('categories', function($q) use ($id){
                                $q->where('id', $id[0]);
                            })
                            ->limit($id[2])->orderBy('id', $id[1])->get();
                        }
                    @endphp
                    <ul class="list-unstyled">
                        @foreach ($blog as $el)
                        <li class="media my-4 border-bottom pb-2">
                        <img class="align-self-start mr-3" src="{{ $el->thumbnail != NULL ? $el->thumbnail:'https://via.placeholder.com/660x360.png' }}" style="height:60px; width:60px; object-fit:cover" alt="Generic placeholder image">
                            <div class="media-body widget-link">
                            <a href="{{ config('app.url').'/blog/'.$el->slug }}"><h6 class="mt-0 mb-1" style="font-size:14px">{{ $el->title }}</h6></a>
                                <p class="card-text">{!! \Str::words(htmlspecialchars(trim(strip_tags($el->content))), 10, ' ...') !!}</p>
                            </div>
                        </li>
                        @endforeach
                        {{-- <li class="text-right"><a href="#">Lihat semua</a></li> --}}
                    </ul>

                    {{-- <img class="featurette-image img-fluid mx-auto" data-src="holder.js/500x500/auto" alt="Generic placeholder image"> --}}
                </section>
                {{-- endcontent  --}}
                @break
            @case(4)
                @if ($item->title !=null)
                {{-- title --}}
                <div class="widget-title divider left"><label class="border-bottom">{{ ucwords(strtolower($item->title)) }}</label></div>
                {{-- endtitle --}}
                @endif
                <section id="content" class="mb-5">
                    {{-- <ul class="list-unstyled">
                        @foreach (\App\Category::orderBy('id', $item->widget_content)->get() as $a)
                        <li class="media my-2 border-bottom">
                            <div class="media-body widget-link">
                            <a href="{{ $item->link }}"><h6 class="mt-0 mb-1" style="font-size:16px">{{ $item->name }}</h6></a>
                            </div>
                        </li>
                        @endforeach
                    </ul> --}}
                    @foreach (\App\Category::whereHas('blog')->orderBy('id', $item->widget_content)->get() as $a)
                        <a href="#" type="button" class="btn btn-sm btn-primary" style="border-radius:10px">
                        {{ $a->name }} <span class="badge badge-light"> {{ $a->blog->count() }}</span>
                            {{-- <span class="sr-only">unread messages</span> --}}
                        </a>
                    @endforeach
                </section>
                @break
        @endswitch
    @empty
        <span class="text-muted">No widget found.</span>
@endforelse
</div>

