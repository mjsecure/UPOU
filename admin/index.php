<?php
session_start();
require_once("class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
  $login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
  $uname = strip_tags($_POST['txt_uname_email']);
  $umail = strip_tags($_POST['txt_uname_email']);
  $upass = strip_tags($_POST['txt_password']);
    
  if($login->doLogin($uname,$umail,$upass))
  {
    $login->redirect('home.php');
  }
  else
  {
    $error = "Wrong Details !";
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
  <link rel="stylesheet" href="/UPOU/admin/dist/css/AdminLTE.min.css">  
  <link rel="stylesheet" href="/UPOU/admin/dist/css/skins/_all-skins.min.css"> 
  <link rel="stylesheet" href="/UPOU/admin/plugins/iCheck/flat/blue.css">    
  <link rel="stylesheet" href="/UPOU/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<style>
  .btn-default {
    background-color: #7b1113;
    color: #fff;
    border-color: #7b1113;
}

.btn-default:hover, .btn-default:active, .btn-default.hover {
    background-color: #7b1113;
    
}

.btn.focus, .btn:focus, .btn:hover {
    color: #fff;
    text-decoration: none;
}

</style>

 </head>
<body class="hold-transition login-page">

      

<br><br>
<div class="login-box">

  <!-- /.login-logo -->
  <div class="login-box-body">

<center>
<img src="/UPOU/admin/images/logo.png" alt="Logo" style="width:313px;height:200px;">
</center>
    
<br><br>
    <form class="form-signin" method="post" id="login-form">

      <div id="error">
        <?php
      if(isset($error))
      {
        ?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
      }
    ?>

        <div class="form-group has-feedback">
        <input type="text" class="form-control" name="txt_uname_email" placeholder="Username" required />
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

     
        <div class="form-group has-feedback">
        <input input type="password" class="form-control" name="txt_password" placeholder="Password" />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-10">
          <div class="checkbox icheck">
            
          </div>
        </div>
<br>
<div class="form-group">
    <center>  <button type="submit" name="btn-login" class="btn btn-default">
                  <i class="glyphicon glyphicon-log-in"></i> &nbsp; SIGN IN
           </center> </button>
        </div>  
        <!-- /.col -->
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<script src="/UPOU/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="/UPOU/admin/bootstrap/js/bootstrap.min.js"></script>
<script src="/UPOU/admin/dist/js/app.min.js"></script>

</body>
</html>
