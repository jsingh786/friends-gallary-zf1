$(function(){
    $("#but").on("click", function(){
        
        var offset= 0;
        var limit=9;

$.ajax({
        url : "/" + user-management-zf1 + "album/index",
        method : "POST",
        data : {"limit":limit, "offset": offset, 'user_id': user_id},
        type : "post",
        dataType : "json",
        success : function(data) {
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

});
});
