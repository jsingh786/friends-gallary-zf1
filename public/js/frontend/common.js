//THEME JS=====================================================
type = ['','info','success','warning','danger'];

demo = {
	initPickColor: function(){
		$('.pick-class-label').click(function(){
			var new_class = $(this).attr('new-class');
			var old_class = $('#display-buttons').attr('data-class');
			var display_div = $('#display-buttons');
			if(display_div.length) {
				var display_buttons = display_div.find('.btn');
				display_buttons.removeClass(old_class);
				display_buttons.addClass(new_class);
				display_div.attr('data-class', new_class);
			}
		});
	},

	initChartist: function(){

		var dataSales = {
			labels: ['9:00AM', '12:00AM', '3:00PM', '6:00PM', '9:00PM', '12:00PM', '3:00AM', '6:00AM'],
			series: [
				[287, 385, 490, 492, 554, 586, 698, 695, 752, 788, 846, 944],
				[67, 152, 143, 240, 287, 335, 435, 437, 539, 542, 544, 647],
				[23, 113, 67, 108, 190, 239, 307, 308, 439, 410, 410, 509]
			]
		};

		var optionsSales = {
			lineSmooth: false,
			low: 0,
			high: 800,
			showArea: true,
			height: "245px",
			axisX: {
				showGrid: false,
			},
			lineSmooth: Chartist.Interpolation.simple({
				divisor: 3
			}),
			showLine: false,
			showPoint: false,
		};

		var responsiveSales = [
			['screen and (max-width: 640px)', {
				axisX: {
					labelInterpolationFnc: function (value) {
						return value[0];
					}
				}
			}]
		];

		Chartist.Line('#chartHours', dataSales, optionsSales, responsiveSales);


		var data = {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
			series: [
				[542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895],
				[412, 243, 280, 580, 453, 353, 300, 364, 368, 410, 636, 695]
			]
		};

		var options = {
			seriesBarDistance: 10,
			axisX: {
				showGrid: false
			},
			height: "245px"
		};

		var responsiveOptions = [
			['screen and (max-width: 640px)', {
				seriesBarDistance: 5,
				axisX: {
					labelInterpolationFnc: function (value) {
						return value[0];
					}
				}
			}]
		];

		Chartist.Bar('#chartActivity', data, options, responsiveOptions);

		var dataPreferences = {
			series: [
				[25, 30, 20, 25]
			]
		};

		var optionsPreferences = {
			donut: true,
			donutWidth: 40,
			startAngle: 0,
			total: 100,
			showLabel: false,
			axisX: {
				showGrid: false
			}
		};

		Chartist.Pie('#chartPreferences', dataPreferences, optionsPreferences);

		Chartist.Pie('#chartPreferences', {
			labels: ['62%','32%','6%'],
			series: [62, 32, 6]
		});
	},

	initGoogleMaps: function(){
		var myLatlng = new google.maps.LatLng(40.748817, -73.985428);
		var mapOptions = {
			zoom: 13,
			center: myLatlng,
			scrollwheel: false, //we disable de scroll over the map, it is a really annoing when you scroll through page
			styles: [{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}]

		}
		var map = new google.maps.Map(document.getElementById("map"), mapOptions);

		var marker = new google.maps.Marker({
			position: myLatlng,
			title:"Hello World!"
		});

		// To add the marker to the map, call setMap();
		marker.setMap(map);
	},

	showNotification: function(from, align){
		color = Math.floor((Math.random() * 4) + 1);

		$.notify({
			icon: "pe-7s-gift",
			message: "Welcome to <b>Light Bootstrap Dashboard</b> - a beautiful freebie for every web developer."

		},{
			type: type[color],
			timer: 4000,
			placement: {
				from: from,
				align: align
			}
		});
	}
}

//END THEME JS=================================================


//A Flag to check that do our window has focus or not.
var window_focus;

$(window).focus(function() {
    window_focus = true;
}).blur(function() {
    window_focus = false;
});
  
/*
* jQuery.ajaxQueue - A queue for ajax requests
* 
* (c) 2011 Corey Frang
* Dual licensed under the MIT and GPL licenses.
*
* Requires jQuery 1.5+
*/ 
(function($) {

// jQuery on an empty object, we are going to use this as our Queue
var ajaxQueue = $({});

$.ajaxQueue = function( ajaxOpts ) {
    var jqXHR="",
        dfd = $.Deferred(),
        promise = dfd.promise();

    // queue our ajax request
    ajaxQueue.queue( doRequest );

    // add the abort method
    promise.abort = function( statusText ) {

        // proxy abort to the jqXHR if it is active
        if ( jqXHR ) {
            return jqXHR.abort( statusText );
        }

        // if there wasn't already a jqXHR we need to remove from queue
        var queue = ajaxQueue.queue(),
            index = $.inArray( doRequest, queue );

        if ( index > -1 ) {
            queue.splice( index, 1 );
        }

        // and then reject the deferred
        dfd.rejectWith( ajaxOpts.context || ajaxOpts,
            [ promise, statusText, "" ] );

        return promise;
    };

    // run the actual query
    function doRequest( next ) {
        jqXHR = $.ajax( ajaxOpts )
            .done( dfd.resolve )
            .fail( dfd.reject )
            .then( next, next );
    }

    return promise;
};

})(jQuery);

/**
 * Clear all the data from form.
 * 
 * @param form selector
 * @author jsingh
 * @since 8-oct-2012
 * @version 1.0
 */
function clear_form_elements(formm) {
	

    $(formm).find(':input').each(function () {
        switch (this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'hidden':
            case 'text':

            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });
}

/**
 * Common function for ajax call.
 *
 * @param URL
 * @param data010101
 * @param successFunc
 * @param errorFunc
 * @param timeOut
 * @returns jQuery.ajax object
 * @author jsingh7
 * @author jsingh7 [Made it more dynamic]
 * @version 1.1
 */
function AJAXCaller(URL, data010101, successFunc, errorFunc, timeOut, typeOfRequest, typeOfData, asyncValue ) {
    var xhr;
	errorFunc = typeof errorFunc !== 'undefined' ? errorFunc : errorHandle;
	timeOut = typeof timeOut !== 'undefined' ? timeOut : 50000;
	typeOfRequest = typeof typeOfRequest !== 'undefined' ? typeOfRequest : "POST";
	typeOfData = typeof typeOfData !== 'undefined' ? typeOfData : "json";
	asyncValue = typeof asyncValue !== 'undefined' ? asyncValue : true;
    xhr = jQuery.ajax({
        url: URL,
        type: typeOfRequest,
        dataType: typeOfData,
        data: data010101,
        cache: false,
        timeout: timeOut,
        success: successFunc,
		async: asyncValue,
		error: errorFunc
	});

	function errorHandle(xhr, ajaxOptions, thrownError) {
		//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
	}

    return xhr;
}

/**
 * To check any field has value with in the form or div etc
 * 
 * @author jsingh7
 * @version 1.0
 */
function checkFormHasValues( selector ){
	var i=0;
	$(selector+" :text, :file, :checkbox, select, textarea").each(function() {		
		if(($(this).is(":checkbox") && !$(this).is(":checked")) || $.trim($(this).val()) === "")
		    {
				i=i+1;
		    }
		});
	return i;
}

/**
 * returns no of controls in the form.
 * 
 * @author jsingh7
 * @version 1.0
 */
function checkNumberOfFields( selector ){
	var i=0;
	$(selector+" :text, :file, :checkbox, select, textarea").each(function() {		
		i=i+1;
	});
	return i;
}
/**
 * Function used to check that 
 * is all checkboxes checked or not.
 * 
 * @param selector of checkboxes with same class, such as $("div#abc input.cb")
 * @returns boolean
 * @author jsingh7
 * @version 1.0
 */
function isAllChecked( selector ) 
{
    if (!$( selector+':not(:checked)').length == true) // Is all checked
    {
        return true;
    } else {
        return false;
    }
}

/**
 * For no after or before space accepting textfields
 * 
 * @param selector of container tag
 * @author jsingh7
 * @version 1.0
 */
function no_around_spaces( selector )
{
	$( selector+">input[type=text]" ).keyup(function(){
		this.value=this.value.trim();
	});
}

/**
 * Pops up the jquery UI dialog
 * anywhere any time you want.
 * 
 * dialogClass:"fixed" for fixing dialog box on page.
 * @param string heading
 * @param string message
 * @param integer hide_after_duration in miliseconds [if 0 then do not hide.]
 * @param JSON settings_json
 * <code>
 * for e,g.
	{
	    buttons: [
	        {
	            text: "OK",
	            click: function(){
	                $(this).dialog("close");
	            }
	        }
	    ],
	    show: {
	        effect: "fade"
	    },
	    hide: {
	        effect: "fade"
	    },
	    dialogClass: "general_dialog_message",
	    height: 200,
	    width: 300
	}
 * </code>
 * @return unique id of dialog div.
 * @author jsingh7
 * @see http://api.jqueryui.com/dialog/
 */
function showDialogMsg( heading, message, hide_after_duration, settings_json )
{
	$("div.main_content_holder div.general_dialog_message").remove();

	var curr_timestp = jQuery.now();
	
	var dialog_html = "<div id = '"+curr_timestp+"' class='general_dialog_message' title='"+heading+"'>"+message+"</div>";
	
	$("div.main_content_holder").append( dialog_html );
	
	
	$("div.main_content_holder div.general_dialog_message").dialog(settings_json);
	
	//Open dialog.
	$( "div.main_content_holder div.general_dialog_message" ).dialog( "open" );

	if( hide_after_duration != 0 )
	{
		$("div#"+curr_timestp)
		.delay(hide_after_duration)
		.queue(function(){
			$( this )
			.dialog( "close" )
			.dequeue(); // take this function out of queue a.k.a dequeue a.k.a notify done
			// so the next function on the queue continues execution...
		});
	}
	
	return curr_timestp;
}

/**
 * Checks that is at least one checkbox is selected.
 * 
 * @author jsingh7
 * @param selector ( common selctor of group of checkboxes )
 * @returns boolean
 */
function isAtLeastOneCheckboxChecked( selector )
{
	return $(selector+':checkbox').is(':checked');
}

/**
 * Returns broken string with symbol (...),
 * if length exceeds.
 *
 * @param string str
 * @param integer len
 * @param string tail
 * @author jsingh7
 * @version 1.0
 */
function showCroppedText(str, len, tail)
{
	len = typeof len !== 'undefined' ? len : 40;
	tail = typeof tail !== 'undefined' ? tail : "...";
	if( $.trim(str).length > len+1 )
	{
		return str.substr(0, len) + tail;
	}
	else
	{
		return str;
	}	
}

/**
 * Getting parameters from URL
 * using jQuery.
 * 
 * <samp>
 * "http://dummy.com/?technology=jquery&blog=jquerybyexample".
 * var tech = GetURLParameter('technology');
 * var blog = GetURLParameter('blog');
 * </samp>
 * 
 * @param sParam
 * @returns param value
 * @version 1.0
 * @author jsingh7
 */
function getUrlParameter(sParam)
{
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++)
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return sParameterName[1];
        }
    }
}

/**
 * This is a functions that scrolls to div with id #{blah}
 * 
 * @author jsingh7
 * @version 1.0
 * @param [for e.g. id of div]
 */ 
function goToByScroll(id){
      // Remove "link" from the ID
    id = id.replace("link", "");
      // Scroll
    $('html,body').animate({
        scrollTop: $("#"+id).offset().top},
        1500);
}
