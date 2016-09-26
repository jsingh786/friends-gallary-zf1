//IMPORTANT VARIABLES
var url = window.location.href;
var temp_r = url.split("/");
var final_url = temp_r[0] + "//" + temp_r[2] + "/";

var PROJECT_NAME = "friends-gallary-zf1/";
var PROJECT_URL = final_url;
var PUBLIC_PATH = PROJECT_URL+PROJECT_NAME+"public";
var IMAGE_PATH = PUBLIC_PATH+"/images";
var REL_IMAGE_PATH = "images";
