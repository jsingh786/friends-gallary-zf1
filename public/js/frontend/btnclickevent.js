$(function () {
	$('#friend').on("click", function() 
	{
		// alert("working");
		var txt = $('#friend').attr("data"); 
		 // alert(txt);
		$.ajax({
			url: "/friends-gallary-zf1/request/add", 
			type: "POST",
			datatype: "text",
			data:{"id":txt},
			success: function(result){
				var obj=JSON.parse(result);
				// console.log(result[0]);
				$('#friend').attr("value",obj.stat);
				// attr("href", "http://www.w3schools.com/jquery"); 
            	// $("#add").html(result);
            	// alert(result);
            
            }
        });
	});
});