<?php 
$con = mysqli_connect("localhost","root","","ecommerce");


function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}
 

function cart(){
	//NOTE if the add_card button is press it call for function cart() at index.php
	if (isset($_GET['add_cart'])) {
		
	global $con;
    $ip =	getIp();
	
	$pro_id = $_GET['add_cart'];//from getpro function add_cart is defined as ?add_cart=$pro_id
	
    $check_pro ="select * from cart where ip_add='$ip' AND p_id='$pro_id'";
	  
     $run_check = mysqli_query($con, $check_pro);
  
    if(mysqli_num_rows($run_check)>0){
		
	echo "";
	}
	 
	 
	 //ie if add_cart do exist in the database dont insert it again in the cart table ..else insert
		 
	 
	 
	else{
	$insert_pro ="insert into cart (p_id,ip_add) values('$pro_id','$ip')";	
	$run_pro =mysqli_query($con, $insert_pro);
	
	echo" <script>window.open('index.php','_self')</script>";
	// OR  echo "<script>alert('product has been inserted')</script>";	
	}
	  
	}
	
}
  //getting the total number of items a particuler user has added_to_cart
function total_item(){
	if (isset($_GET['add_cart'])) {
		
		global $con;
		
		$ip = getIp();
		
		$get_items ="select * from cart where ip_add='$ip'";
		
		$run_items = mysqli_query($con, $get_items);
	
	
	 $count_items  = mysqli_num_rows($run_items);
	}
		else
			
			
	
	global $con;
		
		$ip = getIp();
		
		$get_items ="select * from cart where ip_add='$ip'";
		
		$run_items = mysqli_query($con, $get_items);
	 $count_items  = mysqli_num_rows($run_items);
		
		{	echo $count_items ;
		
		}
		
		
	}
	
	// gettting the total price of the item in th cart
	
	  function total_price(){
		  
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
			
			$values =array_sum($product_price); //therefore the array_sum function sum up all the prices in the array
			
			$total += $values;  //here  ' we incatinating the initial price plus total_sum 
			
				  
				  
				  
				  
			  }
		  }
		  
		echo"$" .$total;  
		  
		  
	  }
	  
	

//getting the categories

function getCats(){
	global $con;
	
	$get_cats = "select * from categories";
	
	$run_cats = mysqli_query($con, $get_cats);
	
	while ($row_cats=mysqli_fetch_array($run_cats))
		//the cat_title list <li> must runs inside the while loop code block
		{
	    $cat_id =$row_cats['cat_id'];
		$cat_title =$row_cats['cat_title'];
		
		            //this wil direct us to index.php? GET cat variable of if own specific id
					
		echo "<li> <a href='index.php?cat=$cat_id'> $cat_title </a> </li>";
		
	}
	
}

function getbrands(){
	global $con;
	
	$get_brands = "select * from brands";
	
	$run_brands= mysqli_query($con, $get_brands);
	
	while ($row_brands=mysqli_fetch_array($run_brands))
		//the brands_title list <li>must runs inside the while loop code block
		{
	    $brand_id =$row_brands['brand_id'];
		$brands_title =$row_brands['brand_title'];
		
		//this wil direct us to index.php? GET brand variable of if own specific id
		
		echo "<li> <a href='index.php?brand=$brand_id'> $brands_title </a> </li>";
		
	}
	
	}
function getpro(){
//if the 'cat'or brand is not getting on the url box..the run this code
if(!isset($_GET['cat'])) {	
if(!isset($_GET['brand'])) {	
	
	
	
	global $con;
	$get_pro = "select * from products order by RAND() LIMIT 0,6";//getting Randomly 6 colums
	$run_pro =mysqli_query($con,$get_pro);
	
	while($row_pro =mysqli_fetch_array($run_pro)) {
	
	$pro_id =$row_pro['product_id'];
		$pro_cat =$row_pro['product_cat'];
			$pro_brand =$row_pro['product_brand'];
				$pro_title =$row_pro['product_title'];
					$pro_price =$row_pro['product_price'];
						$pro_image=$row_pro['product_image'];
	
	//
	echo"
	  <div id='single_product'>
	  
	  <h3>$pro_title</h3>
	  
	  <img src='admin_area/product_images/$pro_image' width='180' height='180' />
	  
	  <p><b> Price: $ $pro_price </b></p>
	  
	  <a href='details.php?pro_id=$pro_id' style='float:left;'> Details</a>
	  <a href='index.php?add_cart=$pro_id'><button style='float:right'> Add to cart </button> </a>
	  
	  
	  </div>
	
	";
	
}
}	
}
}


function getcatpro(){
//if the 'cat'is not getting on the url box..then run this code
if(isset($_GET['cat'])) {	

    $cat_id =$_GET['cat'];
	
	
	
	
	global $con;
	
	$get_cat_pro = "select * from products where product_cat='$cat_id'";//where product_cat='$cat_id' this means look for that product_cat that am holding ($cat_id')on to 
	                                                                    //Bcos each product of the same kind has the same product_cat..
	                                                                 //example rolex has product_cat of (7)therefore display every  (7) in the table
	
	$run_cat_pro =mysqli_query($con,$get_cat_pro);
	$count_cats = mysqli_num_rows($run_cat_pro);
	
	
	if($count_cats==0) {
		
		echo "<h2 style='padding:20px;'> There is no product found in this category!</h2>";
		exit();
	}
	
	
	while($row_cat_pro =mysqli_fetch_array($run_cat_pro)) {
	
	$pro_id =$row_cat_pro['product_id'];
		$pro_cat =$row_cat_pro['product_cat'];
			$pro_brand =$row_cat_pro['product_brand'];
				$pro_title =$row_cat_pro['product_title'];
					$pro_price =$row_cat_pro['product_price'];
						$pro_image=$row_cat_pro['product_image'];
	
	
	
	
	
	echo"
	  <div id='single_product'>
	  
	  <h3>$pro_title</h3>
	  
	  <img src='admin_area/product_images/$pro_image' width='180' height='180' />
	  
	  <p><b> $$pro_price </b></p>
	  
	  <a href='details.php?pro_id=$pro_id' style='float:left;'> Details</a>
	  <a href='index.php?pro_id=$pro_id'><button style='float:right'> Add to cart </button> </a>
	  
	  
	  </div>
	
	";
	
}
	
	
}
}


function getbrandpro(){
//if the 'cat'is not getting on the url box..then run this code
if(isset($_GET['brand'])) {	

    $brand_id =$_GET['brand'];
	
	
	
	
	global $con;
	
	$get_brand_pro = "select * from products where product_brand='$brand_id'";//where product_brand='$brand_id' this means look for that product_brand that am holding ($cat_id')on to 
	                                                                    //Bcos each product of the same kind has the same product_brand..
	                                                                 //example rolex has product_brand of (7)therefore display every  (7) in the table
	
	$run_brand_pro =mysqli_query($con,$get_brand_pro);
	$count_brand = mysqli_num_rows($run_brand_pro);
	
	
	if($count_brand==0) {
		
		echo "<h2 style='padding:20px;'>No products was found associated with this brand!</h2>";
		exit();
	}
	
	
	while($row_brand_pro =mysqli_fetch_array($run_brand_pro)) {
	
	$pro_id =$row_brand_pro['product_id'];
		$pro_cat =$row_brand_pro['product_cat'];
			$pro_brand =$row_brand_pro['product_brand'];
				$pro_title =$row_brand_pro['product_title'];
					$pro_price =$row_brand_pro['product_price'];
						$pro_image=$row_brand_pro['product_image'];
	
	
	
	
	
	echo"
	  <div id='single_product'>
	  
	  <h3>$pro_title</h3>
	  
	  <img src='admin_area/product_images/$pro_image' width='180' height='180' />
	  
	  <p><b> $$pro_price </b></p>
	  
	  <a href='details.php?pro_id=$pro_id' style='float:left;'> Details</a>
	  <a href='index.php?pro_id=$pro_id'><button style='float:right'> Add to cart </button> </a>
	  
	  
	  </div>
	
	";
	
}
	
	
}
}

?>