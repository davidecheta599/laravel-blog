<?php

session_start();

if(!isset($_SESSION['user_email']))  //'user_email' is from the database 


{
	
echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";	
	
}   else{



?>

<!DOCTYPE>

<html>
<head>
    <title>This is Admin panel</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css" media="all"/>
	</head>
	
	<body>
	<div class="main_wrapper">
	
	<div id="header"> </div>
	
	<div id="right">
	
	
	<h2 style="text-align:center;">Manage Content</h2>
	
	<a href="index.php?insert_product">Insert new product</a>
	<a href="index.php?view_products">View All Products</a>
	<a href="index.php?insert_cat">Insert New Categories</a>
	<a href="index.php?view_cats">View All Category</a>
	<a href="index.php?insert_brand">Insert New brand</a>
	<a href="index.php?view_brands">View all brands</a>
	<a href="index.php?view_customers">view Customers</a>
	<a href="index.php?view_orders">View orders</a>
	<a href="index.php?view_payments">View payments</a>
	<a href="logout.php">Admin logout</a>
	
	
	</div>
	
	<div id="left">
	
	
	<h2 style="text-align:center;"><?php echo @$_GET['logged_in']; ?></h2>
	<?php 
	
	if(isset($_GET['insert_product'])){
      include('insert_product.php');
		
	}
	
	if(isset($_GET['view_products'])){
      include('view_products.php');
		
	}
	
	if(isset($_GET['edit_pro'])){
      include('edit_pro.php');
		
	}
	
	if(isset($_GET['insert_cat'])){
      include('insert_cat.php');
		
	}
	
	
	if(isset($_GET['view_cats'])){
      include('view_cats.php');
		
	}
	
	if(isset($_GET['edit_cat'])){
      include('edit_cat.php');
		
	}
	
	if(isset($_GET['insert_brand'])){
      include('insert_brand.php');
		
	}
	
	if(isset($_GET['view_brands'])){
      include('view_brands.php');
		
	}
	
	if(isset($_GET['edit_brand'])){
      include('edit_brand.php');
		
	}
	
		
	if(isset($_GET['delete_brand'])){
      include('delete_brand.php');
		
	}
	
	if(isset($_GET['view_customers'])){
      include('view_customers.php');
		
	}
	?>
	
	</div>
	
	
	
	</div>
	
	</body>
	</html>
	<?php } ?>
	