<?php
session_start();
// added in v4.0.0
require_once 'autoload.php';
require_once 'functions.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( '810631322358561','190cfe53ea7a6f8b0687d895be1c1637' );
// login helper with redirect_uri
$helper = new FacebookRedirectLoginHelper('https://www.readyanddrive.com/fb/fbconfig.php' );
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
    $request = new FacebookRequest( $session, 'GET', '/me' );
    $request2 = new FacebookRequest( $session, 'GET', '/me/likes?fields=id' );
  $response = $request->execute();
  $response2 = $request2->execute();


  // get response
    $graphObject = $response->getGraphObject();
    $graphObject2 = $response2->getGraphObject();

    $likes = $graphObject2->getProperty('data'); // json decode from web service
    $user_likes = $likes->asArray();

    $my_array = json_encode ($user_likes);
    $mydata = json_decode($my_array,true);
    //$my_array = json_decode($user_likes, true);
    foreach($mydata as $result) {
        if ( $result["id"] == '118926511456194' ) {
            $fb_likes = $result["id"];
        }
    }
    /*echo "<pre>";
    var_dump( $my_array );
    echo "</pre>";*/
    $fb_uid = $graphObject->getProperty('id');              // To Get Facebook ID
    $fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
    $fb_email = $graphObject->getProperty('email');    // To Get Facebook email ID
    //$fb_likes = $graphObject->getProperty('likes');    // To Get Facebook Like Page ID
	/* ---- Session Variables -----*/
    $_SESSION['FBID'] = $fb_uid;
    $_SESSION['FULLNAME'] = $fbfullname;
    $_SESSION['EMAIL'] =  $fb_email;
    $_SESSION['FBLIKED'] = $fb_likes;

    checkuser($fb_uid,$fbfullname,$fb_email,$fb_likes);
    /* ---- header location after session ----*/
    header("Location: https://www.readyanddrive.com/vote.php");
} else {
    $loginUrl = $helper->getLoginUrl();
    header("Location: ".$loginUrl);
}
?>


