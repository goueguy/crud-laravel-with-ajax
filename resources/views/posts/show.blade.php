@extends('layouts.app')
@section('content')

<table class="table table-bordered">
    <thead class="bg-dark">
        <tr class="text-white">
            <th>#ID</th>
            <th>TITLE</th>
            <th>CONTENT</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $key=>$post)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->content}}</td>
                <td>
                    <form id="deletePost">
                        <input type="hidden" id="postId" value="{{$post->id}}"/>
                        <input type="submit" class="btn btn-warning btn-sm" value="delete"/>
                    </form>
                     
                    <a href="#" class="btn btn-danger btn-sm" id="edit-post"  data-id="{{$post->id}}">Edit</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('scripts')
 
    <script>
            $("form#deletePost").on("submit",function(event){
                event.preventDefault();
                let postId = $("#postId").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
               if(confirm("ARE YOU SURE TO DELETE THAT")){
                    $.ajax({
                        type:"POST",
                        url:"/posts/"+postId+"/delete",
                        dataType:"json",
                        data:{},
                        success:function(data){
                            swal("Good job!", data.success, "success");
                            //alert(data.success);
                            reloadData();
                    }
                })
               }
            });
           
            //edit post
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').trigger('focus')
            })
            $("body").on("click","#edit-post",function(){
                let idPost = $(this).data("id");
                
                $.ajax({
                    type:"GET",
                    url:"/posts/"+idPost+"/edit",
                    dataType:"json",
                    success:function(data){
                    //console.log(data["title"]);
                       $("#modal").modal("show");
                       $("#title").val(data.title);
                       $("#message").val(data.content);
                       $("#postId").val(data.id);
                    }
                })
                return false;
            });
           
    </script>
@include('posts.modal-edit')
@endsection