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
                                <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Title" required autofocus value="{{ !empty($data) ? $data->name:old('name')}}">
                                    <label for="name">Nama kategori</label>
                                </div>
                                @isset($data)
                                    <div class="form-group">
                                        <label class="sr-only" for="slug">Slug</label>
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">{{ env('APP_URL').'/category/' }}</div>
                                        </div>
                                        <input name="slug" value="{{ $data->slug }}" type="text" class="form-control" id="slug" placeholder="Slug">
                                        </div>
                                    </div>
                                @endisset
                        </div>
                        <div class="col-md-3">
                            <div class="form-label-group mt-3">
                               <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
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
