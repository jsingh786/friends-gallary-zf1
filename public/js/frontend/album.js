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

            //HTML
            HTML = '';
            HTML += '<div class = "Row">';

            for(i in result)
            {
                //Add check that when (i+1) is divisible by 3 and has no remainder, then close the row div tag and start new row div.
                if((i+1)%3 == 0)
                {
                    HTML += '</div>';
                    HTML += '<div class = "Row">';
                }

                HTML = '';

                //console.log(result[i].id+result[i].name);

            }
            $("div#main").append(HTML);
        }
    });
}

