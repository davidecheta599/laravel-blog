<?php



if(!isset($_SESSION['user_email']))  //'user_email' is from the database 


{
	
echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";	
	
}   else{



?><form action="" method="post" style="padding:40px;">
           
		   <b> Insert New Categories:<b>
		   <input type="text" name="new_cat"required/>
		   <input type="submit" name="add_cat" value="Add Category"/>

</form>
<?php 

include("includes/db.php");


if (isset($_POST['add_cat'])){
	
	$new_cat =$_POST['new_cat'];
	
	$insert_cat = "insert into categories (cat_title) values ('$new_cat')";
	
	$run_cat = mysqli_query($con, $insert_cat);
	
	if($run_cat){
		
		
		echo"<script>alert('New categories has been inserted!')</script>";
		echo "<script>window.open('index.php?view_products','_self')</script>";
		
	}
}



?><?php }?>