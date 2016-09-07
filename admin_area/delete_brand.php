<?php include("includes/db.php"); ?>
 
 <?php 
    if (isset($_GET['delete_brand'])) {
		
	$delete_id = $_GET['delete_brand'];         //now les get hold of that invisible $pro_id as $delete_id from $_GET['delete_pro']

$delete_brand = "delete from brands where brand_id ='$delete_id'";

$run_delete = mysqli_query($con, $delete_brand);

if($run_delete){
	
	echo"<script>alert('A brand has been delete!')</script>";
		echo "<script>window.open('index.php?view_brands','_self')</script>";
		
	
	
}	
		
		
	}
 
 
 
 
 
 ?> 