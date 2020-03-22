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
                <div class="card-header">{{ $title ?? env('APP_NAME') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-right">
                                <a href="{{ route(Request::segment(2).'.create') }}" class="btn btn-primary">Add New {{ Request::segment(2) }}</a>
                            </div>
                          <div class="card mt-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-md-7 col-sm-7 col-xs-7">
                                                <select class="form-control">
                                                    <option value="">Action For Selected</option>
                                                    <option value="1">Move to Publish</option>
                                                    <option value="1">Move to Draft</option>
                                                    <option value="1">Move to Pending</option>
                                                    <option value="1">Delete Pemanently</option>
                                                  </select>
                                            </div>
                                            <div class="col-md-5 col-sm-5 col-xs-5">
                                                <br class=" d-block d-sm-none">
                                                <button type="submit" class="btn btn-light">Apply</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-12 col-xs-12">
                                        <br class=" d-block d-sm-none">
                                    </div>
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
                                    <th class="align-middle">Author</th>
                                    <th class="align-middle">Created</th>
                                    <th class="align-middle">Status</th>
                                  </tr>
                                  @forelse ($data as $item)
                                  <tr>
                                    <td>
                                        <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-2">
                                        <label for="checkbox-2" class="custom-control-label">{{ $item->title }}</label>
                                      </div>
                                      <div class="ml-4 table-links">
                                        <a href="{{ route('page', $item->slug) }}">View</a>
                                        <div class="bullet"></div>
                                        <a href="{{ route('page.edit', $item->id) }}">Edit</a>
                                        <div class="bullet"></div>
                                        {{-- <a href="{{ route('page.destroy', $item->id) }}" onclick="event.preventDefault();
                                            document.getElementById('delete{{$item->id}}').submit();" class="text-danger">Trash</a>

                                            <form id="delete{{$item->id}}" action="{{ route('page.destroy', $item->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form> --}}
                                            <a class="text-danger btn-link delete" href="#"  target-action="{{ route(Request::segment(2).'.destroy', $item->id) }}">Trash</a>
                                      </div>
                                    </td>
                                    <td>
                                      <a href="{{ route('user.show', $item->author) }}">
                                        <div class="d-inline-block ml-1">{{ $item->user->name }}</div>
                                      </a>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d-M-Y')}}</td>
                                <td><div class="badge badge-{{$item->status == 'draft' ? 'warning':'primary'}}">{{ ucwords($item->status) }}</div></td>
                                  </tr>
                                  @empty
                                      <tr><td colspan="4" class="text-center text-danger">Oups...Data tidak ditemukan</td></tr>
                                  @endforelse
                                </tbody></table>
                              </div>
                              <div class="float-right">
                                {{-- <nav>
                                  <ul class="pagination">
                                    <li class="page-item disabled">
                                      <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">«</span>
                                        <span class="sr-only">Previous</span>
                                      </a>
                                    </li>
                                    <li class="page-item active">
                                      <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                      <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item">
                                      <a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item">
                                      <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">»</span>
                                        <span class="sr-only">Next</span>
                                      </a>
                                    </li>
                                  </ul>
                                </nav> --}}
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
@component('CMS.theme.default.components.modal')
                Ingin menghapus {{ ucwords(Request::segment(2)) }} ini?
@endcomponent
@endsection
