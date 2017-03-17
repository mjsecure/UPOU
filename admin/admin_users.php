<?php
  
  require_once 'config.php'; 
  require_once 'dbconfig.php';   
  require_once("session.php");
  
  require_once("class.user.php");
  
  $auth_user = new USER();
  
  
  $user_id = $_SESSION['user_session'];
  
  $stmt = $auth_user->runQuery("SELECT * FROM tbl_access WHERE user_id=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_GET['delete_user_id']))
  {    
        // it will delete an actual record from db
    $stmt_delete = $DB_con->prepare('DELETE FROM tbl_access WHERE user_id =:user_id');
    $stmt_delete->bindParam(':user_id',$_GET['delete_user_id']);
    $stmt_delete->execute();
    
    header("Location: admin_users.php");
  }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UP Open University</title>  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/UPOU/admin/bootstrap/css/bootstrap.min.css">  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">  <!-- Theme style -->
  <link rel="stylesheet" href="/UPOU/admin/dist/css/AdminLTE.min.css">  
  <link rel="stylesheet" href="/UPOU/admin/dist/css/skins/_all-skins.min.css"> 
  <link rel="stylesheet" href="/UPOU/admin/plugins/iCheck/flat/blue.css">   
  <link rel="stylesheet" href="/UPOU/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="/UPOU/admin/css/style1.css">  

<style type="text/css">
  .pager li>a, .pager li>span {
    display: inline-block;
    padding: 5px 14px;
    background-color: #F7F5F3;
    border: 1px solid #C0C0C0;
    border-radius: 9px;
}
</style>

 </head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">    <!-- Logo -->
    <a href="home.php" class="logo">      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">UPOU</span>      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>UP </b>Open University</span> </a>    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">       
    <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">           
            <span class="glyphicon glyphicon-user"></span>            
              <span class="hidden-xs"><font size="3">&nbsp;Hi' <?php echo $userRow['user_email']; ?>&nbsp;</font></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
              <br>
                <h3><font color="#eee">UP Open University</font></h3>                
                <p>
                UPOU@gmail.com
                </p>
              </li>
             
              <!-- Menu Footer-->
              <li class="user-footer">                
                <div class="pull-right">

                <a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a>
                </div>
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

         <li class="active treeview">
          <a href="#">
           <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="treeview">
          <a href="library.php">
            <i class="fa fa-files-o"></i>
            <span>FILED</span>
            <span class="pull-right-container">            
            </span>
          </a>         
        </li>     

     <li class="treeview">
          <a href="admin_users.php">
            <i class="fa fa-users"></i>
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

<div class="box">
<div class="box-body">
<br>

<!-- Add New -->
<center><button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp; ADD NEW </button></center>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="#exampleModal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#7b1113; padding:10px 15px;">
        <button type="button" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button>
       <h4 class="modal-title h2" id="myModalLabel" style="color: #fff; text-shadow:2px 2px 2px #02062E;">ADD NEW USER</h4>
      </div>
     <div class="modal-body">      
<form  action="addnew_user.php" method="post" class="form-signin" id="exampleModal">
                       
            <label>UserName</label>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_uname" placeholder="Enter Username" value="<?php if(isset($error)){echo $uname;}?>" />
            </div>

            <label>E-Mail</label>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_umail" placeholder="Enter E-Mail" value="<?php if(isset($error)){echo $umail;}?>" />
            </div>

            <label>Password</label>
            <div class="form-group">
              <input type="password" class="form-control" name="txt_upass" placeholder="Enter Password" />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
              <center><button type="submit" class="btn btn-default" name="btn-signup">
                  <i class="glyphicon glyphicon-plus"></i>&nbsp;REGISTER</center>
                </button>
           </div>            
        </form>
</div>
<div class="modal-footer" style="margin-top:0px; background:#7b1113;">

</div>
    </div>
  </div>
</div>

<!-- /End -->


<form method="post" enctype="multipart/form-data" class="form-horizontal">

<table class="table table-responsive table-hover" id="myTable">
    <tr style="background-color:#7b1113;color:#F0FFFF;">
    <td><b>User Name</b></td>
    <td><b>Email</b></td>
    <td><b>Registration Date</b></td>
    <td><b><center>Action</center></b></td>    
    </tr>

 <?php 
        $query = "SELECT * FROM tbl_access ORDER BY user_id DESC";     
        $records_per_page=5;
        $newquery = $paginate->paging($query,$records_per_page);
        $paginate1->dataview($newquery);
        $paginate1->paginglink($query,$records_per_page);    
        ?>

</table>
</form>
  <br> <br> <br>

 </div>
   <!-- /.box-body -->
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
