<?php include("includes/db.php"); ?>
 
 <?php 
    if (isset($_GET['delete_cat'])) {
		
	$delete_id = $_GET['delete_cat'];         //now les get hold of that invisible $pro_id as $delete_id from $_GET['delete_pro']

$delete_cat = "delete from categories where cat_id ='$delete_id'";

$run_delete = mysqli_query($con, $delete_cat);

if($run_delete){
	
	echo"<script>alert('A Categories has been delete!')</script>";
		echo "<script>window.open('index.php?view_cats','_self')</script>";
		
	
	
}	
		
		
	}
 
 
 
 
 
 ?>