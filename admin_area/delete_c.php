 <?php include("includes/db.php"); ?>
 
 <?php 
    if (isset($_GET['delete_c'])) {
		
	$delete_id = $_GET['delete_c'];         //now les get hold of that invisible $pro_id as $delete_id from $_GET['delete_pro']

$delete_c = "delete from customer where customer_id ='$delete_id'";

$run_delete = mysqli_query($con, $delete_c);

if($run_delete){
	
	echo"<script>alert('A customer has been delete!')</script>";
		echo "<script>window.open('index.php?view_customers','_self')</script>";
		
	
	
}	
		
		
	}
 
 
 
 
 
 ?>