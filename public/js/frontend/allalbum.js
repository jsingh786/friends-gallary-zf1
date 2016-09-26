$(function(){
    $("#but").on("click", function(){
        
        var offset= $("button#but").attr("offset");
        var limit=3;

$.ajax({
        url : "/" + user-management-zf1 + "<album>/<allalbum>",
        method : "POST",
        data : {"methodName": "fetchalbum","limit":limit,"offset": offset},
        type : "post",
        dataType : "json",
        success : function(jsonData) {
            //Do your stuff aftee success.
                console.log(jsonData)
                var resultdata=jsonData;
                var count = resultdata.length-1;

                for(i=1;i<=count;i++) {
                $("#main").append('<div class = "Row"><div class="Colomn"><a href="#"><img src="<?php echo IMAGE_PATH ?>/static/faces/face-3.jpg" class="Img" ></a></div>'+'<div class="Colomn"><a href="#"><img src="<?php echo IMAGE_PATH ?>/static/faces/face-3.jpg" class="Img" ></a></div>'+'<div class= "Colomn"><a href="#"><img src="<?php echo IMAGE_PATH ?>/static/faces/face-3.jpg" class="Img" ></a></div></div>');
                }
                var off= parseInt($("button#but").attr("offset"));
                off+=limit;
                $("button#but").attr("offset", off);
        }
    });

});
});
