<div class="sidebar-item">
    <div class="make-me-sticky">
      {{-- <div class="card">
        <div class="card-header">Quick  Menu</div> --}}
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action disabled bg-light font-weight-bold">
                Quick Menu
            </a>
            <a href="{{ route('home.index') }}" class="list-group-item list-group-item-action font-weight-bold">
                Dashboard
            </a>
            @php
                $menu = collect([
                    ['path' => 'post', 'route' => 'post.index', 'name' => 'Create Post'],
                    ['path' => 'page', 'route' => 'page.index', 'name' => 'Create Page'],
                    ['path' => 'category', 'route' => 'category.index', 'name' => 'Create Category'],
                    ['path' => 'widget', 'route' => 'widget.index', 'name' => 'Create Widget'],
                    ['path' => 'menu', 'route' => 'menu.index', 'name' => 'Create Menu'],
                    ['path' => 'menufeatured', 'route' => 'menufeatured.index', 'name' => 'Featured Menu'],
                    ['path' => 'slider', 'route' => 'slider.index', 'name' => 'Create Slider'],
                    // ['path' => 'media', 'route' => 'media.index', 'name' => 'Create Gallery & Media'],
                    ['path' => 'user', 'route' => 'user.index', 'name' => 'User Account'],
                    ['path' => 'about', 'route' => 'about.index', 'name' => 'General Setting'],

                ]);

            @endphp

            @foreach ($menu as $item)
            <a href="{{ route($item['route']) }}" class="list-group-item list-group-item-action {{ Request::segment(2) == $item['path'] ? 'active':'' }}">
                {{ $item['name'] }}
            </a>
            @endforeach
        {{-- </div>
      </div> --}}
    </div>
</div>
