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

.skin-blue .sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a {
    color: #fff;
    background: #335627;
    border-left-color: #b43c25;
}
</style>

 </head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">    <!-- Logo -->
    <a href="home.php" class="logo">      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">UPOU</span> <!-- logo for regular state and mobile devices -->
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


<div class="row">
  <div class="col-lg-6">
    <div class="input-group">
      <input type="text" class="form-control SearchBar" id="search_field" placeholder="Search for...">
      <span class="input-group-btn">
        <button class="btn btn-defaul SearchButton" type="button">
            <span class=" glyphicon glyphicon-search SearchIcon" > <b>Search</b> </span>
        </button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row --><br><br>
<!-- Add New -->
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp; ADD NEW </button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="#exampleModal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#7b1113; padding:10px 15px;">
        <button type="button" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button>
       <h4 class="modal-title h2" id="myModalLabel" style="color: #fff; text-shadow:2px 2px 2px #02062E;">ADD NEW</h4>
      </div>
     <div class="modal-body">      
     
<form  action="addnew_user.php" method="post" class="form-signin" id="exampleModal">
       
            <label>UserName</label>
            <div class="form-group has-feedback">
            <input type="text" class="form-control" name="txt_uname" placeholder="Enter Username" value="<?php if(isset($error)){echo $uname;}?>" /> <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <label>E-Mail</label>
            <div class="form-group has-feedback">
            <input type="text" class="form-control" name="txt_umail" placeholder="Enter E-Mail" value="<?php if(isset($error)){echo $umail;}?>" /> <b><span class="glyphicon glyphicon-briefcase form-control-feedback"></span></b>
            </div>

            <label>Password</label>
            <div class="form-group has-feedback">
              <input type="password" class="form-control" name="txt_upass" placeholder="Enter Password" />
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
              <button type="submit" class="btn btn-default" name="btn-signup">
                  <i class="glyphicon glyphicon-plus"></i>&nbsp;REGISTER
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
    <td><b>User Name</b>&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-resize-vertical" onclick="sortTable(0)"> </span></td>
    <td><b>Email</b>&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-resize-vertical" onclick="sortTable(0)"> </span></td>
    <td><b>Registration Date</b>&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-resize-vertical" onclick="sortTable(0)"> </span></td>
    <td><b><center>Action</center></b></td>    
    </tr>

 <?php 
        $query = "SELECT * FROM tbl_access ORDER BY user_id DESC";     
        $records_per_page=10;
        $newquery = $paginate->paging($query,$records_per_page);
        $paginate1->dataview($newquery);
        $paginate1->paginglink($query,$records_per_page);    
        ?>
</table>
<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true; 
  dir = "asc";  
  while (switching) {
    switching = false;
    rows = table.getElementsByTagName("TR");    
    for (i = 1; i < (rows.length - 1); i++) {      
      shouldSwitch = false;     
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
          if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {         
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {         
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
           rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;      
      switchcount ++;      
    } else {
          if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
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

<script>
$('#search_field').on('keyup', function() {
 var value = $(this).val();
 var patt = new RegExp(value, "i");

 $('#myTable').find('tr').each(function() {
   if (!($(this).find('td').text().search(patt) >= 0)) {
     $(this).not('.myHead').hide();
   }
   if (($(this).find('td').text().search(patt) >= 0)) {
     $(this).show();
   }

 });


});
</script>


</body>
</html>
