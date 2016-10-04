$(document).ready(function(){
// alert("hello");
    var offset = 0;
    var limit = 9;
    loadAlbums(limit, offset, $('input#user_id').val());
    $("#but").on("click", function(){
           var offset= 0;
        var limit=9;
});    

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

            //HTML
            HTML = '<div id = "main">';
            HTML += '<div class = "Row">';

            for(i in result)
            {
                //Add check that when (i+1) is divisible by 3 and has no remainder, then close the row div tag and start new row div.
                if((i+1)%3 == 0)
                {
                    $("div#main").append(HTML);
                    HTML += '</div>';
                    HTML += '<div class = "Row">';
                }

                HTML = '<div class="Colomn"><a href="#"><img src="" class="Img" ><div class="Info-album"><b>Name:'+result[i].id+result[i].name+'</b><br><b>Location:'+result[i].location+'</b><br><b>Description:'+result[i].description+'</b><br><b>Created At:'+result[i].created_at+'</b><br>'
                //console.log(result[i].id+result[i].name);
            }
            //alert("Name: " + result[i].id);
           // $("div#main").append(HTML);
        }
    });
}

