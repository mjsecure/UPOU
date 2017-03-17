<?php
session_start();

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '595849078387-l42tu5i19nj47h1vvbuass00uef33qgs.apps.googleusercontent.com'; //Google client ID
$clientSecret = '2oMyfe4lNhfzVTD-V9bphF22'; //Google client secret
$redirectURL = 'http://localhost/UPOU/admin'; //Callback URL


//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to CodexWorld.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);
$gClient->setApprovalPrompt('auto');


$google_oauthV2 = new Google_Oauth2Service($gClient);
?>