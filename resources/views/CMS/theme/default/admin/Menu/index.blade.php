@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ $title ?? 'Laravel CMS' }}</div>
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <a class="nav-item nav-link {{ $action == 'location' ? '':'active' }}" id="nav-home-tab" href="{{ env('APP_URL') }}/manage/menu?action=home">Edit Menu</a>
                        <a class="nav-item nav-link {{ $action == 'location' ? 'active':'' }}"  href="{{ env('APP_URL') }}/manage/menu?action=location">Menu Setting</a>
                        </div>
                      </nav>
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade {{ $action == 'location' ? '':'show active' }}" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form>

                                <input type="hidden" name="action" value="edit">
                                <div class="row mt-2 mb-2">
                                    <div class="col text-right">
                                        <p class="align-middle">Pilih menu yang ingin diedit</p>
                                    </div>
                                    <div class="col">
                                        <select name="menu_id" {{ $data->count() < 1 ? 'disabled':''}} class="custom-select my-1 mr-sm-2" id="type">
                                            @forelse ($data as $item)
                                            <option {{ (!empty($get) && $get->id == $item->id) ? 'selected':'' }} value="{{ $item->id }}">{{ $item->title }}</option>
                                            @empty
                                            <option value="">-- Pilih Menu --</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="col mt-1">
                                        <button type="submit" {{ $data->count() < 1 ? 'disabled':''}} class="btn btn-primary">Pilih menu</button>
                                    </div>
                                </form>
                                    <div class="col mt-1 text-right">
                                        <form>
                                            <button class="btn btn-primary" type="submit" name="action" value="create">
                                              Buat Menu Baru
                                            </button>
                                          </form>
                                    </div>
                                </div>

                                <div class="collapse {{ ($action == 'create' || $action == 'edit') ? 'show':'' }}">
                                    <div class="card card-body bg-light">
                                      <form action="{{ empty($get) ? route('menu.store'):route('menu.update', $get->id) }}" method="post">
                                        @csrf
                                        @method(!empty($get) ? 'PATCH':'POST')
                                        <div class="row justify-content-center">
                                            <div class="col text-right">
                                            </div>
                                            <div class="col text-right">
                                                <input type="text" name="title" placeholder="Nama menu" class="form-control" value="{{ !empty($get) ? $get->title:old('title') }}">
                                            </div>
                                            <div class="col">
                                                <button type="submit" class="btn btn-primary">{{ !empty($get) ? 'Update':'Simpan' }} </button>
                                            </div>
                                        </div>
                                      </form>
                                    </div>
                                </div>
                                <hr>
                                <div class="collapse {{ ($action == 'edit') ? 'show':'' }}">
                                    <div class="card card-body bg-light">
                                        Assign menu to {{ !empty($get) ? $get->title:'' }}
                                        <hr>
                                        <form action="{{ route('menuitem.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="menu_id" value="{{ isset($get) ? $get->id:'' }}">
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                  <label for="inputCity">Nama menu</label>
                                                  <input type="text" name="name" class="form-control" id="inputCity" required>
                                                </div>
                                                <div class="form-group col-md-1">
                                                  <label for="inputState">Tipe menu</label>
                                                  <select name="type" id="inputState" class="form-control" required>
                                                    <option value="link">Link</option>
                                                    <option value="submenu">Submenu</option>
                                                  </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputState">Parent id</label>
                                                    <select name="parent_id" id="inputState" class="form-control" required>
                                                      <option value="0">Tanpa Parent</option>
                                                      @foreach (\App\Menuitem::where('parent_id', 0)->get() as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @foreach (\App\Menuitem::where('parent_id', '<>', 0)->get() as $items)
                                                                @if ($items->parent_id == $item->id)
                                                                <option value="{{ $items->id }}">&nbsp;&nbsp;&#11169; &nbsp; {{ $items->name }}</option>
                                                                @endif
                                                            @endforeach
                                                      @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-5" id="intlinkdiv">
                                                    <label for="inputState">Sumber internal link</label>
                                                    <select name="inlink" id="intlink" required data-placeholder="Pilih sumber dari internal" class="chosen-select" tabindex="5" >
                                                        <option value=""></option>
                                                        <optgroup label="HALAMAN">
                                                          @foreach (\App\Page::all() as $item)
                                                            <option value="{{ env('APP_URL').'/'.$item->slug }}">{{ $item->title }}</option>
                                                          @endforeach
                                                        <optgroup>
                                                        <optgroup label="BLOG">
                                                            @foreach (\App\Post::all() as $item)
                                                            <option value="{{ env('APP_URL').'/blog/'.$item->slug }}">{{ $item->title }}</option>
                                                          @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                              </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox mt-2">
                                                    <input type="checkbox" class="custom-control-input" id="meta">
                                                    <label class="custom-control-label" for="meta">Gunakan sumber eksternal</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-none" id="eksternal"">
                                                <label for="extlink">Eksternal link</label>
                                                <input type="text" id="extlink" disabled name="exlink" class="form-control" placeholder="Eksternal link">
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary">Simpan menu</button>
                                            </div>
                                          </form>
                                    </div>
                                    <div class="table-responsive mt-2">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr class="bg-light text-center">
                                                    <th class="text-left">ID | Name</th>
                                                    <th>Type</th>
                                                    <th>Order</th>
                                                    <th>IsActive</th>
                                                    <th>Link</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @isset($get)
                                                @forelse ($get->item->where('parent_id', 0) as $item)
                                                    <tr>
                                                        <td>{{ $item->id.' | '.$item->name }}</td>
                                                        <td>{{ $item->type }}</td>
                                                        <td class="text-center">{{ $item->ordered }}</td>
                                                        <td class="text-center">{{ $item->is_active }}</td>
                                                        <td>{{ $item->link }}</td>
                                                        <td>edit hapus</td>
                                                    </tr>
                                                    @foreach ($get->item->where('parent_id', '<>', 0) as $el)
                                                        @if ($el->parent_id == $item->id)
                                                        <tr>
                                                            <td>&nbsp;&nbsp; <span class="text-primary">&#11169; &nbsp;</span> {{ $el->name }}</td>
                                                            <td>{{ $el->type }}</td>
                                                            <td class="text-center">{{ $el->ordered }}</td>
                                                            <td class="text-center">{{ $el->is_active }}</td>
                                                            <td>{{ $el->link }}</td>
                                                            <td>edit hapus</td>
                                                        </tr>
                                                        @foreach ($get->item->where('parent_id', '<>', 0) as $e)
                                                            @if ($e->parent_id == $el->id)
                                                            <tr>
                                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="text-danger">&#11169; &nbsp;</span> {{ $e->name }}</td>
                                                                <td>{{ $e->type }}</td>
                                                                <td class="text-center">{{ $e->ordered }}</td>
                                                                <td class="text-center">{{ $e->is_active }}</td>
                                                                <td>{{ $e->link }}</td>
                                                                <td>edit hapus</td>
                                                            </tr>
                                                            @endif
                                                        @endforeach
                                                        @endif
                                                    @endforeach
                                                @empty
                                                <tr><td colspan="7" class="text-center text-danger">Tidak ada data.</td></tr>
                                                @endforelse
                                                @endisset
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                        </div>
                        <div class="tab-pane fade {{ $action == 'location' ? 'show active':'' }}" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        {{-- <form action="{{ route('menu.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="action" value="location">
                            <table class="table table-sm table-borderless mt-3">
                                <thead>
                                    <tr>
                                        <th width="15%">Theme Location</th>
                                        <th width="55%">Assigned Menu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Top Menu</td>
                                        <td>
                                            <input type="hidden" name="menu_location[]" value="top">
                                            <select name="menu_id[]" {{ $data->count() < 1 ? 'disabled':''}} class="form-control form-control-sm my-1 mr-sm-2" id="type">
                                                @forelse ($data as $item)
                                                <option {{ (!empty($get) && $get->id == $item->id) ? 'selected':'' }} value="{{ $item->id }}">{{ $item->title }}</option>
                                                @empty
                                                <option value="">-- Pilih Menu --</option>
                                                @endforelse
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Footer Menu</td>
                                        <td>
                                            <input type="hidden" name="menu_location[]" value="footer">
                                            <select name="menu_id[]" {{ $data->count() < 1 ? 'disabled':''}} class="form-control form-control-sm  my-1 mr-sm-2" id="type">
                                                @forelse ($data as $item)
                                                <option {{ (!empty($get) && $get->id == $item->id) ? 'selected':'' }} value="{{ $item->id }}">{{ $item->title }}</option>
                                                @empty
                                                <option value="">-- Pilih Menu --</option>
                                                @endforelse
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Right Position</td>
                                        <td>
                                            <input type="hidden" name="menu_position[]" value="right">
                                            <select name="menu_id[]" {{ $data->count() < 1 ? 'disabled':''}} class="form-control form-control-sm  my-1 mr-sm-2" id="type">
                                                @forelse ($data as $item)
                                                <option {{ (!empty($get) && $get->id == $item->id) ? 'selected':'' }} value="{{ $item->id }}">{{ $item->title }}</option>
                                                @empty
                                                <option value="">-- Pilih Menu --</option>
                                                @endforelse
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Left Position</td>
                                        <td>
                                            <input type="hidden" name="menu_position[]" value="left">
                                            <select name="menu_id[]" {{ $data->count() < 1 ? 'disabled':''}} class="form-control form-control-sm  my-1 mr-sm-2" id="type">
                                                @forelse ($data as $item)
                                                <option {{ (!empty($get) && $get->id == $item->id) ? 'selected':'' }} value="{{ $item->id }}">{{ $item->title }}</option>
                                                @empty
                                                <option value="">-- Pilih Menu --</option>
                                                @endforelse
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form> --}}
                        </div>
                      </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            @include(env('DEFAULT_COMPONENTS').'sidebar')
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function(){
        $('#meta').click(function(){
            if($(this).prop("checked") == true){
                // alert("Checkbox is checked.");
                $('#eksternal').removeClass("d-none");
                $('#extlink').prop("required", true);
                $('#extlink').prop("disabled", false);
                $('#intlinkdiv').hide();
                $('#intlink').prop("disabled", true);
                $('#intlink').prop("required", false);
            }
            else if($(this).prop("checked") == false){
                // alert("Checkbox is unchecked.");
                $('#eksternal').addClass("d-none");
                $('#extlink').prop("required", false);
                $('#extlink').prop("disabled", true);
                $('#intlinkdiv').show();
                $('#intlink').prop("disabled", false);
                $('#intlink').prop("required", true);
            }
        });
    });
</script>
@endpush
