<?php



if(!isset($_SESSION['user_email']))  //'user_email' is from the database 


{
	
echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";	
	
}   else{



?><!DOCTYPE HTML>

 <?php include("includes/db.php"); ?>
<html>
<head>
<title>insert products</title>
<!--NOTE u need a textarea box only to runs this script -->

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
  
  
  
</head>
</head>

<body bgcolor="skyblue">

<form id="insert" action="insert_product.php" method="post" enctype="multipart/form-data">

<table align="center" width="795" bgcolor="white" border="2">


  <tr align="center">
      <td colspan="7"><h2> Insert New post Here</h2></td> <!--colspan means the number of td size-lenght before the nex <td> ----- -->

  </tr>
  
 <tr>
      <td align="right"><b>product Title:<b></td>
	  <td><input type="text" name="product_title" size="60" required /> </td> <!--  note the "required" function prompt box -->
  </tr>
  <tr>
      <td align="right"><b>product Catogory:</b></td>
	  <td>
	  <select name="product_cat">
	         <option>Select a Category</option>   
	  <?php
            $get_cats = "select * from categories";
	
	        $run_cats = mysqli_query($con, $get_cats);
	
	        while ($row_cats=mysqli_fetch_array($run_cats))
	     	//the cat_title list <li> must runs inside the while loop code block
		   {
	      $cat_id =$row_cats['cat_id'];
		  $cat_title =$row_cats['cat_title']; 
		
		
		echo "<option value='$cat_id'>$cat_title</option>";
		
	}
	  
	  ?>
	  
	  </select>

	  </td>
  </tr>
  <tr>
      <td align="right"><b>product brand:</b></td>
	  <td> <select name="product_brands">
	         <option>Select a Brand</option> 
			 
<?php
$get_brands = "select * from brands";
	
	$run_brands= mysqli_query($con, $get_brands);
	
	while ($row_brands=mysqli_fetch_array($run_brands))
		//the brands_title list <li>must runs inside the while loop code block
		{
	    $brands_id =$row_brands['brand_id'];
		$brands_title =$row_brands['brand_title'];

	echo "<option value='$brands_id'>$brands_title</option>";
		
	}
	  
	  ?>
</select>

	  </td>
  </tr>
  <tr>
      <td align="right"><b>product Image:</b></td>
	  <td><input type="file" name="product_image" /> </td>
  </tr>
  <tr>
      <td align="right"><b>product Price:</b></td>
	  <td><input type="text" name="product_price" required /> </td>
  </tr>
  <tr>
      <td align="right"><b>product Description:</b></td>
	  <td><textarea name="product_desc" cols="20" rows="10"></textarea> </td><!--the required html function do not work in the textarea -->
  </tr>
  <tr>
      <td align="right"><b>product Keywords:</b></td>
	  <td><input type="text" name="product_keywords" size="50" required/> </td>
  </tr>
  
   <tr align="center">
      
	  <td colspan="7"><input type="submit" name="insert_post"  value="Insert Product Now"/> </td>
  </tr>


</table>




</form>

</body>
</html>

<?php

if(isset($_POST['insert_post']))
//hahahahah now i understand it better!!!!!!!!!!!!!  this means if the insert_post button is click that it should get 
//and post all this variables below(note the variables are details from the form above) to	data_base
   {
         $product_title = $_POST['product_title'];
         $product_cat = $_POST['product_cat'];
         $product_brand = $_POST['product_brands'];
         $product_price = $_POST['product_price'];
         $product_desc = $_POST['product_desc'];
         $product_keywords = $_POST['product_keywords'];		 
	//getting the image name & tmp_name from the fields
	//the tmp_name of an image is the system name
	$product_image = $_FILES['product_image'] ['name'];
	$product_image_tmp = $_FILES['product_image'] ['tmp_name'];
	
	move_uploaded_file ($product_image_tmp,"product_images/$product_image");//has three parenthesis"(1)$product_image_tmp(2)where the image is located and store in your file/the $product_image name 
	
	 $insert_product = " insert into products (product_cat,product_brand,product_title,product_price,product_desc,product_image,product_keywords)
	 values 
	 ('$product_cat','$product_brand','$product_title','$product_price','$product_desc','$product_image','$product_keywords')";
	
	$insert_pro = mysqli_query($con,$insert_product);
	
	if($insert_pro){
		
		echo"<script>alert('product has been inserted!')</script>";
		echo "<script>window.open('index.php?insert_product','_self')</script>";
		
	}
	
	
}





 ?><?php }?>