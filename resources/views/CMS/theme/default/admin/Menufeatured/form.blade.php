@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
            <div class="card-header">{{ $title ?? env('APP_NAME') }}<span class="float-right"> <a class="btn btn-outline-secondary btn-sm" href="{{ route(Request::segment(2).'.index') }}"><i class="fas fa-arrow-left"></i> Kembali</span></a></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                        <form class="mt-3" action="{{ !empty($data) ? route(Request::segment(2).'.update', [$data->id]):route(Request::segment(2).'.store')}}" method="POST" >
                            @csrf
                            @method(!empty($data) ? 'PATCH':'POST')
                                <div class="form-label-group">
                                <input type="text" id="title" name="title" class="form-control form-control-lg" placeholder="Title" required autofocus value="{{ !empty($data) ? $data->title:old('title')}}">
                                    <label for="title">Title</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="text" id="subtitle" name="subtitle" class="form-control form-control-lg" placeholder="Title" required autofocus value="{{ !empty($data) ? $data->subtitle:old('subtitle')}}">
                                        <label for="subtitle">Subtitle</label>
                                </div>
                                @isset($data)
                                <div class="form-label-group mt-2">
                                    <input type="url" id="woi" name="current" class="form-control form-control-lg" placeholder="Title" readonly value="{{ $data->link }}">
                                        <label for="woi">Url saat ini</label>
                                        <small>Untuk mengganti URL silakan pilih sumber dibawah </small>
                                </div>
                                @endisset
                                <div class="row" id="intlinkdiv">
                                    <div class="col-lg-12">
                                        <select name="inlink" id="intlink" {{ !empty($data) ? '':'required' }} data-placeholder="Pilih sumber dari internal" class="chosen-select" tabindex="5">
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
                                <div class="custom-control custom-checkbox mt-2">
                                    <input type="checkbox" class="custom-control-input" id="meta">
                                    <label class="custom-control-label" for="meta">Gunakan sumber eksternal</label>
                                </div>
                                <div class="form-label-group mt-2 d-none" id="eksternal">
                                    <input type="url" id="extlink" disabled name="exlink" class="form-control form-control-lg" placeholder="Title"  value="{{ old('exlink') }}">
                                        <label for="extlink">Paste Url disini</label>
                                </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-small mb-3">
                                <div class="card-header border-bottom">
                                  <h6 class="m-0">Opsi tampilkan</h6>
                                </div>
                                <div class="card-body pl-2 pr-2">
                                    <div class="row">
                                        <div class="col">
                                            <select name="is_active" class="custom-select my-1 mr-sm-2" id="intlink">
                                                <option value="1" {{ (!empty($data) && $data->is_active == 1 ? 'selected':'')}}>Tampilkan</option>
                                                <option value="0" {{ (!empty($data) && $data->is_active == 0 ? 'selected':'')}}>Sembunyikan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-small mb-3">
                                <div class="card-header border-bottom">
                                  <h6 class="m-0">Aksi</h6>
                                </div>
                                <div class="card-body p-0">
                                  <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-3">
                                      <span class="d-flex mb-2"><i class="fas fa-flag mr-1" style="line-height: 1.5"></i><strong class="mr-1">Status:</strong>
                                        @isset($data)
                                            {{ $data->is_active == 1 ? 'Tampil':'Tidak tampil' }}
                                        @endisset
                                       </span>
                                    </li>
                                    <li class="list-group-item d-flex px-3">
                                      <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-copy"></i> Simpan fitur menu</button>
                                    </li>
                                  </ul>
                                </div>
                            </div>
                        </div>
                    </form>
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
