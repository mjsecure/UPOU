<?php

if ($mprc=='nwam1') {	
$T0 = mysqli_real_escape_string($con,$_POST['pcod']);
$T1 = mysqli_real_escape_string($con,$_POST['cat']);
$T2 = mysqli_real_escape_string($con,$_POST['pnme']);
$T3 = mysqli_real_escape_string($con,$_POST['pdsc']);
$T3a = mysqli_real_escape_string($con,$_POST['wtyp']);
$T4 = mysqli_real_escape_string($con,$_POST['pcol']);
$T5 = mysqli_real_escape_string($con,$_POST['pdms']);
$T6 = mysqli_real_escape_string($con,$_POST['psiz']);

$T7 = mysqli_real_escape_string($con,$_POST['qty']);
$T8 = mysqli_real_escape_string($con,$_POST['prz']);
$T9 = mysqli_real_escape_string($con,$_POST['mnq']);

$ploc=$_SESSION['ploc'];

$resu = mysqli_query($con,"SELECT * FROM tblinv_data WHERE pcod='$T0'");
$count=mysqli_num_rows($resu);
 if ($count>0)
  {
    $errmsg='Duplicate Product Code Found!!!<br>Cannot Continue Saving....';
    session_write_close();
	//echo $T1. ' ' .$T2. ' ' .$T3;
    header("location:{$pgn}?errmsg=$errmsg&prc=ir2");
    exit;
  }

$rexu = mysqli_query($con,"SELECT * FROM tblinv_data WHERE pnme='$T2'");
$xount=mysqli_num_rows($rexu);
 if ($xount>0)
  {
    $errmsg='Duplicate Product Name Found!!!<br>Cannot Continue Saving....';
    session_write_close();
	//echo $T1. ' ' .$T2. ' ' .$T3;
    header("location:{$pgn}?errmsg=$errmsg&prc=ir2");
    exit;
  }
  
$sql="INSERT INTO tblinv_data(pcod,pcid,pnme,pdsc,ploc,pcol,pdms,psiz,wtyp) VALUES('$T0','$T1','$T2','$T3','$ploc','$T4','$T5','$T6','$T3a')";  
 if (!mysqli_query($con,$sql))
  { $errmsg='Error Saving New Item Record!!!'; 
    session_write_close();
	echo $sql;
    header("location:{$pgn}?errmsg=$errmsg&prc=ir2");
    exit;
  }
 else  
   {  $pid=mysqli_insert_id($con);
   
      $asql=mysqli_query($con,"INSERT INTO tblprod_data(pid,qty,prz,mnq) VALUES('$pid','$T7','$T8','$T9')"); 
     
	 $errmsg='New Product Record Saved Successfuly!!!'; 
     session_write_close();
     header("location:{$pgn}?errmsg=$errmsg&prc=ir2");
     exit;
  }  
}

?>s