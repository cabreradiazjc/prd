<?php
date_default_timezone_set('America/Lima');
session_start();

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
//$clientId = '1028009629426-ovr9sfoc18nce9ocr945m1hbvtiq16pu.apps.googleusercontent.com';
$clientId = '1028009629426-8ah0kdc1omi747rrqe8no0q362ucqank.apps.googleusercontent.com';
//$clientSecret = 'CVpK7A9PzQvZpTsdW2uMMRHX';
$clientSecret = 'f6iR_8bBZlg7wpG2H3VTIMdw';
$redirectURL = 'http://bitacorasfc.pe/produccionFC/view/dashboard.php';

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('produccionFC');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>