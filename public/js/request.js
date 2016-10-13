$(function(){
    $("#search").keyup(function() {
    var data= $(this).val();

$.ajax({
    type: "POST",
    dataType: "json",
    url: "friends-gallary-zf1/user/ajax",
    data: {"pattren" data},
    success: function(jsondata) {
    	console.log(jsondata)
    // var resultdata= jsondata;
    // var count = resultdata.length-1;
    // for(var i=1; i<=count; i++) {
    // $("#main").append('<div class ="div1"><div class="div2"><div class="text1">'+resultdata[i].name+'</div><div class="text1">'+resultdata[i].gender+'</div></div><div class="div3"><div class="text2">'+resultdata[i].EmailID+'</div><div class="text3">'+resultdata[i].Address+'</div></div></div>');
    // }
    // var off= parseInt($("button#but").attr("offset"));
    // off+=limit;
    // $("button#but").attr("offset", off);   

    }
    });
});
});
    