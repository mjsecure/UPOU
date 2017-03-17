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
    $output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="/UPOU/admin/images/logo.png" alt="Logo" style="width:550px;height:350px;"> <br>  <br>  <br> <button type="button" class="btn btn-primary btn-lg"><b>G+</b> Sign-in with Google</button></a>';
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

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UP Open University</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
   <link rel="stylesheet" href="/UPOU/admin/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/UPOU/admin/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/UPOU/admin/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/UPOU/admin/plugins/iCheck/flat/blue.css">  
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="/UPOU/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

<style>
  .btn-primary {
    background-color: #7b1113;
    border-color: #7b1113;
}


.skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {
    background-color: #335628;
}


.btn.focus, .btn:focus, .btn:hover {
    color: #fff;
    background-color: #7b1113;
    text-decoration: none;
}

 </style>


 </head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">UPOU</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>UP </b>Open University</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
       
        <ul class="dropdown-menu">
             
         <ul class="menu">
                                  
              </ul>
              </li>
              
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
                       
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <?php echo $library; ?>
            <ul class="dropdown-menu">
              
              <li>

              </li>
              <li class="footer">
                
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            
          <?php echo $hi; ?>
          
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
              <br>
                <?php echo $user; ?>                 
                <font color="#FFFFFF"><?php echo $user2; ?></font> 
              </li>
             
              <!-- Menu Footer-->
              <li class="user-footer">                
                <div class="pull-right">
                  <a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a>
                </div>
              </li>
            </ul>
          </li>
</ul>
      </div>
    </nav>
  </header>


<!--********************************************************************************************** -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
   
    </section>

    <!-- Main content -->
    <section class="content">    
    <br><br><br><br><br>
<center>
<font color="#00000" size="500"><b>Welcome to UPOU</b></font><br>
<?php echo $output; ?>
</center>
 <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
       

          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            
          </div>
       
        </section>      
      </div>
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
   
    <strong>© UP Open University 2017</strong> 
  </footer>

  <!-- Control Sidebar -->
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- jQuery 2.2.3 -->
<script src="/UPOU/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/UPOU/admin/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 3.3.6 -->
<script src="/UPOU/admin/bootstrap/js/bootstrap.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/UPOU/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/UPOU/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/UPOU/admin/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/UPOU/admin/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/UPOU/admin/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/UPOU/admin/dist/js/demo.js"></script>
</body>
</html>
