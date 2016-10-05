/** 
 * @author KaurHarjinder
 * @version 1.0
 */ 
$(document).ready(function(){

    var offset = 0;
    var limit = 9;
    loadAlbums(limit, offset, $('input#user_id').val());
});    

function loadAlbums(limit, offset, user_id)
{
    $.ajax({
        url : "/"+PROJECT_NAME+"album/get-all-albums-of-loggedin-user",
        method : "POST",
        data : {"limit":limit, "offset": offset, 'user_id': user_id},//Set paramerters
        type : "post",
        dataType : "json",
        async: true,
        success : function(result,status,xhr) {

            var HTML = "";
            HTML += '<div class = "Row">';//Start Row

            for(i in result){
                    //Showing 9 dynamic records with index 0
                if(i <= 8){

                    HTML += '<div class="Colomn">'+'<a href="#"><img src="" class="Img" >'+'<div class="Info-album">'+'<b>Name:'+result[i].id+result[i].name+'</b><br><b>Location:'+result[i].location+'</b><br><b>Description:'+result[i].description+'</b><br><b>Created At:'+result[i].created_at+'</b><br></div></div>';

                }
            }

            $("div#main").append(HTML);      
        }
                   
    });
}

