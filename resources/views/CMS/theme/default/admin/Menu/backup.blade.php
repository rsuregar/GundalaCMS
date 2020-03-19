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
                                                <button type="submit" class="btn btn-primary">{{ !empty($get) ? 'Update':'Simpan' }} menu</button>
                                            </div>
                                        </div>
                                      </form>
                                    </div>
                                </div>
                            <hr>
                            <table class="table table-sm table-bordered mt-3">
                                <thead>
                                    <tr class="bg-light">
                                        <th>Nama menu</th>
                                        <th>Lokasi Menu</th>
                                        <th>Posisi Menu</th>
                                        <th>Status</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $lokasi = collect(['top', 'footer']);
                                        $posisi = collect(['right', 'left']);
                                        $status = collect(['0', '1']);
                                    @endphp
                                    @forelse ($data as $item)
                                    <tr>
                                        <td>{{$item->title}}</td>
                                        <td>
                                            <select name="menu_location" class="form-control form-control-sm">
                                                <option value="">Pilih lokasi</option>
                                                @foreach ($lokasi as $a)
                                                <option value="{{ $a }}">{{ $a }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="menu_location" class="form-control form-control-sm">
                                                <option value="">Pilih posisi</option>
                                                @foreach ($posisi as $b)
                                                <option value="{{ $b }}">{{ $b }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="menu_location" class="form-control form-control-sm">
                                                <option value="">Opsi Aktif</option>
                                                @foreach ($status as $c)
                                                <option value="{{ $c }}">{{ $c == 1 ? 'Tampilkan':'Tidak tampil' }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><a href="{{ route('about.edit', [$item->id]) }}">Edit</a>
                                            <a class="text-danger" href="{{ route('commentsetting.destroy', [$item->id]) }}">Hapus</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center text-danger">
                                        <th colspan="4">Oups... Data tidak ditemukan</th>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
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
                $('#mymeta').addClass("d-block");
            }
            else if($(this).prop("checked") == false){
                // alert("Checkbox is unchecked.");
                $('#mymeta').removeClass("d-block");
                $('#mymeta').addClass("d-none");
            }
        });
    });
</script>
@endpush
