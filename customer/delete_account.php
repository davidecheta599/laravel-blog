
<br>
<h2 style="text-align:center;color:black;">Do you really want to Delete your account?<h2>



<form action="" method="post">

<br>
<input type="submit" name="yes" value="YEs i want"/>
<input type="submit" name="no" value="No i was Joking"/>

</form>

<?php 

$user = $_SESSION['customer_email'];

if(isset($_POST['yes'])){
	
	$delete_customer = "delete from customer where customer_email='$user'";
	
	$run_customer = mysqli_query($con,$delete_customer );
	
	
				  
				  echo "<script>alert('Your Account has been deleted!')</script>";
				   echo"<script>window.open('../index.php','_self')</script>";
}
        if(isset($_POST['no'])){
			
			  echo "<script>alert('oh! do not joke again!')</script>";
				   echo"<script>window.open('my_account.php','_self')</script>";
			
		}


?>