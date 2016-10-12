$(document).ready(function(){
// alert("hello");
   var offset = 0;
   var limit = 2;
   loadPhotos(limit, offset, $('input#album_id').val());
   $("#buttimg").on("click", function(){
        // var offset= 0;
        //var limit=2;
});    

function loadPhotos(limit, offset, album_id)
{
   $.ajax({
       url : "/"+PROJECT_NAME+"photo/add",
       method : "POST",
       data : {"limit":limit, "offset": offset, 'album_id': album_id},
       type : "post",
       dataType : "json",
       async: true,
       success : function(result,status,xhr) {            
       //HTML
           //HTML = '<div class = "Row">';            
            for(i in result)
          {
               //Add check that when (i+1) is divisible by 3 and has no remainder, then close the row div tag and start new row div.
               if((i+1)%3 == 0)
               {
                   HTML += '</div>';
                   HTML += '<div class = "Row">';
               }               
                HTML = '<div class = "Row">'+'<div class="Colomn">'+'<a href="#"><img src="" class="jbox-img" >'
               +'<div class="container">'+'<b>Photo:'+result[i].id+result[i].photo
               +'</b><br></div></div>'          
               //console.log(result[i].id+result[i].name);              
            }
       // $("div#main").append(HTML);

   });

}