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
                    <a href="#" class="btn btn-danger btn-sm" id="delete-post" data-id="{{$post->id}}">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('scripts')
 
    <script>
            $("body").on("click","#delete-post",function(){
                let postId = $(this).data("id");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"POST",
                    url:"/posts/"+postId+"/delete",
                    dataType:"json",
                    data:{},
                    success:function(data){
                        alert(data.success);
                        reloadData();
                    }
                })
                return false;
            })
           
    </script>
@endsection