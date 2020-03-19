@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Media</div>
                <div class="card-body">
                    <iframe src="/laravel-filemanager" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            @include(env('DEFAULT_COMPONENTS').'sidebar')
        </div>
    </div>
</div>
@endsection
