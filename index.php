<?php
	
	   //Include GP config file && User class
    date_default_timezone_set('America/Lima');
    include_once 'gpConfig.php';
    include_once 'User.php';

    if (isset($_GET['code'])) {
    $gClient->authenticate($_GET['code']);
    $_SESSION['token'] = $gClient->getAccessToken();
    header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
    }

    if (isset($_SESSION['token'])) {
    $gClient->setAccessToken($_SESSION['token']);
    }


    if (!isset($_SESSION['token'])) {
        header("Location:view/login/login.php");
    } else {

    if ($gClient->getAccessToken()) {
    	header("Location: view/dashboard/dashboard.php");
    }

}
?>