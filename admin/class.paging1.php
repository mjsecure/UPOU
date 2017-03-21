<?php

class paginate1
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
        <td><?php echo $row['user_name'] ?></td>
        <td><?php echo $row['user_email'] ?></td>        
        <td><?php echo $row['joining_date'] ?></td>  
        <td>
                <center>
<a href="?delete_user_id=<?php echo $row['user_id']; ?>" title="Delete"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-trash"> Delete</span></button></a>   </td>  
                </center>

                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td colspan="4"> <center><div class="alert alert-warning">
                <span class="glyphicon glyphicon-info-sign"></span> <strong>Nothing Here...</strong> 
            </div></center></td>
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

		<ul class="pager navbar-right ">
    					
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
			?> </ul>
<?php
 				
		}
	}
}