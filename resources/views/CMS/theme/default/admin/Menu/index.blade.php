@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ $title ?? config('app.name') }}</div>
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
                                        @isset($get)
                                        <h5> Pasang menu ke <strong>{{ $get->title }}</strong> <span class="float-right"><a class="btn btn-danger btn-sm delete" href="#"  target-action="{{ route('menu.destroy', $get->id) }}">Hapus</a></span></h5>
                                        @endisset
                                        <hr>
                                        <form action="{{ route('menuitem.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="menu_id" value="{{ isset($get) ? $get->id:'' }}">
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                  <label for="inputCity">Nama menu</label>
                                                  <input type="text" name="name" value="" class="form-control" id="inputCity" required>
                                                </div>
                                                <div class="form-group col-md-2">
                                                  <label for="tipemenu">Tipe menu</label>
                                                  <select name="type" id="tipemenu" class="form-control" required>
                                                    <option value="link">Link</option>
                                                    <option value="submenu">Memiliki submenu</option>
                                                  </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputState">Parent id</label>
                                                    <select name="parent_id" id="inputState" class="form-control" required>
                                                      <option value="0">Tanpa Parent</option>
                                                      @foreach (\App\Menuitem::where('parent_id', 0)->where('menu_id', (isset($get) ? $get->id:1))->get() as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @foreach (\App\Menuitem::where('parent_id', '<>', 0)->where('menu_id', (isset($get) ? $get->id:1))->get() as $items)
                                                                @if ($items->parent_id == $item->id)
                                                                <option value="{{ $items->id }}">&nbsp;&nbsp;&#11169; &nbsp; {{ $items->name }}</option>
                                                                @endif
                                                            @endforeach
                                                      @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4" id="intlinkdiv">
                                                    <label for="inputState">Sumber internal link</label>
                                                    <select name="inlink" id="intlink" required data-placeholder="Pilih sumber dari internal" class="chosen-select" tabindex="5" >
                                                        <option value=""></option>
                                                        <optgroup label="HALAMAN">
                                                          @foreach (\App\Page::all() as $item)
                                                            <option value="{{ config('app.url').'/'.$item->slug }}">{{ $item->title }}</option>
                                                          @endforeach
                                                        <optgroup>
                                                        <optgroup label="BLOG">
                                                            @foreach (\App\Post::all() as $item)
                                                            <option value="{{ config('app.url').'/blog/'.$item->slug }}">{{ $item->title }}</option>
                                                          @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                              </div>
                                            <div class="form-group" id="metadiv">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="meta">
                                                    <label class="custom-control-label" for="meta">Gunakan sumber eksternal</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-none" id="eksternal"">
                                                <label for="extlink">Eksternal link</label>
                                                <input type="url" id="extlink" disabled name="exlink" class="form-control" placeholder="Eksternal link">
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
                                                    <th class="text-left">Name</th>
                                                    <th>Type</th>
                                                    <th>Order</th>
                                                    <th>IsActive</th>
                                                    <th>Link</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @isset($get)
                                                @forelse ($get->item->where('parent_id', 0)->sortBy('ordered') as $item)
                                                    <tr class="{{ $item->is_active == 1 ? '':'bg-warning' }}">
                                                        <td class="align-middle font-weight-bold">{{ $item->name }}</td>
                                                        <td class="align-middle">{{ $item->type }}</td>
                                                        <td class="text-center align-middle">{{ $item->ordered }}</td>
                                                        <td class="text-center align-middle">{{ $item->is_active == 1 ? 'Aktif':'TIdak aktif' }}</td>
                                                        <td class="align-middle">{{ $item->link }}</td>
                                                        <td class="align-middle text-center">
                                                            <a class="btn btn-primary btn-sm li-modal" data-toggle="modal"  href="{{ route('menuitem.edit',$item->id) }}">Edit</a>
                                                            <a class="btn btn-danger btn-sm delete" href="#"  target-action="{{ route('menuitem.destroy', $item->id) }}">Hapus</a>
                                                        </td>
                                                    </tr>
                                                    @foreach ($get->item->where('parent_id', '<>', 0)->sortBy('ordered') as $el)
                                                        @if ($el->parent_id == $item->id)
                                                        <tr class="{{ $el->is_active == 1 ? '':'bg-warning' }}">
                                                            <td class="align-middle">&nbsp;&nbsp; <span class="text-primary">&#11169; &nbsp;</span> {{ $el->name }}</td>
                                                            <td class="align-middle">{{ $el->type }}</td>
                                                            <td class="text-center align-middle">{{ $el->ordered }}</td>
                                                            <td class="text-center align-middle">{{ $el->is_active == 1 ? 'Aktif':'TIdak aktif' }}</td>
                                                            <td class="align-middle">{{ $el->link }}</td>
                                                            <td class="align-middle text-center">
                                                                <a class="btn btn-primary btn-sm li-modal" data-toggle="modal"  href="{{ route('menuitem.edit',$el->id) }}">Edit</a>
                                                                <a class="btn btn-danger btn-sm delete" href="#"  target-action="{{ route('menuitem.destroy', $el->id) }}">Hapus</a>
                                                            </td>
                                                        </tr>
                                                        @foreach ($get->item->where('parent_id', '<>', 0)->sortBy('ordered') as $e)
                                                            @if ($e->parent_id == $el->id)
                                                            <tr class="{{ $e->is_active == 1 ? '':'bg-warning' }}">
                                                                <td class="align-middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="text-danger">&#11169; &nbsp;</span> {{ $e->name }}</td>
                                                                <td class="align-middle">{{ $e->type }}</td>
                                                                <td class="text-center align-middle">{{ $e->ordered }}</td>
                                                                <td class="text-center align-middle">{{ $e->is_active == 1 ? 'Aktif':'TIdak aktif' }}</td>
                                                                <td class="align-middle">{{ $e->link }}</td>
                                                                <td class="align-middle text-center">
                                                                    <a class="btn btn-primary btn-sm li-modal" data-toggle="modal"  href="{{ route('menuitem.edit',$e->id) }}">Edit</a>
                                                                    <a class="btn btn-danger btn-sm delete" href="#"  target-action="{{ route('menuitem.destroy', $e->id) }}">Hapus</a>
                                                                </td>
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
                                            <form action="{{ route('menu.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="action"  value="location">
                                            <input type="hidden" name="menu_location"  value="top">
                                            <div class="form-row">
                                                <div class="form-group col-md-10">
                                                    <select name="id" {{ $data->count() < 1 ? 'disabled':''}} class="form-control form-control-sm my-1 mr-sm-2" id="type" required>
                                                        <option value="">-- Pilih Menu --</option>
                                                        @foreach ($data as $item)
                                                        <option {{ $item->menu_location == 'top' ? 'selected':'' }} value="{{ $item->id }}">{{ $item->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2 mt-1">
                                                    <button class="btn btn-sm btn-block btn-primary" type="submit">Save Change</button>
                                                </div>
                                            </div>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Secondary Menu</td>
                                        <td>
                                            <form action="{{ route('menu.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="action" value="location">
                                            <input type="hidden" name="menu_location" value="secondary">
                                            <div class="form-row">
                                                <div class="form-group col-md-10">
                                                    <select name="id" {{ $data->count() < 1 ? 'disabled':''}} class="form-control form-control-sm my-1 mr-sm-2" id="type" required>
                                                        <option value="">-- Pilih Menu --</option>
                                                        @foreach ($data as $item)
                                                        <option {{ $item->menu_location == 'secondary' ? 'selected':'' }} value="{{ $item->id }}">{{ $item->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2 mt-1">
                                                    <button class="btn btn-sm btn-block btn-primary" type="submit">Save Change</button>
                                                </div>
                                            </div>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Footer Menu</td>
                                        <td>
                                            <form action="{{ route('menu.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="action" value="location">
                                                <input type="hidden" name="menu_location" value="footer">
                                                <div class="form-row">
                                                <div class="form-group col-md-10">
                                                    <select name="id" {{ $data->count() < 1 ? 'disabled':''}} class="form-control form-control-sm my-1 mr-sm-2" id="type" required>
                                                        <option value="">-- Pilih Menu --</option>
                                                        @foreach ($data as $item)
                                                        <option {{ $item->menu_location == 'footer' ? 'selected':'' }} value="{{ $item->id }}">{{ $item->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2 mt-1">
                                                    <button class="btn btn-sm btn-block btn-primary" type="submit">Save Change</button>
                                                </div>
                                                </div>
                                                </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                      </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            @include('CMS.theme.default.components.sidebar')
        </div>
    </div>
</div>

@component('CMS.theme.default.components.modal')
Jika Anda menghapus menu Induk. Sub-menu juga akan terhapus.
@endcomponent

@endsection
@push('script')
<script>
    $(document).ready(function(){
    //     $('.delete').click(function(){
    //         var action = this.getAttribute('target-action');
    //         $("#deleteForm").attr('action', action);
    //         $('#modalConfirmation').modal('toggle');
    //     });

    //     $('.li-modal').on('click', function(e){
    // // alert('halo');
    //     $('#theModal').modal('show').find('.modal-content').html('<div class="modal-body">Loading...</div>');

    //     e.preventDefault();
    //     $('#theModal').modal('show').find('.modal-content')
    //     //
    //         // .load('http://localhost/Admin/vertical-green/index.html')
    //         .load($(this).attr('href'), function(response, status,xhr){
    //             $('.chosen-select').chosen()
    //             if ( status == "error" ) {
    //             $('#theModal').modal('show').find('.modal-content').html('<div class="modal-body">Sorry but there was an error : <strong>'+xhr.status+'</strong> '+xhr.statusText+'</div>');
    //                 console.log( xhr.statusText );
    //             }
    //         });
    //     });
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

        $('#tipemenu').on('change', function() {
            // alert(this.value);
            if(this.value == 'submenu'){
                $('#metadiv').hide();
                $('#intlinkdiv').hide();
                $('#intlink').prop("disabled", true);
                $('#intlink').prop("required", false);
            }else {
                $('#metadiv').show();
                $('#intlinkdiv').show();
                $('#intlink').prop("disabled", false);
                $('#intlink').prop("required", true);
            }
        });

    });
</script>
@endpush
