<?php
session_start();

//Include Google client library 
include_once 'Google/Google_Client.php';
include_once 'Google/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '320786487931-9cm8q9vb5s2k6umnsd26mevgtgr8q66j.apps.googleusercontent.com'; //Google client ID
$clientSecret = 'Rp_asBcnqS_0VGlN4dhdvRuj'; //Google client secret
$redirectURL = 'http://pereyrateam.com/cloudsolution/index.php'; //Callback URL

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to CodexWorld.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>