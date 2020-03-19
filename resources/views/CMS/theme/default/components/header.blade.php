@php
    $menu = \App\Menu::where(['menu_location' => 'top', 'menu_position' => 'left', 'is_active' => 1])->first();
@endphp
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-danger shadow-sm">
    <div class="container-fluid">
    <a href="{{ url('/') }}" class="navbar-brand font-weight-normal">{{ \App\About::find(1)->title ?? env('APP_NAME')}}</a>
      <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
                <span class="navbar-toggler-icon"></span>
     </button>

      <div id="navbarContent" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ collect(request()->segments())->last() == '' ? 'active':'' }}">
                <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            @foreach ($menu->item->where('parent_id', 0) as $mymenu)
                @if ($mymenu->type == 'link')
                    <li class="nav-item {{ url()->full() == $mymenu->link ? 'active':'' }}">
                        <a href="{{ $mymenu->link }}" class="nav-link">{{ $mymenu->name }}</a>
                    </li>
                @else
                <li class="nav-item dropdown">
                    <a id="dropdownMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">{{ $mymenu->name }}</a>
                    <ul aria-labelledby="dropdownMenu1" class="dropdown-menu border-0 shadow">
                        @foreach ($menu->item->where('parent_id', '<>', 0) as $item)
                            @if ($mymenu->id == $item->parent_id)
                                @if ($item->type == 'link')
                                    <li><a href="{{ $item->link }}" class="dropdown-item"> {{ $item->name }}</a></li>
                                @else
                                    <!-- Level two dropdown-->
                                    <li class="dropdown-submenu">
                                        <a id="dropdownMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">{{ $item->name }}</a>
                                        <ul aria-labelledby="dropdownMenu2" class="dropdown-menu border shadow">
                                            @foreach ($menu->item->where('parent_id', '<>', 0) as $level2)
                                                @if ($item->id == $level2->parent_id)
                                                    <li><a href="{{ $level2->link }}" class="dropdown-item">{{ $level2->name }}</a></li>
                                                @endif
                                            @endforeach
                                        <!-- Level three dropdown-->
                                        {{-- <li class="dropdown-submenu">
                                            <a id="dropdownMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                                            <ul aria-labelledby="dropdownMenu3" class="dropdown-menu border shadow">
                                            <li><a href="#" class="dropdown-item">3rd level</a></li>
                                            <li><a href="#" class="dropdown-item">3rd level</a></li>
                                            </ul>
                                        </li> --}}
                                        <!-- End Level three -->
                                        </ul>
                                    </li>
                                    <!-- End Level two -->
                                @endif
                            @endif
                        @endforeach
                      {{-- <li class="dropdown-divider"></li> --}}
                    </ul>
                </li>
                @endif
            @endforeach
          <!-- Level one dropdown -->
          {{-- <li class="nav-item dropdown">
            <a id="dropdownMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
            <ul aria-labelledby="dropdownMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="#" class="dropdown-item">Some action </a></li>
              <li><a href="#" class="dropdown-item">Some other action</a></li>

              <li class="dropdown-divider"></li>

              <!-- Level two dropdown-->
              <li class="dropdown-submenu">
                <a id="dropdownMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                <ul aria-labelledby="dropdownMenu2" class="dropdown-menu border shadow">
                  <li>
                    <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                  </li>

                  <!-- Level three dropdown-->
                  <li class="dropdown-submenu">
                    <a id="dropdownMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                    <ul aria-labelledby="dropdownMenu3" class="dropdown-menu border shadow">
                      <li><a href="#" class="dropdown-item">3rd level</a></li>
                      <li><a href="#" class="dropdown-item">3rd level</a></li>
                    </ul>
                  </li>
                  <!-- End Level three -->

                  <li><a href="#" class="dropdown-item">level 2</a></li>
                  <li><a href="#" class="dropdown-item">level 2</a></li>
                </ul>
              </li>
              <!-- End Level two -->
            </ul>
          </li> --}}
          <!-- End Level one -->
        </ul>
        <ul class="navbar-nav ml-auto">
            @guest
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('home.index') }}">
                            {{ __('Dashboard') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
      </div>
    </div>
  </nav>
