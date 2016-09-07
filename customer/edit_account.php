<?php

include("includes/db.php");
       $user = $_SESSION['customer_email'];
		
		$get_customer = "select * from customer where customer_email='$user'";
		
		$run_customer = mysqli_query($con, $get_customer);
		
		$row_customer= mysqli_fetch_array($run_customer);
		
		$c_id = $row_customer['customer_id'];
		$name = $row_customer['customer_name'];
		$email = $row_customer['customer_email'];
		$pass = $row_customer['customer_pass'];
		$country = $row_customer['customer_country'];
		$city = $row_customer['customer_city'];
		$contact = $row_customer['customer_contact'];
		$address= $row_customer['customer_address'];
		$image= $row_customer['customer_image'];
		
		
		
	 	
		?>
   
   <form action="" method="post" enctype="multipart/form-data">
   
   <table align="center" width="750" height="500">
      
	  <tr align="center">
	      <td colspan="6"><h2>Update Your Account</h2></td>
	  
	  </tr> <br/> 
	  
	  <tr>
	      <td align="right">Customer Name: </td>
		  
		  <td><input type="text" name="c_name" value="<?php echo $name;?>"required/></td>
	  </tr> <br/> 
	  
	    <tr>
	      <td align="right">customer Email: </td>
		  
		  <td><input type="text" name="c_email" value="<?php echo $email;?>" required/></td>
	  </tr><br/> 
	  
	  <tr>
	      <td align="right">customer image: </td>
		  <!-- -- -- -- --to display an image by the <td> form side- - -- --------------------------------- -->
		  <td><input type="file" name="c_image" /> <img src="customer_images/<?php echo $image;?>" width="70" height="70"/> </td>
	  </tr>
	  
	    <tr>
	      <td align="right">customer password: </td>
		  
		  <td><input type="password" name="c_pass" value="<?php echo $pass;?>" required/></td>
	  </tr><br/> 
	  
	    <tr>
	      <td align="right">customer Country </td>
		  
		  <td> 
		  
<!-- -- -- -- ---this html function DISABLED   stop any changes to take place in that particuer post- - -- --------------------------------- -->

		  <select name="c_country" disabled>
		  
		      <option> <?php echo $country;?> </option>
			   <option>Afghanistan</option>
			    <option>india</option>
				 <option>japan</option>
				  <option>pakistan</option>
				   <option>israel</option>
				    <option>Nigeria</option>
					 <option>Ghana</option>
					  <option>united states</option>
					   <option>united Kingdom</option>
		  
		  </select>
		  </td>
	  </tr><br/> 
	  
	  <tr>
	      <td align="right">Customer city</td>
		  
		  <td><input type="text" name="c_city" value="<?php echo $city;?>"required/></td>
	  </tr><br/> 
	  
	  <tr>
	      <td align="right">Customer contact </td>
		  
		  <td><input type="text" name="c_contact" value="<?php echo $contact;?>"required/></td>
	  </tr><br/> 
	  
	  <tr>
	      <td align="right">customer address </td>
		  
		  <td><input type="text" name="c_address" value="<?php echo $address;?>"required ></td>
	  </tr><br/> 
	  
	  <tr align="center">
	      
		  
		  <td colspan="6"><input type="submit" name="update" value="update Account"/></td>
	  </tr>
	  
	 
	   
   
   
   </table>
   
   
   </form>
  
   
   
 
  
   




<?php 

        if(isset($_POST['update'])){
		
       
		 
		 $customer_id = $c_id;                  // $c_id = $row_customer['customer_id']; this the previews id it been carrying
		 $c_name = $_POST['c_name'];
		  $c_email= $_POST['c_email'];
		   $c_pass = $_POST['c_pass'];
		    $c_image = $_FILES['c_image'] ['name'];
		    $c_image_tmp = $_FILES['c_image']['tmp_name'];
			 //$c_country = $_POST['c_country']; we dont need it since its disabled
			  $c_city = $_POST['c_city'];
			   $c_contact = $_POST['c_contact'];
			    $c_address = $_POST['c_address'];
				  $ip =getIp();
				
		move_uploaded_file($c_image_tmp,"customer_images/$c_image");	

        
		 $update_c = "update customer set customer_name='$c_name',customer_email='$c_email',customer_pass='$c_pass',
 customer_city='$c_city',customer_contact= '$c_contact', customer_address='$c_address',customer_image='$c_image' where customer_id='$customer_id'";
		  
		 $run_update = mysqli_query($con, $update_c);
		 
		 if( $run_update){
		 
		  echo "<script>alert('Your Account has been updated successfully, Thank!')</script>";
			 echo"<script>window.open('my_account.php','_self')</script>";
		 
		 }
		
      
}	


	 
//echo "<meta http-equiv=\"refresh\" content=\"0; url=http://localhost/ecommerce/index.php\">";//	this wil redirect u to index.php if username not registered
//	exit();
				
				
?>


