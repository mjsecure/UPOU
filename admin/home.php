<?php

  require_once("session.php");
  
  
  require_once("class.user.php");
  $auth_user = new USER();
  
  
  $user_id = $_SESSION['user_session'];
  
  $stmt = $auth_user->runQuery("SELECT * FROM tbl_access WHERE user_id=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UP Open University</title>
 
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
  
  <title>UP Open University</title>  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">  
  <link rel="stylesheet" href="/UPOU/admin/bootstrap/css/bootstrap.min.css"> <!-- Font Awesome -->
  <link rel="stylesheet" href="/UPOU/admin/dist/css/AdminLTE.min.css">  
  <link rel="stylesheet" href="/UPOU/admin/dist/css/skins/_all-skins.min.css"> 
  <link rel="stylesheet" href="/UPOU/admin/plugins/iCheck/flat/blue.css">   
  <link rel="stylesheet" href="/UPOU/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="/UPOU/admin/css/style1.css">    
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

<style type="text/css">
  .skin-blue .sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a {
    color: #fff;
    background: #335627;
    border-left-color: #b43c25;
}

.navbar-nav>.user-menu>.dropdown-menu>li.user-header {
    height: 52px;
    padding: 5px;
    text-align: center;
}
</style>

 </head>
 
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">    <!-- Logo -->
    <a href="#" class="logo">      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">UPOU</span>      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>UP </b>Open University</span> </a>    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">         
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">       
    <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">           
            <span class="glyphicon glyphicon-user"></span>            
              <span class="hidden-xs"><font size="3">&nbsp;Hello!&nbsp; <?php echo $userRow['user_email']; ?>&nbsp;</font></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
            <a href="logout.php?logout=true"><button class="btn btn-danger"><span class="glyphicon glyphicon-log-out"> Sign-Out</span></button></a> 
              </li>
             
            
            </ul>
          </li>
</ul>
      </div>
    </nav>
  </header>

<!--********************************************************************************************** -->

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     <br>
      <ul class="sidebar-menu">

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php include 'date_time.php';?>
<br><br>


         <li class="active treeview">
          <a href="home.php">
           <i class="glyphicon glyphicon-home"></i> <span>HOME</span>
          </a>
        </li>
        
        <li class="treeview">
          <a href="library.php">
            <i class="glyphicon glyphicon-file"></i>
            <span>FILED</span>
            <span class="pull-right-container">            
            </span>
          </a>         
        </li>     

     <li class="treeview">
          <a href="admin_users.php">
            <i class="glyphicon glyphicon-user"></i>
            <span>USERS</span>
            <span class="pull-right-container">            
            </span>
          </a>         
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   
 <section class="content">
 <br><br><br><br><br><br><br><br><br><center>
<div class="container">
  <div class="jumbotron">
    <h1>UP Open University</h1>      
    <p>University in Los Baños, Philippines</p>
  </div>
</div>
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

<script src="/UPOU/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="/UPOU/admin/bootstrap/js/bootstrap.min.js"></script>
<script src="/UPOU/admin/dist/js/app.min.js"></script>


</body>
</html>
