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
                            @php
                                $lokasi = collect(['home', 'page', 'blog']);
                                $tipe2 = collect(array('1' =>'HTML/Text', 'Menu', 'Recent Post', 'Archieve By Category'));
                            @endphp
                            @csrf
                            @method(!empty($data) ? 'PATCH':'POST')
                                <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <label for="namawidget">Nama Widget</label>
                                    <input type="text" name="title" value="{{ isset($data) ? $data->title:old('title') }}" class="form-control" id="namawidget" placeholder="Nama Widget">
                                  </div>
                                  <div class="form-group col-md-4">
                                    <label for="tipewidget">Tipe widget</label>
                                    <select id="tipewidget" class="form-control" name="widget_type" required>
                                      <option value="" selected>Pilih tipe</option>
                                      @foreach ($tipe2 as $item => $value)
                                    <option {{ (isset($data) && $data->widget_type == $item) ? 'selected':'' }} value="{{ $item }}">{{ $value }}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="form-group col-md-2">
                                    <label for="urutan">Urutan tampil</label>
                                    <input type="number" name="ordered" value="{{ isset($data) ? $data->ordered:0 }}" class="form-control" id="urutan"  required placeholder="Urutan">
                                  </div>
                                </div>
                                <div class="form-group" id="widget_content">

                                  <label for="inputAddress" class="border-bottom">Widget Content</label>
                                <section class="html" style="display:{{ (isset($data) && $data->widget_type == 1) ? '':'none'}}">
                                    <textarea name="widget_content" id="summernote-editor" {{ (isset($data) && $data->widget_type == 1) ? '':'required disabled'}}>{{ isset($data) ? $data->widget_content:'' }}</textarea>
                                </section>

                                <select name="widget_content" id="menu" class="form-control" style="display:{{ (isset($data) && $data->widget_type == 2) ? '':'none'}}" {{ (isset($data) && $data->widget_type == 2) ? '':'required disabled'}} >
                                    <option value="">Pilih menu</option>
                                    @foreach (\App\Menu::all() as $item)
                                        <option {{ (isset($data) && $data->widget_content == $item->id) ? 'selected':''}} value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                  </select>
                                  <section id="blog" style="display:{{ (isset($data) && $data->widget_type == 3) ? '':'none'}}">
                                        <div class="form-row">
                                            <input type="hidden" name="blog" id="isblog" disabled>
                                          <div class="form-group col-md-6">
                                            <label for="kategori">Pilih Kategori</label>
                                            <select id="kategori" class="form-control" name="widget_content[]"  {{ (isset($data) && $data->widget_type == 3) ? '':'required disabled'}}>
                                                <option value="0">Semua</option>
                                                @foreach (\App\Category::all() as $item)
                                                    <option {{ (isset($data) && json_decode($data->widget_content)[0] == $item->id) ? 'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                              </select>
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="ascdesc">Urutan Tampil</label>
                                            <select id="ascdesc" class="form-control"  name="widget_content[]" {{ (isset($data) && $data->widget_type == 3) ? '':'required disabled'}}>
                                              <option {{ (isset($data) && json_decode($data->widget_content)[1] == 'desc') ? 'selected':''}} value="desc">Descending</option>
                                              <option {{ (isset($data) && json_decode($data->widget_content)[1] == 'asc') ? 'selected':''}} value="asc">Ascending</option>
                                            </select>
                                          </div>
                                          <div class="form-group col-md-2">
                                            <label for="limit">Limit</label>
                                            <input type="number" class="form-control" id="limit" value="{{ isset($data) ? json_decode($data->widget_content)[2]:'5' }}" name="widget_content[]"  {{ (isset($data) && $data->widget_type == 3) ? '':'required disabled'}}>
                                          </div>
                                        </div>
                                  </section>
                                  <section id="tahun" style="display:{{ (isset($data) && json_decode($data->widget_type) == 4) ? '':'none'}}">
                                    <div class="form-row">
                                      <div class="form-group col-md-4">
                                        <label for="tahunascdesc">Tampilkan bulan secara</label>
                                        <select id="tahunascdesc" class="form-control"  name="widget_content" {{ (isset($data) && $data->widget_type == 4) ? '':'required disabled'}}>
                                            <option {{ (isset($data) && $data->widget_content == 'desc') ? 'selected':''}} value="desc">Descending</option>
                                            <option {{ (isset($data) && $data->widget_content == 'asc') ? 'selected':''}} value="asc">Ascending</option>
                                        </select>
                                      </div>
                              </section>
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
                                            <select name="status" class="custom-select my-1 mr-sm-2" id="intlink">
                                                <option value="1" {{ (!empty($data) && $data->status == 1 ? 'selected':'')}}>Tampilkan</option>
                                                <option value="0" {{ (!empty($data) && $data->status == 0 ? 'selected':'')}}>Sembunyikan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header border-bottom">
                                    <h6 class="m-0">Lokasi widget</h6>
                                  </div>
                                  <div class="card-body pl-2 pr-2">

                                      <div class="row">
                                          <div class="col">
                                            @php
                                            $checked_arr = [];
                                                        if (!empty($data) AND $data->show_at != 'null') {
                                                            foreach (json_decode($data->show_at) as $f){
                                                                $checked_arr[] = $f;
                                                            }
                                                        }

                                                // dd($checked_arr);

                                                foreach($lokasi as $e){
                                                    $checked = "";
                                                    $default = !empty($data) AND $e == 'home' ? '':'';
                                                    if(in_array($e, $checked_arr)){
                                                    $checked = "checked";
                                                    }
                                                    echo '<div class="custom-control custom-checkbox">
                                                        <input '.$default.' type="checkbox" id="myId'.$e.'" name="show_at[]" class="custom-control-input" value="'.$e.'" '.$checked.'>
                                                        <label class="custom-control-label" for="myId'.$e.'">'.$e.'</label>
                                                        </div>';
                                                }
                                            @endphp
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
                                            {{ $data->status == 1 ? 'Tampil':'Tidak tampil' }}
                                        @endisset
                                       </span>
                                    </li>
                                    <li class="list-group-item d-flex px-3">
                                      <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-copy"></i> Simpan Widget</button>
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
        $('#tipewidget').change(function(){
            switch (this.value) {
                case '1':
                    $('.html').show()
                    $('#menu').hide()
                    $('#blog').hide()
                    $('#kategori').prop('disabled', true)
                    $('#ascdesc').prop('disabled', true)
                    $('#limit').prop('disabled', true)
                    $('#isblog').prop('disabled', true)
                    $('#summernote-editor').prop('disabled', false)
                    break;
                case '2':
                    $('.html').hide()
                    $('#menu').show()
                    $('#menu').prop('disabled', false)
                    $('#blog').hide()
                    $('#tahun').hide()
                    $('#tahunascdesc').prop('disabled', true)
                    $('#kategori').prop('disabled', true)
                    $('#isblog').prop('disabled', true)
                    $('#ascdesc').prop('disabled', true)
                    $('#limit').prop('disabled', true)
                    $('#summernote-editor').prop('disabled', true)
                    break;
                case '3':
                    $('.html').hide()
                    $('#menu').hide()
                    $('#blog').show()
                    $('#tahun').hide()
                    $('#tahunascdesc').prop('disabled', true)
                    $('#kategori').prop('disabled', false)
                    $('#isblog').prop('disabled', false)
                    $('#ascdesc').prop('disabled', false)
                    $('#limit').prop('disabled', false)
                    $('#menu').prop('disabled', true)
                    $('#summernote-editor').prop('disabled', true)
                    break;
                case '4':
                   $('.html').hide()
                    $('#menu').hide()
                    $('#blog').hide()
                    $('#tahun').show()
                    $('#tahunascdesc').prop('disabled', false)
                    $('#kategori').prop('disabled', true)
                    $('#ascdesc').prop('disabled', true)
                    $('#limit').prop('disabled', true)
                    $('#menu').prop('disabled', true)
                    $('#isblog').prop('disabled', true)
                    $('#summernote-editor').prop('disabled', true)
                    break;
                default:
                    $('.html').hide()
                    $('#menu').hide()
                    $('#blog').hide()
                    $('#tahun').hide()
                    $('#tahunascdesc').prop('disabled', true)
                    $('#kategori').prop('disabled', true)
                    $('#ascdesc').prop('disabled', true)
                    $('#limit').prop('disabled', true)
                    $('#isblog').prop('disabled', true)
                    $('#summernote-editor').prop('disabled', true)
                    break;
            }
        })
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
        height: 200,
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
