<?php
  
  require_once 'config.php';
  require_once 'header.php';
  
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UP Open University</title> 
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/UPOU/admin/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">  
  <link rel="stylesheet" href="/UPOU/admin/dist/css/AdminLTE.min.css"> 
  <link rel="stylesheet" href="/UPOU/admin/dist/css/skins/_all-skins.min.css">  
  <link rel="stylesheet" href="/UPOU/admin/css/style1.css">  

<style>

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 18px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 0px solid #ddd;
}

.skin-blue .sidebar-form input[type="text"], .skin-blue .sidebar-form .btn {
    box-shadow: none;
    background-color: #FFFFFF;
    border: 1px solid transparent;
    height: 35px;
}

.skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {
    background-color: #335628;
}

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
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->

      <!-- search form -->
      <br>

<br>
     <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
    
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
   
    </section>

    <!-- Main content -->
    <section class="content">



<div class="box">
            <div class="box-header">

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
</div><!-- /.row --><br>


            </div>
            <!-- /.box-header -->
            <div class="box-body">

  <table class="table table-hover" id="myTable">
 <tr style="background-color:#7b1113;color:#F0FFFF;">    
    <td><b>Category</b>&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-resize-vertical" onclick="sortTable(0)"> </span></td>
    <td><b>File Name</b>&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-resize-vertical" onclick="sortTable(0)"> </span></td>
    <td><b>Details</b>&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-resize-vertical" onclick="sortTable(0)"> </span></td>  
    <td><center><b>Link</b>&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-resize-vertical" onclick="sortTable(0)"> </span></center></td>
    <td><b>Published on</b>&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-resize-vertical" onclick="sortTable(0)"> </span></td>

 </tr> 

       <?php 
         $query = "SELECT *, tbl_category.category_id, tbl_category.name FROM tbl_uploads INNER JOIN tbl_category ON tbl_uploads.category_id=tbl_category.category_id ORDER BY id DESC";        
        $records_per_page=5;
        $newquery = $paginate->paging($query,$records_per_page);
        $paginate->dataview($newquery);
        $paginate->paginglink($query,$records_per_page);    
        ?>

  </table>


 </div>
            <!-- /.box-body -->
          </div>

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
