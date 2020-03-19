@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                @endif
                <div class="card-header">{{ $title ?? 'Laravel CMS' }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-right">
                                <a href="{{ route(Request::segment(2).'.create') }}" class="btn btn-primary">Add New {{ Request::segment(2) }}</a>
                            </div>
                          <div class="card mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <form>
                                            <div class="input-group">
                                              <input name="search" type="text" class="form-control" placeholder="Search">
                                              <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                              </div>
                                            </div>
                                          </form>
                                    </div>
                                </div>

                              <div class="clearfix mb-3"></div>

                              <div class="table-responsive">
                                <table class="table table-sm table-bordered table-hover">
                                  <tbody>
                                 <tr class="bg-light">
                                    <th class="align-middle"><div class="custom-checkbox custom-checkbox-table custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                        <label for="checkbox-all" class="custom-control-label">Title</label>
                                      </div></th>
                                    <th class="align-middle">Slug</th>
                                  </tr>
                                  @forelse ($data as $item)
                                  <tr>
                                    <td>
                                        <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-2">
                                        <label for="checkbox-2" class="custom-control-label">{{ $item->name }}</label>
                                      </div>
                                      <div class="ml-4 table-links">
                                        <a href="{{ route(Request::segment(2).'.show', $item->slug) }}">View</a>
                                        <div class="bullet"></div>
                                        <a href="{{ route(Request::segment(2).'.edit', $item->id) }}">Edit</a>
                                        <div class="bullet"></div>
                                        <a href="{{ route(Request::segment(2).'.destroy', $item->id) }}" onclick="event.preventDefault();
                                            document.getElementById('delete{{$item->id}}').submit();" class="text-danger">Trash</a>

                                        <form id="delete{{$item->id}}" action="{{ route(Request::segment(2).'.destroy', $item->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                      </div>
                                    </td>
                                    <td>{{ $item->slug }}</td>
                                  </tr>
                                  @empty
                                      <tr><td colspan="4" class="text-center text-danger">Oups...Data tidak ditemukan</td></tr>
                                  @endforelse
                                </tbody></table>
                              </div>
                              <div class="float-right">
                                {{ $data->links() }}
                              </div>
                            </div>
                          </div>
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
