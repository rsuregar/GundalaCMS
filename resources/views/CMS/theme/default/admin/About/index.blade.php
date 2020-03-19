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
                          <a class="nav-item nav-link {{ !empty($nav1) ? $nav1:'active' }}" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">General Setting</a>
                          <a class="nav-item nav-link {{ !empty($nav2) ? $nav2:'' }}" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Comment Setting</a>
                          <a class="nav-item nav-link {{ !empty($nav3) ? $nav3:'' }}" id="nav-google-tab" data-toggle="tab" href="#nav-google" role="tab" aria-controls="nav-google" aria-selected="false">Google Analytic</a>
                        </div>
                      </nav>
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade {{ !empty($nav1) ? $nav1:'show active' }}" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="mt-3" action="{{ !empty($data) ? route(Request::segment(2).'.update', [$data->id]):route(Request::segment(2).'.store')}}" method="POST" >
                                        @csrf
                                        @method(!empty($data) ? 'PATCH':'POST')
                                        <input type="hidden" name="current" value="">
                                            <div class="form-label-group">
                                                <input type="text" id="title" name="title" class="form-control form-control-lg" placeholder="Title" required autofocus value="{{ !empty($data) ? $data->title:old('title')}}">
                                                <label for="title">Nama Website</label>
                                            </div>
                                            <div class="form-label-group">
                                                <input type="text" id="tagline" name="tagline" class="form-control form-control-lg" placeholder="Title" required autofocus value="{{ !empty($data) ? $data->tagline:old('tagline')}}">
                                                <label for="tagline">Tagline Website</label>
                                            </div>
                                            <div class="form-label-group">
                                                <input type="text" id="copyright" name="copyright" class="form-control form-control-lg" placeholder="Title" required autofocus value="{{ !empty($data) ? $data->copyright:old('copyright')}}">
                                                <label for="copyright">Copyright Website</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="meta" name="meta" class="form-control" placeholder="Meta Deskripsi" value="{{ !empty($data) ? $data->meta:old('meta')}}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Add & Enter" data-role="tagsinput" value="{{ !empty($data) ? $data->keyword:old('keyword')}}">
                                            </div>
                                            <div class="input-group">
                                                <input id="thumbnail" class="form-control" type="text" name="logo" placeholder="Paste link logo disini atau pilih dari media" value="{{ !empty($data) ? $data->logo: old('logo') }}">
                                                <span class="input-group-btn ml-1">
                                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                                                      <i class="fas fa-folder-open"></i>
                                                    </a>
                                                </span>
                                            </div>
                                            <div  class="text-center mt-2" id="holder" style=height:400px">
                                                @if(!empty($data))
                                                <img class="rounded img-fluid" style="height:300px" src="{{ $data->image }}">
                                                @endif
                                            </div>
                                            <hr>
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary float-right">{{ !empty($data) ? 'Update Pengaturan':'Simpan Pengaturan'}}</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade {{ !empty($nav2) ? $nav2:'' }}" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <form action="{{ !empty($comset) ? route(Request::segment(2).'.update', [$comset->id]):route(Request::segment(2).'.store')}}" method="POST">
                                @csrf
                                @method(!empty($comset) ? 'PATCH':'POST')
                                <input type="hidden" name="current" value="comset">
                                <div class="row mt-2">
                                    <div class="col">
                                        {{-- <label for="type">Type Comment</label> --}}
                                        <select name="comment_type" class="custom-select my-1 mr-sm-2" id="type" required>
                                            <option value="">Pilih jenis komentar</option>
                                            <option value="facebook" {{ (!empty($comset) && $comset->comment_type == 'facebook')  ? 'selected':old('status') }} >Facebook</option>
                                            <option value="disqus" {{ (!empty($comset) && $comset->comment_type == 'disqus')  ? 'selected':old('status') }} >Disqus</option>
                                        </select>
                                    </div>
                                    <div class="col mt-1">
                                        <input type="text" name="appId" value="{{ !empty($comset) ? $comset->appId:old('appId') }}" placeholder="appId or srcId" class="form-control" required>
                                    </div>
                                    <div class="col">
                                        {{-- <label for="type">Type Comment</label> --}}
                                        <select name="status" class="custom-select my-1 mr-sm-2" id="type">
                                            <option value="">Aktifkan?</option>
                                            <option value="0" {{ (!empty($comset) && $comset->status == 0)  ? 'selected':old('status') }} >Tidak</option>
                                            <option value="1" {{ (!empty($comset) && $comset->status == 1)  ? 'selected':old('status') }} >Ya</option>
                                        </select>
                                    </div>
                                    <div class="col mt-1">
                                        <button type="submit" class="btn btn-primary {{ !empty($comset) ? '':'btn-block' }}">{{ !empty($comset) ? 'Update':'Submit' }}</button>
                                        @isset($comset)
                                            <a class="btn btn-warning" href="{{ route('about.index') }}">Batalkan</a>
                                        @endisset
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <table class="table table-sm table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th>Tipe</th>
                                        <th>AppId/SrcId</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($comment)
                                    @foreach ($comment as $item)
                                    <tr>
                                        <td>{{$item->comment_type}}</td>
                                        <td>{{$item->appId}}</td>
                                        <td>{{$item->status == 1 ? 'Aktif':'Tidak aktif'}}</td>
                                        <td><a href="{{ route('about.edit', [$item->id]) }}">Edit</a>
                                            <a class="text-danger" href="{{ route('commentsetting.destroy', [$item->id]) }}">Hapus</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="text-center text-danger">
                                        <th colspan="4">Oups... Data tidak ditemukan</th>
                                    </tr>
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade {{ !empty($nav3) ? $nav3:'' }}" id="nav-google" role="tabpanel" aria-labelledby="nav-google-tab">
                            <form action="{{ !empty($google) ? route(Request::segment(2).'.update', [$google->id]):route(Request::segment(2).'.store')}}" method="POST">
                                @csrf
                                @method(!empty($google) ? 'PATCH':'POST')
                                <input type="hidden" name="current" value="google">
                                <div class="row mt-2">
                                    <div class="col">
                                        {{-- <label for="type">Type Comment</label> --}}
                                        <select name="comment_type" class="custom-select my-1 mr-sm-2" id="type" required>
                                            <option value="google" selected>Google</option>
                                        </select>
                                    </div>
                                    <div class="col mt-1">
                                    <input type="text" name="appId" value="{{ !empty($google) ? $google->appId:old('appId') }}" placeholder="Kode Analytic" class="form-control" required>
                                    </div>
                                    <div class="col">
                                        {{-- <label for="type">Type Comment</label> --}}
                                        <select name="status" class="custom-select my-1 mr-sm-2" id="type">
                                            <option value="">Aktifkan?</option>
                                            <option value="0" {{ (!empty($google) && $google->status == 0)  ? 'selected':old('status') }} >Tidak</option>
                                            <option value="1" {{ (!empty($google) && $google->status == 1)  ? 'selected':old('status') }} >Ya</option>
                                        </select>
                                    </div>
                                    <div class="col mt-1">
                                        <button type="submit" class="btn btn-primary btn-block">{{ !empty($google) ? 'Update':'Submit' }}</button>
                                    </div>
                                </div>
                            </form>
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

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<script>
 var route_prefix = "/filemanager";
</script>

<!-- CKEditor init -->
<script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/ckeditor.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/adapters/jquery.js"></script>
<script>
  $('#ckeditor').ckeditor({
    height: 400,
    filebrowserImageBrowseUrl: route_prefix + '?type=Images',
    filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
    filebrowserBrowseUrl: route_prefix + '?type=Files',
    filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{csrf_token()}}'
  });
</script>

<!-- TinyMCE init -->
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
  var editor_config = {
    path_absolute : "",
    selector: "#tinymce",
    plugins: [
      "link image"
    ],
    relative_urls: false,
    height: 129,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + route_prefix + '?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>

<script>
  {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}
</script>
<script>
  $('#lfm').filemanager('image', {prefix: route_prefix});
  // $('#lfm').filemanager('file', {prefix: route_prefix});
</script>

<script>
  var lfm = function(id, type, options) {
    let button = document.getElementById(id);

    button.addEventListener('click', function () {
      var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
      var target_input = document.getElementById(button.getAttribute('data-input'));
      var target_preview = document.getElementById(button.getAttribute('data-preview'));

      window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
      window.SetUrl = function (items) {
        var file_path = items.map(function (item) {
          return item.url;
        }).join(',');

        // set the value of the desired input to image url
        target_input.value = file_path;
        target_input.dispatchEvent(new Event('change'));

        // clear previous preview
        target_preview.innerHtml = '';

        // set or change the preview image src
        items.forEach(function (item) {
          let img = document.createElement('img')
          img.setAttribute('style', 'height: 10rem')
          img.setAttribute('src', item.thumb_url)
          target_preview.appendChild(img);
        });

        // trigger change event
        target_preview.dispatchEvent(new Event('change'));
      };
    });
  };

  lfm('lfm2', 'file', {prefix: route_prefix});
</script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script> --}}
<script src="{{ asset('js/summernote-bs4.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script> --}}
<script src="{{ asset('js/summernote-table.js') }}"></script>
<style>
  .popover {
    top: auto;
    left: auto;
  }
</style>
<script>
  $(document).ready(function(){

    // Define function to open filemanager window
    var lfm = function(options, cb) {
      var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
      window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
      window.SetUrl = cb;
    };

    // Define LFM summernote button
    var LFMButton = function(context) {
      var ui = $.summernote.ui;
      var button = ui.button({
        contents: '<i class="note-icon-picture"></i> ',
        tooltip: 'Insert image with filemanager',
        click: function() {

          lfm({type: 'image', prefix: '/filemanager'}, function(lfmItems, path) {
            lfmItems.forEach(function (lfmItem) {
              context.invoke('insertImage', lfmItem.url);
            });
          });

        }
      });
      return button.render();
    };

    // Initialize summernote with LFM button in the popover button group
    // Please note that you can add this button to any other button group you'd like
    // $('#summernote-editor').summernote({
    //   toolbar: [
    //     ['popovers', ['lfm']],
    //   ],
    //   buttons: {
    //     lfm: LFMButton
    //   }
    // })

    $('#summernote-editor').summernote({
      callbacks: {
      onChange: function(contents, $editable) {
      //find images on note-editable class,
      var imgs = $('.note-editable').find("img");
        $.each(imgs, function(index, img){
           //bootstrap 4
           $(img).addClass("img-fluid rounded mx-auto d-block");
        })
      }
  },
        placeholder: 'Type your content here...',
        tabsize: 2,
        height: 500,
        // airMode: true,
        buttons: {
        lfm: LFMButton
      },
        toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['fontname', ['fontname']],
        ['table', ['table']],
        ['popovers', ['lfm']],
        ['link', ['link']],
        ['codeview', ['codeview']],
        ['codemirror', ['codemirror']],
        ['fullscreen', ['fullscreen']],
        ['help', ['help']],
      ],
      });
  });
</script>

@endpush
