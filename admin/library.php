<?php
  
  require_once 'config.php';
 
  require_once("session.php");
  
  require_once("class.user.php");

  $auth_user = new USER();
  
  
  $user_id = $_SESSION['user_session'];
  
  $stmt = $auth_user->runQuery("SELECT * FROM tbl_access WHERE user_id=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);


  if(isset($_GET['delete_id']))
  {
    // select image from db to delete
    $stmt_select = $DB_con->prepare('SELECT file FROM tbl_uploads WHERE id =:uid');
    $stmt_select->execute(array(':uid'=>$_GET['delete_id']));
    $imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
    unlink("uploads/".$imgRow['file']);
    
    // it will delete an actual record from db
    $stmt_delete = $DB_con->prepare('DELETE FROM tbl_uploads WHERE id =:uid');
    $stmt_delete->bindParam(':uid',$_GET['delete_id']);
    $stmt_delete->execute();
    
    header("Location: library.php");
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

  <link rel="stylesheet" href="/UPOU/admin/css/style1.css">  
  
<style type="text/css">
  .pager li>a, .pager li>span {
    display: inline-block;
    padding: 5px 14px;
    background-color: #F7F5F3;
    border: 1px solid #C0C0C0;
    border-radius: 9px;
}

.skin-blue .sidebar-form input[type="text"], .skin-blue .sidebar-form .btn {
    box-shadow: none;
    background-color: #FFFFFF;
    border: 1px solid transparent;
    height: 35px;
    width: 1000px;
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

  <div class="box-header">
<div>
           <form class="sidebar-form">
        <div class="input-group">
       <font color="#FFFFFF">  <input type="text" class="form-control" id="search_field" placeholder="Search for terms.." style="width: 50 height: 50">
            </font>

</div>
</form>

<div class="box-body">

 <!-- UPLOAD -->

<button type="button" class="btn btn-default" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-upload"></i> <span> &nbsp;&nbsp; UPLOAD </button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="#exampleModal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#7b1113; padding:10px 15px;">
        <button type="button" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></button>
       <h4 class="modal-title h2" id="myModalLabel" style="color: #fff; text-shadow:2px 2px 2px #02062E;">UPLOAD</h4>
      </div>
     <div class="modal-body">      

<form action="upload.php" method="post" enctype="multipart/form-data">
                

<?php
           // php select option value from database
           $hostname = "localhost";
           $username = "root";
           $password = "";
           $databaseName = "our_upou";

           // connect to mysql database
           $connect = mysqli_connect($hostname, $username, $password, $databaseName);

           // mysql select query
           $query = "SELECT * FROM `tbl_category`";

           // for method 1
           $result1 = mysqli_query($connect, $query);

           // for method 2
           $result2 = mysqli_query($connect, $query);

           $options = "";

           while($row2 = mysqli_fetch_array($result2))
                 {
                     $options = $options."<option>$row2[1]</option>";
                 }
       ?>


<div class="col-xs-12 col-md-3" style="margin-top:30px;"><span class="mf" style="float:left; margin-right:10px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>Category:</b></span></div>

<div class="col-xs-12 col-md-9" style="margin-top:10px;"> 
  <br> 

<script src="/UPOU/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>

  <select name="category_id" class="form-control" id="name" style="display: inline-block; position: relative;"> 
         <?php
           if(isset($_POST['add_new_cat']) )
             {
                 $name = $_POST['name'];

                 $stmt = $DB_con->prepare('INSERT INTO tbl_category(name) VALUES (:name)');
                 $stmt->bindParam(':name',$name);

                 if($stmt->execute())
                     {
                       header("refresh:3;library.php"); // redirects image view page after 5 seconds.
                     }
                 else
                     {
                       $errMSG = "error while inserting....";
                     }
             }
       ?>  
           <?php while($row1 = mysqli_fetch_array($result1)):;?>
           <option value="<?php echo $row1[0];?>"><?php echo $row1[1];?></option>
           <?php endwhile;?>

        <option value="new">Add New Category</option>
        </select> 
           <br><br>
<div class="form-group row" id="newCat" style="display: none;" >
<label class="col-sm-2 col-form-label" for="specify" ></label>
<div class="col-sm-10">
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Specify:</b> &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="form-control-file" id="exampleInputFile" name="name" placeholder="Specify category"/>
   <button type="submit1" name="add_new_cat" class="btn btn-default">ADD NEW CATEGORY</button>  <br><br>
     <script type="text/javascript">
       $('#name').on('change',function(){
           if( $(this).val()==="new"){
             $("#newCat").show()
           }
           else{
             $("#newCat").hide()
           }
       });
     </script>
    </div> 
    </div>
    </div>

<div class="col-xs-15 col-md-14">
<div class="col-xs-12 col-md-3" style="margin-top:10px;"><span class="mf" style="float:left; margin-right:10px;"> &nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;<b>Title:</b></span></div>
<div class="col-xs-12 col-md-9" style="margin-top:10px;"><input type="text" maxlength="120"  class="form-control" style="width:100%; float:left;" id="title" name="title" placeholder="Title"></div>

<div class="col-xs-15 col-md-3" style="margin-top:10px;"><span class="mf" style="float:left; margin-right:10px;"> &nbsp; &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;<b>Description:</b> </span></div>
<div class="col-xs-12 col-md-9" style="margin-top:10px;"><input type="text" maxlength="120"  class="form-control" style="width:100%; float:left;" id="description" name="description" placeholder="Description"></div>

<textarea rows="2" cols="50" name="uploaded_by" readonly="" hidden=""><?php echo $userRow['user_email']; ?></textarea>
<textarea rows="2" cols="50" name="url" readonly="" hidden=""><?php echo $url; ?></textarea>
<textarea rows="2" cols="50" name="location" readonly="" hidden=""><?php echo $location; ?></textarea>
<br><br><br><br><br><br><br><br><br><br>

 &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; <button type="button" class="btn btn-default">
<input type="file" name="file"  />
</button>

<br><br>

 &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;<button type="submit" name="btnsave" class="btn btn-default">
        <i class="fa fa-upload"></i></span> UPLOAD
</button>

<br><br><br>
    </form>

</div>

</div>
<div class="modal-footer" style="margin-top:0px; background:#7b1113;">

</div>
    </div>
  </div>
</div>

<!-- UPLOAD -->

  <table class="table table-hover" id="myTable">
 <tr style="background-color:#7b1113;color:#F0FFFF;">    
    <td><b>Category </b>&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-resize-vertical" onclick="sortTable(0)"> </span></td>
    <td><b>File Name </b>&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-resize-vertical" onclick="sortTable(0)"> </span></td>
    <td><b>Details </b>&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-resize-vertical" onclick="sortTable(0)"> </span></td>   
    <td><b>Action</b> </td>

 </tr> 

       <?php 
         $query = "SELECT *, tbl_category.category_id, tbl_category.name FROM tbl_uploads INNER JOIN tbl_category ON tbl_uploads.category_id=tbl_category.category_id ORDER BY id DESC";         
        $records_per_page=5;
        $newquery = $paginate->paging($query,$records_per_page);
        $paginate->dataview($newquery);
        $paginate->paginglink($query,$records_per_page);    
        ?>

  </table>

  <script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}

</script>
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