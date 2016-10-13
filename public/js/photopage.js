jQuery(function($)
{
  $('#mybutton').on('click', function(e){
    e.preventDefault();
    var count=parseInt($('#mybutton').attr("count"));
    var no=count+1;
    // alert(no);
    $('#mybutton').attr("count",no);{

    var r = $('</br>'+'<label>Select Image::</label>'+'</br>'+'<input/>').attr({
      type: "File",
      id: "field",
      name: "file"+ no,
    });
    var a = $('<label>Description::</label>'+'</br>'+'<textarea/>'+'</br>').attr({
      rows: "2",
      columns: "6",
      name: "description" + no,
    });
      $("form").append(r);
      $("form").append(a); 
  })
})
}

   

