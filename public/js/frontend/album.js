/** 
 * @author KaurHarjinder
 * @version 1.0
 */ 
 var newoffset =  9;
 var counterForOffset =  1;

$(document).ready(function(){
    var offset= 0;
    var limit = 9;
    loadAlbums(limit, offset, $('input#user_id').val());
    $('#but').click(function(){
        //alert($(this).attr('rel'));
        loadAlbums(limit, $(this).attr('rel'), $('input#user_id').val());
        /*if($(this).val() = '') {
           $('#but').prop('disabled', false);
        }*/
    });  
});
function loadAlbums(limit, offset, user_id)
{
    $.ajax({
        url : "/"+PROJECT_NAME+"album/get-all-albums-of-loggedin-user",
        method : "POST",
        data : {"limit":limit, "offset": offset, 'user_id': user_id},//Set paramerters
        dataType : "json",
        async: true,
        success : function(result,status,xhr) {

            var HTML = "";
            newoffset = parseInt(newoffset) * parseInt(counterForOffset);
            counterForOffset++;

            if(result.length > 0){
            //Start division Row here after main division
            HTML += '<div class = "Row">';
           // $('#but').attr('rel',result.length);
            $('#but').attr('rel',newoffset);
            //i is index in album table and its value start from 0
            for(i in result){
                    //Showing 9 dynamic records in divsion colomn
               //if(i <= 8){

                //console.log(result);

               // console.log(result[i].photos[0].name);

                    HTML += '<div class="Colomn">'+'<a href="#"><img src="http://localhost/friends-gallary-zf1/public/images/albums/' + result[i].name + '/' + result[i].photo + '" class="Img" />'+'<div class="Info-album">'+'<b>Name:'+result[i].id+result[i].name+'</b><br><b>Location:'+result[i].location+'</b><br><b>Description:'+result[i].description+'</b><br><b>Created At:'+result[i].created_at+'</b><br></div></div>';

                   // $("div#main").append(HTML);      
                   // return false;

               // }
            }
                $("div#main").append(HTML);  
         }else{ alert('no record found'); $('#but').hide();}       
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