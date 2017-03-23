<?php

    error_reporting( ~E_NOTICE );
    
    require_once 'config.php';
    
    require_once("session.php");
    
    require_once("class.user.php");

  $auth_user = new USER();
  
  
  $user_id = $_SESSION['user_session'];
  
  $stmt = $auth_user->runQuery("SELECT * FROM tbl_access WHERE user_id=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
 
 if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
 {
        $id = $_GET['edit_id'];
        $stmt_edit = $DB_con->prepare('SELECT file, type, size, title, description, location, url, uploaded_by, category_id FROM tbl_uploads WHERE id =:uid');
        $stmt_edit->execute(array(':uid'=>$id));
        $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
        extract($edit_row);
 }
 else
 {
  header("Location: library.php");
 }
 
 if(isset($_POST['btn_save_updates']))
 {
   
        $file = $_FILES['file']['name'];
        $file_loc = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];

        $category_id = $_POST['category_id'];
        $url = $_POST['url'];
        $title = $_POST['title'];

        $description = $_POST['description'];
        $location = $_POST['location'];
        $uploaded_by = $_POST['uploaded_by'];
        $folder="uploads/";
    
        // new file size in KB
        $new_size = $file_size/1024;  
        // new file size in KB
    
        // make file name in lower case
        $new_file_name = strtolower($file);
        // make file name in lower case
        
        $final_file=str_replace(' ','-',$new_file_name);
     
  if($file)
  {
   $folder = 'uploads/'; // upload directory 
   $imgExt = strtolower(pathinfo($file,PATHINFO_EXTENSION)); // get image extension
  $valid_extensions = array('rar', 'zip', 'jpeg', 'jpg', 'png', 'gif', 'pdf', 'xlsx', 'docx', 'ppt'); // valid extensions

   
   if(in_array($imgExt, $valid_extensions))
   {   
    if($imgSize < 5000000)
    {
                 unlink($folder.$edit_row['file']);
                    $url = "http" . ($_SERVER['HTTPS'] ? 's' : '') . "://{$_SERVER['HTTP_HOST']}".dirname($_SERVER['PHP_SELF'])."/{$folder}{$final_file}";

                   $location = dirname($_SERVER['PHP_SELF'])."/{$folder}";
                  
                    move_uploaded_file($file_loc,$folder.$file);
    }
    else
    {
     $errMSG = "Sorry, your file is too large it should be less then 5MB";
    }
   }
   else
   {
    $errMSG = "Sorry, only RAR, ZIP, PDF, XLSX, DOCX, PPT, JPG, JPEG, PNG & GIF files are allowed.";  
   } 
  }
  else
  {
   // if no file selected the old image remain as it is.
           $final_file = $edit_row['file'];
            $file_type = $edit_row['type'];
            $file_size = $edit_row['size'];  // old file from database
  } 
      
  
  // if no error occured, continue ....
  if(!isset($errMSG))
  {
   $stmt = $DB_con->prepare('UPDATE tbl_uploads
                                         SET type=:ufile_type, 
                                             file=:ufinal_file,
                                             size=:ufile_size, 
                                             title=:utitle, 
                                             description=:udescription,  
                                             location=:ulocation,
                                             url=:uurl,
                                             uploaded_by=:uuploaded_by,
                                             category_id=:ucategory_id
                                       WHERE id=:uid');
            $stmt->bindParam(':ufile_type',$file_type);
            $stmt->bindParam(':ufinal_file',$final_file);
            $stmt->bindParam(':ufile_size',$file_size);
            $stmt->bindParam(':utitle',$title);
            $stmt->bindParam(':udescription',$description);
            $stmt->bindParam(':ulocation',$location);  
            $stmt->bindParam(':uurl',$url);            
            $stmt->bindParam(':uid',$id);
            $stmt->bindParam(':uuploaded_by',$uploaded_by);
            $stmt->bindParam(':ucategory_id',$category_id);
    
   if($stmt->execute()){
    ?>
    <script>
    alert('Successfully Updated ...');
    window.location.href='library.php';
    </script>
                <?php
   }
   else{
    $errMSG = "Sorry Data Could Not Updated !";
   }
  }    
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
  <link rel="stylesheet" href="/UPOU/admin/bootstrap/css/bootstrap.min.css">  <!-- Font Awesome -->    <!-- Theme style -->
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
             
              <!-- Menu Footer-->
            
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
            
<div class="box">
            <div class="box-header with-border">
              <div class="box-body">

<form method="post" enctype="multipart/form-data" class="form-horizontal">
    
    
    <?php
    if(isset($errMSG)){
        ?>
        <div class="alert alert-danger">
          <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
        </div>
        <?php
    }
    ?>
       
    <table class="table table-bordered table-responsive">
    
<tr>
 <td><label class="control-label">Category:</label></td>
 <td>
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
                       header("library.php"); // redirects image view page after 5 seconds.
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

 </td>

</tr>

    <tr>
        <td><label class="control-label">Title:</label></td>
        <td><input class="form-control" type="text" name="title" value="<?php echo $title; ?>" /></td>
    </tr>
    
    <tr>
        <td><label class="control-label">Description:</label></td>
        <td><input class="form-control" type="text" name="description" value="<?php echo $description; ?>" /></td>
    </tr>
    
    <tr>
        <td><label class="control-label">File:</label></td>
        <td>
            <input class="form-control" type="text" name="file" value="<?php echo $file; ?>" height="150" width="150" readonly /><br>

        <button type="button" class="btn btn-default">
            <input class="input-group" type="file" name="file" accept="file/*" />
            </button>
        </td>
    </tr>


    <textarea rows="2" cols="50" name="url" readonly="" hidden=""><?php echo $url; ?></textarea>
    <textarea rows="2" cols="50" name="location" readonly="" hidden=""><?php echo $location; ?></textarea>
    <textarea rows="2" cols="50" name="uploaded_by" readonly="" hidden=""><?php echo $userRow['user_email']; ?></textarea>
    
    <tr>
    <br>

        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> UPDATE
        </button>
        
        <a class="btn btn-default" href="library.php"> <span class="glyphicon glyphicon-backward"></span> CANCEL </a>
        
        </td>
    </tr>
    
    </table>
    
</form>

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

<div class="control-sidebar-bg"></div>
</div>

<script src="/UPOU/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="/UPOU/admin/bootstrap/js/bootstrap.min.js"></script>
<script src="/UPOU/admin/dist/js/app.min.js"></script>


</body>
</html>
