<div class="modal" id="modalConfirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Konfirmasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{ $slot }}
        </div>
        <form action="" method="POST" id="deleteForm">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak </button>
          <button type="submit" class="btn btn-primary">Hapus  </button>
        </div>
        @csrf
        @method('DELETE')
        </form>
      </div>
    </div>
</div>

<div class="modal" id="theModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

      </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.delete').click(function(){
            var action = this.getAttribute('target-action');
            $("#deleteForm").attr('action', action);
            $('#modalConfirmation').modal('toggle');
        });


        $('.li-modal').on('click', function(e){
    // alert('halo');
        $('#theModal').modal('show').find('.modal-content').html('<div class="modal-body">Loading...</div>');

        e.preventDefault();
        $('#theModal').modal('show').find('.modal-content')
        //
            // .load('http://localhost/Admin/vertical-green/index.html')
            .load($(this).attr('href'), function(response, status,xhr){
                $('.chosen-select').chosen()
                if ( status == "error" ) {
                $('#theModal').modal('show').find('.modal-content').html('<div class="modal-body">Sorry but there was an error : <strong>'+xhr.status+'</strong> '+xhr.statusText+'</div>');
                    console.log( xhr.statusText );
                }
            });
        });

    });
</script>
