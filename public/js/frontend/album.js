$(document).ready(function(){
// alert("hello");
    var offset = 0;
    var limit = 9;
    loadAlbums(limit, offset, $('input#user_id').val());
    $("#but").on("click", function(){
           var offset= 0;
        var limit=9;
    $.ajax({

});
function loadAlbums(limit, offset, user_id)
{
    $.ajax({
        url : "/"+PROJECT_NAME+"album/get-all-albums-of-loggedin-user",
        method : "POST",
        data : {"limit":limit, "offset": offset, 'user_id': user_id},
        type : "post",
        dataType : "json",
        async: true,
        success : function(result,status,xhr) {
            for(i in result)
            {
                //console.log(result[i].id+result[i].name);
                $("div#main").append(result[i].id+result[i].name+result[i].location+result[i].description+result[i].created_at)
            }
            return;
            //Do your stuff aftee success.
            console.log(data)
        }
    });
}

