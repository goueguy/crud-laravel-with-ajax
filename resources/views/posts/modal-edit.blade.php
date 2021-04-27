
<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="updatePost">
            <div class="form-group">
                <input type="text" class="form-control" name="title" id="title" value=""/>
                <span class="error title_error"></span>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="message" id="message" value=""/>
                 <span class="error content_error"></span>
            </div>
            </div>
                <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="button" id="btn-update" class="btn btn-danger">Modifier</button>
                </div>
       </form>
    </div>
  </div>
</div>

<script>

    $("#btn-update").on("click",function(){
        let postId = $("#postId").val();
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
                type:"POST",
                url:"/posts/"+postId+"/update",
                dataType:"json",
                data:$("#updatePost").serialize(),
                success:function(data){
                     //$("#modal").$(this).closest('.modal').modal('hide');modal("hide");
                     reloadData();
                    $(".modal").modal("hide");
                }
            })
        });
</script>


