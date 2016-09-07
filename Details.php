<!DOCTYPE HTML>
<?php
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
              <form action="result.php" method="get" enctype="multipart/form-data">
                 <input type="text" name="user-query" placeholder="search a product" />
                 <input type="submit" name="search" value="serach" />
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
   <div id="shopping_cart">
   
        <span style="float:right; font-size:16px; padding:5px;line-height:40px;">
		 
		 <?php
		 //display customer email if logged in else display we 'come guest
		 if(isset($_SESSION['customer_email']))
			 
		 
		 {echo "<b> Welcome:</b>" .$_SESSION['customer_email'] . "<b style='color:yellow;'> Your</b>" ; }
		 
		 else{echo "<b> Welcome Guest!</b>";}                                    ?> <b style="color:yellow">Shopping Cart -</b>Total Items:Total Price: <a href="cart.php"
		style="color:yellow">Go to Cart </a>
		
		
		</span>
   
   
   
   
   </div>
   
   
   
   
     <div id="products_box">
	 
	
	 
	 
	 <?php
	 
	 //when pro_id is equal to $pro_id ie that particular id to that item
	 if(isset($_GET['pro_id'])) {
		 
	$product_id = $_GET['pro_id'];	 //we now want to catch the invisible $pro_id
		 
	 
	 $get_pro = "select * from products where product_id='$product_id'";//getting Randomly 6 colums
	$run_pro =mysqli_query($con,$get_pro);
	
	while($row_pro =mysqli_fetch_array($run_pro)) {
	
	$pro_id =$row_pro['product_id'];
		$pro_desc =$row_pro['product_desc'];
		
				$pro_title =$row_pro['product_title'];
					$pro_price =$row_pro['product_price'];
						$pro_image=$row_pro['product_image'];
	
	//
	echo"
	  <div id='single_product'>
	  
	  <h3>$pro_title</h3>
	  
	  <img src='admin_area/product_images/$pro_image' width='400' height='300' />
	  
	  <p><b> $$pro_price </b></p>
	  
	   <p>$pro_desc</p>
	  
	  <a href='index.php' style='float:left;'> Go Back</a>
	  <a href='index.php?pro_id=$pro_id'><button style='float:right'> Add to cart </button> </a>
	  
	  
	  </div>
	
	";
	
	
}
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


