<?php
//Include GP config file && User class
include_once 'gpConfig.php';
include_once 'User.php';

if(isset($_GET['code'])){
    $gClient->authenticate($_GET['code']);
    $_SESSION['token'] = $gClient->getAccessToken();
    header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
    $gClient->setAccessToken($_SESSION['token']);
}

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
        'gender'        => $gpUserProfile['gender'],
        'locale'        => $gpUserProfile['locale'],
        'picture'       => $gpUserProfile['picture'],
        
    );
    $userData = $user->checkUser($gpUserData);
    
    //Storing user data into session
    $_SESSION['userData'] = $userData;
    
    //Render facebook profile data
    if(!empty($userData)){        
        $output  = '<img src="'.$userData['picture'].'" width="200" height="200" class="img-thumbnail"><br/>';
        $output .= '<br/>Google ID : ' . $userData['oauth_uid'];
        $output .= '<br/>Name : ' . $userData['first_name'].' '.$userData['last_name'];
        $output .= '<br/>Email : ' . $userData['email'];
        $upload = ' <a href="upload.php">
              <span class="glyphicon glyphicon-upload"></span>&nbsp;Upload&nbsp;<span class="primary"></span></a>';

        $hi = ' <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <span class="glyphicon glyphicon-user"></span>&nbsp;Hi! ' . $userData['first_name'].' ' . $userData['last_name'].'  <span class="caret"></span> </a>';
      
       $logout = '<a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a>';
       
       $library = ' <a href="library.php">
              <span class="fa fa-files-o"></span>&nbsp;Library&nbsp;<span class="primary"></span></a>';
       $uploader = ' ' . $userData['first_name'].' '.$userData['last_name'];
       $user  = '<img src="'.$userData['picture'].'" width="200" height="200" class="img-thumbnail"><br/>
              ';
       $user1 = '<br/>Name : ' . $userData['first_name'].' '.$userData['last_name'];
       $user2 = '<br/>Email : ' . $userData['email'];

        
   }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
} else {
    $authUrl = $gClient->createAuthUrl();
    $output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><button type="button" class="btn btn-primary btn-lg">Sign in with Google</button></a>';
    $input  = '<a href="#"></a>';
    $logout = '<a href="#"></a>';
    $upload = '<a href="#"></a>';
    $hi = '<a href="#"></a>';
    $logout= '<a href="#"></a>';
    $library = '<a href="#"></a>';
    $uploader = '<a href="#"></a>';
    $user = '<a href="#"></a>';
    $user1 = '<a href="#"></a>';
    $user2 = '<a href="#"></a>';
    


}
?>