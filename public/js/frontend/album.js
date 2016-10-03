$(document).ready(function(){
// alert("hello");
    var offset = 0;
    var limit = 9;
    loadAlbums(limit, offset, $('input#user_id').val());

    // $("#but").on("click", function(){

    // });
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
                $("#main").append('<div class="Colomn"><a href="#"><img src="" class="Img" ><div class="Info-album"><b>Name:</b>'
                    +result[i].name'<br><b>Location:</b>'
                    +result[i].location'<br><b>Description:</b>'
                    +result[i].description'<br><b>Created At:</b>'
                    +result[i].created_at'<br></div></a></div>')
            }



            return;
            //Do your stuff aftee success.
            console.log(data)
            //     var resultdata=data;
            //     var count = resultdata.length-1;

            //     for(i=1;i<=count;i++) {
            //     $("#main").append('<div class="Colomn"><a href="#"><img src="" class="Img" ><div class="Info-album"><b>Name:</b>'
            //         +resultdata[i].Name'<br><b>Location:</b>'
            //         +resultdata[i].Location'<br><b>Description:</b>'
            //         +resultdata[i].Description'<br><b>Created At:</b>'
            //         +resultdata[i].CreatedAt'<br></div></a></div>')
            // }
            //     var off= parseInt($("button#but").attr("offset"));
            //     off+=limit;
            //     $("button#but").attr("offset", off);
        }
    });
}