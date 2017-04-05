<?php  
  require_once 'config.php';     
  require_once("session.php");
    
  $auth_user = new USER();
  
 $user_id = $_SESSION['user_session'];
  
 $stmt = $auth_user->runQuery("SELECT * FROM tbl_access WHERE user_id=:user_id");
 $stmt->execute(array(":user_id"=>$user_id));
  
 $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

require_once('class.user.php');
$user = new USER();

if(isset($_POST['btn-signup']))
{
	$uname = strip_tags($_POST['txt_uname']);
	$umail = strip_tags($_POST['txt_umail']);
	$upass = strip_tags($_POST['txt_upass']);	
	
	if($uname=="")	{
		$error[] = "Provide username !";	
	}
	else if($umail=="")	{
		$error[] = "Provide email !";	
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{	
	    $error[] = 'Please enter a valid email address !';
	}
	else if($upass=="")	{
		$error[] = "Provide password !";
	}
	else if(strlen($upass) < 6){
		$error[] = "Password must be atleast 6 characters";	
	}
 

	else
	{
		try
		{
			$stmt = $user->runQuery("SELECT user_name, user_email FROM tbl_access WHERE user_name=:uname OR user_email=:umail");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
				
			if($row['user_name']==$uname) {
				$error[] = "Sorry username already taken !";
			}
			else if($row['user_email']==$umail) {
				$error[] = "Sorry email id already taken !";
			}
			else
			{
				if($user->register($uname,$umail,$upass)){	
					 if($stmt->execute())
   {
        $successMSG = "New record succesfully inserted ...";
                header("refresh:3;admin_users.php"); 
   }

				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
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
  <link rel="stylesheet" href="/UPOU/admin/bootstrap/css/bootstrap.min.css"> <!-- Font Awesome -->    
  <link rel="stylesheet" href="/UPOU/admin/dist/css/AdminLTE.min.css">  
  <link rel="stylesheet" href="/UPOU/admin/dist/css/skins/_all-skins.min.css"> 
  <link rel="stylesheet" href="/UPOU/admin/plugins/iCheck/flat/blue.css">   
  <link rel="stylesheet" href="/UPOU/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="/UPOU/admin/css/style1.css"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">   

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
      if(isset($error))
      {
        foreach($error as $error)
        {
           ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
        }
      }
      else if(isset($successMSG))
      {
         ?>
                 <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $successMSG; ?></strong>
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

<?php include 'admin_users.php';?>

<script type="text/javascript">
  
 $(window).load(function(){
                $('#onload').modal('show');
            });

</script>

</body>
</html>



