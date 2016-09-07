<!DOCTYPE HTML>
<?php

session_start();
include("functions/functions.php");
include("includes/db.php");

 ?>
<html>
<head>
<title>Shop on line</title>

<link rel="stylesheet" type="text/css" href="styles/style.css" media="all"/>

</head>

<body>
<!-- -- -- -- ---main container start here- - -- --------------------------------- -->

<div class="main_wrapper">


<!-- -- -- -- ---header start here- - -- --------------------------------- -->
<div class="header_wrapper">  


    <div id="logo">
	<a href="index.php"/> <img  src="images/logo.jpg"/> 
			   <img  src="images/pic1.jpg"/>
			   <img  src="images/pic2.jpg"/>
			   <img  src="images/apple-logo.png"/>
			   <img  src="images/pic3.jpg"/>
			   <img  src="images/pic4.jpg"/>
			   <img src="images/pic5.jpg"/>
			  <img src="images/pic6.jpg"/>   </a>

		</div> 	 													   
</div>
<!-- -- -- -- ---header ends here- - -- --------------------------------- -->
  

<!-- -- -- -- ---navigation menu  start here- - -- --------------------------------- -->
  
  
<div class="menubar">
  <ul id="menu">
     <li> <a href="index.php">Home </a> </li>
	 <li> <a href="all_products.php">all products </a> </li>
	 <li> <a href="customer/my_account.php">my account </a> </li>
	 <li> <a href="#">sign up </a> </li>
	 <li> <a href="cart.php">shopping cart</a> </li>
	 <li> <a href="#">contact us</a> </li>
  </ul>
<div id="form">
              <form action="results.php" method="get" enctype="multipart/form-data">
                 <input type="text" name="user_query" placeholder="search a product" />
                 <input type="submit" name="search" value="search" />
              </form>
</div>

</div>

<div class="content_wrapper">

   <div id="sidebar">
   
    <div id="sidebar_title">
	Categories</div>
	
 <ul id="cats">
 
	<?php getCats() ;?>
	
 </ul>
	
   <div id="sidebar_title">
	Brands</div>
	
 <ul id="cats">
 <?php getbrands() ;?>
	
 </ul>
   
   
   </div>

   <div id="content_area">
   
   <?php cart(); ?>
   <div id="shopping_cart">
   
        <span style="float:right; font-size:16px; padding:5px;line-height:40px;">
		 
		 <?php
		 //display customer email if logged in else display we 'come guest
		 if(isset($_SESSION['customer_email']))
			 
		 
		 {echo "<b> Welcome:</b>" .$_SESSION['customer_email'] . "<b style='color:yellow;'> Your</b>" ; }
		 
		 else{echo "<b> Welcome Guest!</b>";}                                    ?> <b style="color:yellow">Shopping Cart -</b>Total Items:<?php total_item();?>  Total Price:<?php total_price();?> <a href="cart.php"
		style="color:yellow">Go to Cart </a>
		
		
		</span>
		</div>
   
   
   <form action="" method="post" enctype="multipart/form-data">
   
   <table align="center" width="750" height="500">
      
	  <tr align="center">
	      <td colspan="6"><h2>Create an Account</h2></td>
	  
	  </tr> <br/> 
	  
	  <tr>
	      <td align="right">Customer Name: </td>
		  
		  <td><input type="text" name="c_name" required/></td>
	  </tr> <br/> 
	  
	    <tr>
	      <td align="right">customer Email: </td>
		  
		  <td><input type="text" name="c_email" required/></td>
	  </tr><br/> 
	  
	  <tr>
	      <td align="right">customer image: </td>
		  
		  <td><input type="file" name="c_image" required/></td>
	  </tr><br/> 
	  
	    <tr>
	      <td align="right">customer password: </td>
		  
		  <td><input type="password" name="c_pass" required/></td>
	  </tr><br/> 
	  
	    <tr>
	      <td align="right">customer Country </td>
		  
		  <td> 
		  <select name="c_country">
		  
		      <option>Select a country</option>
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
		  
		  <td><input type="text" name="c_city" required/></td>
	  </tr><br/> 
	  
	  <tr>
	      <td align="right">Customer contact </td>
		  
		  <td><input type="text" name="c_contact" required/></td>
	  </tr><br/> 
	  
	  <tr>
	      <td align="right">customer address </td>
		  
		  <td><input type="text" name="c_address" required ></td>
	  </tr><br/> 
	  
	  <tr align="center">
	      
		  
		  <td colspan="6"><input type="submit" name="register" value="Create Account"/></td>
	  </tr>
	  
	 
	   
   
   
   </table>
   
   
   </form>
  
   
   
 
  
   
   </div>

</div>
<!-- -- -- -- ---navigation menu  ends here- - -- --------------------------------- -->


<div id="footer">
  <h4 style="text-align:center; padding-top:30px;">&copy;2016 by www.davidecheta599.net16.net<br />
              <img style="height:30px;" src="images/social-icons.png"/>                                               </h4>

</div>


</div>
<!-- -- -- -- ---main container ends here- - -- --------------------------------- -->
</body>
</html>

<?php 

        if(isset($_POST['register'])){
		
         $ip =getIp();
		 
		 $c_name = $_POST['c_name'];
		  $c_email= $_POST['c_email'];
		   $c_pass = $_POST['c_pass'];
		    $c_image = $_FILES['c_image'] ['name'];
		    $c_image_tmp = $_FILES['c_image']['tmp_name'];
			 $c_country = $_POST['c_country'];
			  $c_city = $_POST['c_city'];
			   $c_contact = $_POST['c_contact'];
			    $c_address = $_POST['c_address'];
				
				
		move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");	

          $insert_c = "insert into customer(customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image) values 
		  ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";		
		  
		 $run_c = mysqli_query($con, $insert_c);
		 
		 $sel_cart = "select * from cart where ip_add='$ip'";
		 
		 $run_cart = mysqli_query($con,$sel_cart);
		 
		 $check_cart = mysqli_num_rows($run_cart);
		 
//if his cart row has no add_cart in the database take him to customer/my_account.php     else
		 if($check_cart==0){
			 
			  $_SESSION['customer_email'] = $c_email;
			  
			 echo "<script>alert('Account has been created successfully, Thank!')</script>";
			 echo"<script>window.open('customer/my_account.php','_self')</script>";
			 
		 }
		// else take him to payment.php from checkout.php
		 else{
			 
			 $_SESSION['customer_email'] =$c_email;
			 
			  
			 echo "<script>alert('Account has been created successfully, Thank!')</script>";
			 echo"<script>window.open('checkout.php','_self')</script>";
			 
		 }
		 
		
      
}	


	 
//echo "<meta http-equiv=\"refresh\" content=\"0; url=http://localhost/ecommerce/index.php\">";//	this wil redirect u to index.php if username not registered
//	exit();
				
				
?>


