
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <form id="saveForm" class="mt-5">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title" value="{{ old('title') }}">
                    <span class="text-danger error-text title_error"></span>
                </div>
                
                <div class="form-group">
                    <label for="content">Message</label>
                    <textarea name="content" id="content" cols="30" rows="10" class="form-control" >{{ old('content') }}</textarea>
                    <span class="text-danger error-text content_error"></span>
                </div>
                <button type="submit" class="btn btn-primary  btn-block">AJOUTER POST</button>
            </form>
        </div>
        <div class="col-lg-12 mt-5">
            <div id="data"></div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
 <script src="/assets/js/main.js"></script>
<script>
    $("#saveForm").on("submit",function(event){
        event.preventDefault();
        let postId = $("#postId").val();
            
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"POST",
                url:"/posts/store",
                data:$("#saveForm").serialize(),
                dataType:"json",
                beforeSend:function(){
                    $(document).find("span.error-text").text('');
                },
                success:function(data){
                    //alert(data.success);
                    
                    if(data.status==0){
                        $.each(data.error,function(prefix, val){
                            //console.log(prefix);
                            $("span."+prefix+"_error").text(val[0]);
                        });
                    }else{
                        reloadData();
                        swal("Good job!", data.success, "success");
                        $("#saveForm")[0].reset();
                    }
                },
                error:function(error){
                    $.each(error.error,function(prefix, val){
                        console.log(val[0]);
                    });
                    //console.log(error);
                }
            })  
    });
</script>
@endsection