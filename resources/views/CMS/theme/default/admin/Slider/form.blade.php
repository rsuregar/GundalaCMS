@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ $title ?? env('APP_NAME') }} <span class="float-right"> <a class="btn btn-outline-secondary btn-sm" href="{{ route(Request::segment(2).'.index') }}"><i class="fas fa-arrow-left"></i> Kembali</span></a></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                        <form class="mt-3" action="{{ !empty($data) ? route(Request::segment(2).'.update', [$data->id]):route(Request::segment(2).'.store')}}" method="POST" >
                            @csrf
                            @method(!empty($data) ? 'PATCH':'POST')
                                <div class="form-label-group">
                                <input type="text" id="title" name="title" class="form-control form-control-lg" placeholder="Title address" required autofocus value="{{ !empty($data) ? $data->title:old('title')}}">
                                    <label for="title">Judul slide</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="url" id="link" name="link" class="form-control form-control-lg" placeholder="Title address" required autofocus value="{{ !empty($data) ? $data->link:old('link')}}">
                                        <label for="link">Paste full link slide</label>
                                </div>
                                <div class="input-group">
                                    <input id="thumbnail" class="form-control" type="text" name="image" placeholder="Paste link gambar disini atau pilih dari media" value="{{ !empty($data) ? $data->image: old('image') }}">
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
                        </div>
                        <div class="col-md-3">
                              <div class='card card-small mb-3'>
                                <div class="card-header border-bottom">
                                  <h6 class="m-0">Urutan slide</h6>
                                </div>
                                <div class='card-body p-0'>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-3 pb-2">
                                        <input type="number" name="ordered" class="form-control" placeholder="Urutan slide" value="{{ !empty($data) ? $data->ordered:old('ordered') }}" />
                                        </li>
                                    </ul>
                                </div>
                              </div>
                              <div class="card card-small mb-3">
                                <div class="card-header border-bottom">
                                  <h6 class="m-0">Aksi</h6>
                                </div>
                                <div class="card-body p-0">
                                  <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-3">
                                      <span class="d-flex mb-2"><i class="fas fa-flag mr-1" style="line-height: 1.5"></i><strong class="mr-1">Status:</strong> {{ !empty($data) ? $data->status:''}}
                                       </span>
                                    </li>
                                    <li class="list-group-item d-flex px-3">
                                      <button class="btn btn-sm btn-outline-primary" name="draft"><i class="fas fa-save"></i> Simpan konsep</button>
                                      <button class="btn btn-sm btn-primary ml-auto" type="submit" name="publish"><i class="fas fa-copy"></i> Publikasikan</button>
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
            @include('CMS.theme.default.components.sidebar')
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
