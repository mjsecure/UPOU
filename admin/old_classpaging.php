<?php


class paginate
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
	
	public function dataview($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>

                <tr>  
                <td> <?php echo $row['title']; ?> </td>
                <td> <?php echo $row['file']; ?> <td>     
                
<div class="row">
        <div class="col-xs-15 col-md-15">
          <div class="box collapsed-box">
            <div class="box-header">
              <h3 class="box-title"><b>View Information</b></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
   <label>Type:&nbsp;</label> <?php echo $row['type']; ?>  <br>
   <label>Size:&nbsp;</label> <?php echo $row['size']; ?>  <br>
   <label>Title:&nbsp;</label> <?php echo $row['title']; ?> <br>
   <label>Description:&nbsp;</label> <?php echo $row['description']; ?> <br>
   <label>Location:&nbsp;</label> <?php echo $row['location']; ?> <br>
   <label>Url:&nbsp;</label> <a href="<?php echo $row['url'] ?>" target="_blank"><?php echo $row['url'] ?></a> </li><br>
   <label>Uploaded By:&nbsp;</label> <?php echo $row['uploaded_by']; ?> <br>
   <label>Date Created:&nbsp;</label>  <?php echo $row['date_created']; ?> <br>
   <label>Date Updated:&nbsp;</label> <?php echo $row['date_updated']; ?> <br>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

          </td>
        <td>                	
 	<center>
       <b> <a href="uploads/<?php echo $row['file'] ?>" target="_blank" title="View"><span class="glyphicon glyphicon-eye-open"></span><span class="primary"> </a> <br> 

       <a href="edit.php?edit_id=<?php echo $row['id']; ?>" title="Edit" onclick="return confirm('sure to edit ?')"> <span class="glyphicon glyphicon-edit"></span><span class="primary"> </a> <br> 

       <a href="?delete_id=<?php echo $row['id']; ?>" title="Delete" onclick="return confirm('sure to delete ?')"><span class="glyphicon glyphicon-trash"></span><span class="primary"> </a> 
<br><br><br>
    </center>
                </td>
                </tr>

                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
		}
		
	}
	
	public function paging($query,$records_per_page)
	{
		$starting_position=0;
		if(isset($_GET["page_no"]))
		{
			$starting_position=($_GET["page_no"]-1)*$records_per_page;
		}
		$query2=$query." limit $starting_position,$records_per_page";
		return $query2;
	}
	
	public function paginglink($query,$records_per_page)
	{
		
		$self = $_SERVER['PHP_SELF'];
		
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		$total_no_of_records = $stmt->rowCount();
		
		if($total_no_of_records > 0)
		{
			?>
			<tr><td colspan="9"> <ul class="pager navbar-left">
    					
			<?php
			$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
			$current_page=1;
			if(isset($_GET["page_no"]))
			{
				$current_page=$_GET["page_no"];
			}
			if($current_page!=1)
			{				    					
				$previous =$current_page-1;
				echo "<li><a href='".$self."?page_no=1'>First</a><li>&nbsp;&nbsp;";
				echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>&nbsp;&nbsp;";
			}
			for($i=1;$i<=$total_no_of_pages;$i++)
			{
				if($i==$current_page)
				{
					echo "<li><strong><a href='".$self."?page_no=".$i."' style='color:red;text-decoration:none'>".$i."</a></strong></li>&nbsp;&nbsp;";
				}
				else
				{
					echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>&nbsp;&nbsp;";
				}
			}
			if($current_page!=$total_no_of_pages)
			{
				$next=$current_page+1;
				echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>&nbsp;&nbsp;";
				echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>&nbsp;&nbsp;";
			}
			?> </ul> </td> </tr>
<?php
 				

		}
	}
}