<?php
require_once 'dbconfig.php';
function checkuser($fb_uid,$fb_fname,$fb_email,$fb_likes){
    $check = mysql_query("select * from member where member_fb_id='$fb_uid'");
	$check = mysql_num_rows($check);
	if (empty($check)) { // if new user . Insert a new record
        $query = "INSERT INTO member (member_fb_id,member_fname,member_email,member_fb_likes) VALUES ('$fb_uid','$fb_fname','$fb_email','$fb_likes')";
	   mysql_query($query);
	} else {   // If Returned user . update the user record
        $query = "UPDATE member SET member_fname='$fb_fname', member_email='$fb_email', member_fb_likes='$fb_likes' where member_fb_id='$fb_uid'";
	   mysql_query($query);
	}
}?>
