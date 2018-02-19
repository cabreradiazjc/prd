<?php 
  if ($gClient->getAccessToken()) {
      //Get user profile data from google
      $gpUserProfile = $google_oauthV2->userinfo->get();
      //Initialize User class
      $user = new User();
      //Insert or update user data to the database
      $gpUserData = array(
      'oauth_provider'=> 'google',
      'oauth_uid'     => $gpUserProfile['id'],
      'first_name'    => $gpUserProfile['given_name'],
      'last_name'     => $gpUserProfile['family_name'],
      'email'         => $gpUserProfile['email'],
      //'gender'        => $gpUserProfile['gender'],
      'locale'        => $gpUserProfile['locale'],
      'picture'       => $gpUserProfile['picture']
      //'link'          => $gpUserProfile['link']
      );
      $userData = $user->checkUser($gpUserData);
      //Storing user data into session
      $_SESSION['userData'] = $userData;
      //Render facebook profile data
      if(!empty($userData)){
        $index  = '../../index.php';
        $logout = '../../logout.php';
        $information = '../../view/labels/information.php';
        }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
        }
    }
?>