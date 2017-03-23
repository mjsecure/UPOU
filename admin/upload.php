<?php
    error_reporting( ~E_NOTICE ); // avoid notice
    
  require_once 'config.php';
     
  require_once("session.php");
    
  require_once("class.user.php");
  $auth_user = new USER();
  
  
  $user_id = $_SESSION['user_session'];
  
  $stmt = $auth_user->runQuery("SELECT * FROM tbl_access WHERE user_id=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

 if(isset($_POST['btnsave']))
 {
 
        $file = $_FILES['file']['name'];
        $file_loc = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];

        $category_id = $_POST['category_id'];

        $title = $_POST['title'];
        $url = $_POST['url'];
        $location = $_POST['location'];
        $description = $_POST['description'];       
        $uploaded_by = $_POST['uploaded_by'];
        $folder="uploads/";
    
         // new file size in KB
         $new_size = $file_size/1024;  
         // new file size in KB
         // make file name in lower case
         $new_file_name = strtolower($file);
         // make file name in lower case
    
         $final_file=str_replace(' ','-',$new_file_name);
  
  
  if(empty($title)){
   $errMSG = "Please Enter title.";
  }
  else if(empty($description)){
   $errMSG = "Please Enter description.";
  }
  else if(empty($file)){
   $errMSG = "Please Select File.";
  }
  else
  {

   $folder = 'uploads/'; // upload directory
 
   $imgExt = strtolower(pathinfo($file,PATHINFO_EXTENSION)); // get image extension
  
   // valid image extensions
   $valid_extensions = array('rar', 'zip', 'jpeg', 'jpg', 'png', 'gif', 'pdf', 'xlsx', 'docx', 'ppt'); // valid extensions
   
       // allow valid image file formats
   if(in_array($imgExt, $valid_extensions)){   
    // Check file size '5MB'
    if($imgSize < 5000000)    {

    $url = "http" . ($_SERVER['HTTPS'] ? 's' : '') . "://{$_SERVER['HTTP_HOST']}".dirname($_SERVER['PHP_SELF'])."/{$folder}{$final_file}";

                $location = dirname($_SERVER['PHP_SELF'])."/{$folder}";


     move_uploaded_file($file_loc,$folder.$final_file);

    }
    else{
     $errMSG = "Sorry, your file is too large.";
    }
   }
   else{
    $errMSG = "Sorry, only RAR, ZIP, PDF, XLSX, DOCX, PPT, JPG, JPEG, PNG & GIF files are allowed.";  
   }
  }
  
  
  // if no error occured, continue ....
  if(!isset($errMSG))
  {
      $stmt = $DB_con->prepare('INSERT INTO tbl_uploads(type,file,size,title,description,uploaded_by,url,location,category_id) VALUES(:ufile_type, :ufinal_file, :unew_size, :utitle, :udescription, :uuploaded_by, :uurl, :ulocation, :ucategory_id)');
          
            
            $stmt->bindParam(':ufile_type',$file_type);
            $stmt->bindParam(':ufinal_file',$final_file);
            $stmt->bindParam(':unew_size',$new_size);
            $stmt->bindParam(':utitle',$title);
            $stmt->bindParam(':udescription',$description);                        
            $stmt->bindParam(':uuploaded_by',$uploaded_by);   
            $stmt->bindParam(':uurl',$url);         
            $stmt->bindParam(':ulocation',$location);    
            $stmt->bindParam(':ucategory_id',$category_id);  
   
   if($stmt->execute())
   {
        $successMSG = "New Record Succesfully Inserted ...";
                header("refresh:3;library.php"); 
   }
   else
   {
    $errMSG = "Error while inserting....";
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
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
  <link rel="stylesheet" href="/UPOU/admin/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/UPOU/admin/font-awesome-4.7.0/css/font-awesome.min.css">   
  <link rel="stylesheet" href="/UPOU/admin/dist/css/AdminLTE.min.css"> 
  <link rel="stylesheet" href="/UPOU/admin/dist/css/skins/_all-skins.min.css">  
  <link rel="stylesheet" href="/UPOU/admin/css/style1.css">  
 </head>
<body>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"  id="onload">

    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">x</button>
         
        </div>
        <div class="modal-body">
      
   <?php
    if(isset($errMSG)){
            ?>
            <div class="alert alert-danger">
                <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
            </div>
            <?php
    }
    else if(isset($successMSG)){
        ?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
        </div>
        <?php
    }
    ?>

        </div>
        <div class="modal-footer">               
        </div>
      </div>

    </div>
</div>

<?php include 'library.php';?>


<script type="text/javascript">
  
 $(window).load(function(){
                $('#onload').modal('show');
            });

</script>

</body>
</html>


