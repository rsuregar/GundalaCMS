@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ $title ?? env('APP_NAME') }}</div>
                <div class="card-body">

                    <form method="POST" action="{{ isset($user) ? route('user.update', $user->id):route('user.store') }}">
                        @csrf
                        @method(isset($user) ? 'PATCH':'POST')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($user) ? $user->name:old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ isset($user) ? $user->email:old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ isset($user) ? $user->username:old('username') }}" required {{ isset($user) ? 'disabled':''}} autocomplete="username">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select name="role_id" class="form-control" id="role_id">
                                    @foreach (\App\Role::all() as $item)
                                        <option {{ (isset($user) && $user->role_id == $item->id) ? 'selected':'' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row {{ isset($user) ? '':'d-none'}}">
                            <label for="password" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="ganti">
                                    <label class="form-check-label" for="ganti">
                                    Ganti Password
                                    </label>
                                  </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required {{ isset($user) ? 'disabled':''}} autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 text-right">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($user) ? 'Update Pengguna':'Tambah Pengguna' }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    @isset($data)
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>
                                            <a href="{{ route('user.edit', [$item->id]) }}">Edit</a>&nbsp;
                                           <a href="{{ route('user.destroy', $item->id) }}" onclick="event.preventDefault();
                                            document.getElementById('delete{{$item->id}}').submit();" class="text-danger">Trash</a>

                                            <form id="delete{{$item->id}}" action="{{ route('user.destroy', $item->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                <tr><td colspan="3">No Data found</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @endisset

                </div>
            </div>
        </div>
        <div class="col-md-2">
            @include('CMS.theme.default.components.sidebar')
            @component('CMS.theme.default.components.modal')
                Hapus Pengguna ini?
            @endcomponent
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        $('#ganti').click(function(){
            if($(this).prop('checked') === true){
                $('#password').prop("disabled", false)
            }else{
                $('#password').prop("disabled", true)
            }
        });
    </script>
@endpush
