<?php
  
  require_once 'config.php';
  require_once 'header.php';

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="cWROalNjNk4CDiolKi5bHCVdIh0KOWMPFi0HKANVAj41Uy8jIVtAPA==">
    <title>UP Open University</title>
    <link href="/UPOU/admin/assets/ff22c03b/css/bootstrap.css" rel="stylesheet">
<link href="/UPOU/admin/css/site.css" rel="stylesheet"></head>
<body>
<div class="wrap">
    <nav id="w0" class="navbar-inverse navbar-fixed-top navbar" role="navigation"><div class="container"><div class="navbar-header"><button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse">
<span class="icon-bar"></span></button><a class="navbar-brand" href="/UPOU/admin/index.php">UP Open University</a></div><div id="w0-collapse" class="collapse navbar-collapse"><ul id="w1" class="navbar-nav navbar-left nav"></ul> <ul class="nav navbar-nav navbar-right">
<li class="dropdown">
   <?php echo $hi; ?>
<ul class="dropdown-menu">
<li> <?php echo $logout; ?></li> </ul> </li> </ul>
<ul class="nav navbar-nav navbar-right">
<li> <?php echo $library; ?> </li> </ul>
</div><!--/.nav-collapse -->
</div>
</nav> 
 
<br><br>
<div><center>
  <table class="table table-hover">
 <tr style="background-color:#7b1113;color:#F0FFFF;">    
    <td>Category</td>
    <td>File Name</td>
    <td>Details</td>   
    <td>Action</td>

 </tr> 
       <?php 
        $query = "SELECT * FROM tbl_uploads ORDER BY id DESC";       
        $records_per_page=3;
        $newquery = $paginate->paging($query,$records_per_page);
        $paginate->dataview($newquery);
        $paginate->paginglink($query,$records_per_page);    
        ?>

  </table>
</center>
</div>
<div id="header">

</div>

<div class="body-content">
</div>
        </div>
    </div>
</div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left"> &copy; UP Open University 2017</p>


    </div>
</footer>
</script><script src="/UPOU/admin/assets/389beca6/jquery.js"></script>
<script src="/UPOU/admin/assets/bc9c340b/yii.js"></script>
<script src="/UPOU/admin/assets/ff22c03b/js/bootstrap.js"></script></body>
</html>