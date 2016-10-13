/** 
 * @author KaurHarjinder
 * @version 1.0
 */ 
$(document).ready(function(){
    var offset= 0;
    var limit = 9;
<<<<<<< HEAD
=======
<<<<<<< HEAD
    loadAlbums(limit, offset, $('input#user_id').val());
    $("#but").on("click", function(){
           var offset= 0;
        var limit=9;
});    

=======
>>>>>>> c655cd5a3328e1b592ac722d90fff648f90ecabe
    var order = 'DESC';
    var column = 'id';
    loadAlbums(limit, offset, $('input#user_id').val(), order, column);
    $('#but').click(function(){
        //alert($(this).attr('rel'));
        loadAlbums(limit, $(this).attr('rel'), $('input#user_id').val(), order, column);
    });  
<<<<<<< HEAD
=======
>>>>>>> b2d2dc8edce747bf690cc626fc8b2d93ccef7b26
>>>>>>> c655cd5a3328e1b592ac722d90fff648f90ecabe
});
function loadAlbums(limit, offset, user_id, order, column)
{
    $.ajax({
        url : "/"+PROJECT_NAME+"album/get-all-albums-of-loggedin-user",
        method : "POST",
        data : {"limit":limit, "offset": offset, 'user_id': user_id, 'order':order, 'column' : column},//Set paramerters
        dataType : "json",
        async: true,
        success : function(result,status,xhr) {
<<<<<<< HEAD

<<<<<<< HEAD
            var HTML = "";
            //Start division Row here after main division
=======
            //HTML
            HTML = '<div id = "main">';
>>>>>>> c655cd5a3328e1b592ac722d90fff648f90ecabe
            HTML += '<div class = "Row">';
            $('#but').attr('rel',result.length);
            //i is index in album table and its value start from 0
            for(i in result){
                    //Showing 9 dynamic records in divsion colomn
               //if(i <= 8){

<<<<<<< HEAD
                    HTML += '<div class="Colomn">'+'<a href="#"><img src="" class="Img" >'+'<div class="Info-album">'+'<b>Name:'+result[i].id+result[i].name+'</b><br><b>Location:'+result[i].location+'</b><br><b>Description:'+result[i].description+'</b><br><b>Created At:'+result[i].created_at+'</b><br></div></div>';
                }

               // }

            $("div#main").append(HTML);      
=======
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
=======
            
            var HTML = "";
            //Start division Row here after main division
            HTML += '<div class = "Row">';
            $('#but').attr('rel',result.length);
            //i is index in album table and its value start from 0
            for(i in result){
                    //Showing 9 dynamic records in divsion colomn
               //if(i <= 8){

                    HTML += '<div class="Colomn">'+'<a href="#"><img src="" class="Img" >'+'<div class="Info-album">'+'<b>Name:'+result[i].id+result[i].name+'</b><br><b>Location:'+result[i].location+'</b><br><b>Description:'+result[i].description+'</b><br><b>Created At:'+result[i].created_at+'</b><br></div></div>';
                }

               // }

            $("div#main").append(HTML);      
>>>>>>> b2d2dc8edce747bf690cc626fc8b2d93ccef7b26
>>>>>>> c655cd5a3328e1b592ac722d90fff648f90ecabe
        }
                   
    });
}


// function loadmoreAlbums(limit, offset, user_id)
// {
//     $.ajax({
//         url : "/"+PROJECT_NAME+"album/get-all-albums-of-loggedin-user",
//         method : "POST",
//         data : {"limit":limit, "offset": offset, 'user_id': user_id},//Set paramerters
//         type : "post",
//         dataType : "json",
//         async: true,
//         success : function(result,status,xhr) {

//             var HTML = "";
//             //Start division Row here after main division
//             HTML += '<div class = "Row">';

//             //i is index in album table and its value start from 0
//             for(i in result){
//                     //Showing 9 dynamic records in divsion colomn
//                 if(i >= 8){

//                     HTML += '<div class="Colomn">'+'<a href="#"><img src="" class="Img" >'+'<div class="Info-album">'+'<b>Name:'+result[i].id+result[i].name+'</b><br><b>Location:'+result[i].location+'</b><br><b>Description:'+result[i].description+'</b><br><b>Created At:'+result[i].created_at+'</b><br></div></div>';

//                 }
//             }

//             $("button#but").append(HTML);      
            
//             }
                   
//         });
//     }

// }

//$(this).attr('rel')