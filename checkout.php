<!DOCTYPE HTML>
<?php

session_start();
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
		 
		 else{echo "<b> Welcome Guest!</b>";}                                    ?><b style="color:yellow">Shopping Cart -</b>Total Items:<?php total_item();?>  Total Price:<?php total_price();?> <a href="cart.php"
		style="color:yellow">Go to Cart </a>
		
		
		</span>
   
   
   
   
   </div>
   
  
   
   
     <div id="products_box">
	 
               <?php

	 if(!isset($_SESSION['customer_email'])){
			  
			include("customer_login.php");
			  
			  
		  }else{
			  
			  include("payment.php");
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


