reloadData();
function reloadData(){
    
    $.ajax({
        type:"GET",
        url:"/posts",
        dataType:"json",
        data:{},
        success:function(data){
            
            $("#data").html(data.html);
        },
        error:function(error){
            alert("error");
        }
    });
}