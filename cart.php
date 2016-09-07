<!DOCTYPE HTML>
<?php

//session_start();
SESSION_START();

include("functions/functions.php");
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
		 
		 else{echo "<b> Welcome Guest!</b>";}                                    ?> <b style="color:yellow">Shopping Cart -</b>Total Items:<?php total_item();?>  Total Price:<?php total_price();?> <a href="index.php"
		style="color:yellow">Back to Shop </a>
		
			
		<?php
		  if(!isset($_SESSION['customer_email'])){
			  
			echo " <a href='checkout.php' style='color:orange;'> Login</a>"  ;
			  
			  
		  }else{
			  
			  echo "<a href='logout.php' style='color:orange;'> Logout</a>";
		  }
		
		
		
		
		?>
		</span>
   
   
   
   
   </div>
   
  
   
   
     <div id="products_box">
	<form action="" method="post" entype="multipart/form-data">
	                       
						   <br />
	<table align="center" width="700" bgcolor="skyblue">
	
	<!--              <tr align="center">
	                   <td colspan="5"><h2>Update your cart or Checkout</h2></td>           -->
		
		
				
        <tr align="center"> 
		    <th> Remove</th>
			  <th>Product(s)</th>
			    <th>Quantity</th>
				  <th>Total price</th>				
		
		</tr>
	
	         <?php 
			 
			   $total = 0;//initial price by default to avoid error display when the total price is empty
		  
		  global $con;
		  
		  $ip = getIp(); 
		  
		  $sel_price = "select * from cart where ip_add ='$ip'";
		  
		  $run_price = mysqli_query($con, $sel_price);
		  
		  while($p_price=mysqli_fetch_array($run_price)){
			  
			  $pro_id = $p_price['p_id']; //getting the p_id of each item he/she add_to_cart
			  
			  $pro_price ="select * from products where product_id='$pro_id'"; //using the product_id='$pro_id' to look for all the item and each price tag in our all products table
			  
			  $run_pro_price = mysqli_query($con, $pro_price);
			  
			  while ($pp_price = mysqli_fetch_array($run_pro_price)){
				  
			$product_price =array($pp_price['product_price']); //we used array bcos the product_price might b morethaan one some time
			
			$product_title = $pp_price['product_title'];
			
			$product_image = $pp_price['product_image'];
			
			$single_price= $pp_price['product_price'];
			
             $values =array_sum($product_price); //therefore the array_sum function sum up all the prices in the array
			
			$total += $values;  //here  ' we incatinating the initial price plus total_sum 
						
							  		 			 
			 		
			 
			 ?>
	          
			  <tr align="center">
			  <td><input type="checkbox" name="remove[]" value=" <?php echo $pro_id;?>"/></td>
			  
			  <td><?php echo $product_title; ?><br>
			  
			  <img src="admin_area/product_images/<?php echo $product_image; ?>" width="60" height="60"/>
			  </td>
			  
			    <td><input type="text" size="4" name="qty" value="<?php echo  @$qty  ;?>"/></td>  <!-- <?php //echo $_SESSION['qty'];   undefined index?>  -->
		
			  
			  <?php
			
	                    if(isset($_POST['update_cart'])){  
						
                         $qty =$_POST['qty'];
						 
						 $update_qty = "update cart set qty ='$qty'";
						 
						 $run_qty = mysqli_query($con, $update_qty);
						
						 
						 
						 $_SESSION['qty'] = $qty; 
						 
						 $total = $total*$qty;
						 
						 

						}
			  
			  
			  ?>
			  
			  
			   <td><?php  echo "$" .$single_price;?></td>
			  			  			  
			  
			  </tr>
			 
	
          <?php  }} 			  //we close the while loop curly bracket  below the form here so  that it we keep displaying each inserted items
		       ?>
	<!--displaying the total price -->
	           <tr align="right">
			   
			    <td colspan="4"> <b>Sub Total:</b>  </td>
				<td> <?php echo "$" . $total;?>      </td>
			  
			  </tr>
			  
			  <tr align="center">
			     
					<!--colspan means the number of td size-lenght before the nex  either vertical or horizontal <td> ----- -->
					<td colspan="2"> <input type="submit" name="update_cart" value="Update cart"/></td>
					<td> <input type="submit" name="continue" value="Continue Shopping" /></td>
					<td><button><a href="checkout.php" style="text-decoration:none;color:black;">Checkout</a><button> </td>
			  
			  </tr>
	
	</table>
	
	</form> 
	
	                 <?php
					 
				
						
                   global $con;
				
				   $ip =getIp();                                                                 
			
				 if(isset($_POST['update_cart'])){   
            
				  //if update_cart button is press it should get the button with an inputs as $remove_id
					 //foreach loop has two parenthesis the method($_post) AND the button we wanna get('remove;).
					 foreach(@$_POST['remove'] as $remove_id){                                       // ie each of any posted-check button('remove') with the (Value ="$pro_id" from the table) is now passed to as $remove_id	
//		 
						 
					 $delete_product = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";            //ip_add='$ip'";meanss to delete only  of that particul $ip
					 
					 $run_delete = mysqli_query($con, $delete_product);
					 
					
					 
					 if($run_delete){
						 
						 echo "<script>window.open('cart.php','_self')</script>";
					 }
						 
					 } 
							 
									 
		   }
				 
                       if(isset($_POST['continue'])){
						   
						 echo  "<script>window.open('index.php','_self')</script>";
					   }
                      
					   
					       
					 ?>
	                                               
	
	  
	 
	 </div>
   
   
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


