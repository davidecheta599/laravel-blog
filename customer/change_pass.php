
<h2 style="text-align:center;">Change Your Password</h2>
<form action="" method="post">



  <table align="center" width="600">
  
                       <tr>
                   <td align="right"> <b>Enter Current Password</b></td>
                     <td><input type="password" name="current_pass"required></td>
		 </tr><br />
		  
		 <tr>
		           <td align="right"><b>Enter New Password</b></td>
		           <td><input type="password" name="new_pass"required></td>
		 </tr><br />
		   
		    <tr>
		          	<td align="right"><b>Enter  New Password Again</b></td>
			        <td> <input type="password" name="new_again"required></td>
			
			</tr><br />
			
              <tr>
			       <td align="center" colspan="2"> <input type="submit" name="change_pass" value="Change Password"></td>
			  </tr>
</table>
</form>

         <?php 
		 
		 
		  if(isset($_POST['change_pass'])){
			  
			  
			  $current_pass =$_POST['current_pass'];
			  $new_pass = $_POST['new_pass'];
			   $new_again = $_POST['new_again'];
			   
			  $sel_pass ="select * from customer where customer_pass='$current_pass' AND customer_email='$user'";
			  
			  $run_pass = mysqli_query($con, $sel_pass);
			  
			  $check_pass = mysqli_num_rows($run_pass);
			  
			  if($check_pass==0){
				  
				  echo "<script>alert('Your Current Password is wrong!')</script>";
			      exit();
			  }
			  
			  if($new_pass!=$new_again){
				echo "<script>alert('New password do not match!')</script>";  
				 exit(); 
			  }
			  
			  else{
				  
				  $update_pass = "update customer set customer_pass='$new_pass'where customer_email='$user'";
				  
				  $run_update =mysqli_query($con, $update_pass);
				  
				  echo "<script>alert('New password is Updated successfully!')</script>";  
				  echo"<script>window.open('my_account.php','_self')</script>";
				  
				  
			  }
			  
		  }
		 
		 
		 ?>