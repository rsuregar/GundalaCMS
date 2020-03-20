<div class="modal-body">
    <h4>Edit Menu item</h4>
    <hr>
<form action="{{ $action }}" method="POST">
    @csrf
    @method($method)
    <div class="form-row">
        <div class="form-group col-md-12">
          <label for="exampleFormControlInput1">Nama Menu</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" value="{{ $menuitem->name }}">
        </div>
        <div class="form-group col-md-12">
            <label for="inputState">URL link</label>
            <textarea type="text" name="link" id="link" class="form-control" required>{{ $menuitem->link}}</textarea>
        </div>
        <div class="form-group col-md-12">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="editsumber">
                <label class="custom-control-label" for="editsumber">Gunakan sumber internal</label>
            </div>
        </div>
        <div class="form-group col-md-12" id="internal">
            {{-- <label for="inputState">Sumber internal link</label> --}}
            <select name="inlink" id="internaledit" data-placeholder="Pilih sumber dari internal" style="width: 465px;" class="chosen-select" tabindex="2" >
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
        <div class="form-group col-md-4">
          <label for="exampleFormControlSelect1">Tipe Menu</label>
          <select name="type" id="inputState" class="form-control" required>
            <option {{ $menuitem->type == 'link' ? 'selected':''}} value="link">Link</option>
            <option {{ $menuitem->type == 'submenu' ? 'selected':''}} value="submenu">Submenu</option>
          </select>
        </div>
        <div class="form-group col-md-8">
            <label for="inputState">Parent id</label>
            <select name="parent_id" id="inputState" class="form-control" required>
              <option value="0">Tanpa Parent</option>
              @foreach (\App\Menuitem::where('parent_id', 0)->get() as $item)
                    <option {{ $item->id == $menuitem->parent_id ? 'selected':'' }} value="{{ $item->id }}">{{ $item->name }}</option>
                    @foreach (\App\Menuitem::where('parent_id', '<>', 0)->get() as $items)
                        @if ($items->parent_id == $item->id)
                        <option {{ $items->id == $menuitem->parent_id ? 'selected':'' }} value="{{ $items->id }}">&nbsp;&nbsp;&#11169; &nbsp; {{ $items->name }}</option>
                        @endif
                    @endforeach
              @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="inputState">Urutan tampil</label>
            <input type="number" step="0.01" name="ordered" class="form-control" value="{{ $menuitem->ordered}}" required>
        </div>
        <div class="form-group col-md-6">
            <label for="inputState">Tipe menu</label>
            <select name="is_active" id="inputState" class="form-control" required>
              <option {{ $menuitem->is_active == 1 ?  'selected':'' }} value="1">Aktif</option>
              <option {{ $menuitem->is_active == 0 ?  'selected':'' }} value="0">Tidak Aktif</option>
            </select>
        </div>
    </div>
    <hr>
    <div class="text-right">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan perubahan</button>
    </div>
</form>
</div>

<script>
    $('#editsumber').click(function(){
            if($(this).prop('checked') == true){
                $('#link').prop('required', false).prop('disabled', true);
                $('#internaledit').attr("required", true)
                $('#internaledit').attr("disabled", false)
            }else{
                $('#link').prop('required', true).prop('disabled', false);
                $('#internaledit').prop("required", false)
                $('#internaledit').prop("disabled", true);
            }
        });
</script>
