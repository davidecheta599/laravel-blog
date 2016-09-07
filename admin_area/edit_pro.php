<?php



if(!isset($_SESSION['user_email']))  //'user_email' is from the database 


{
	
echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";	
	
}   else{



?><!DOCTYPE HTML>

 <?php include("includes/db.php"); ?>
 
 <?php
 
 if(isset($_GET['edit_pro'])){
	 
	 
	 
	 
	 $get_id = $_GET['edit_pro'];//now les get hold of that invisible $pro_id as $get_id from $_GET['edit_pro']
	 
	 
	 
	 $get_pro = "select * from products where product_id='$get_id'";

        $run_pro = mysqli_query($con,$get_pro);



    $row_pro = mysqli_fetch_array($run_pro);{ //if u like put the open and close curly bracket or not
	
	$pro_id = $row_pro['product_id'];
	$pro_title = $row_pro['product_title'];
	$pro_image = $row_pro['product_image'];
	$pro_price = $row_pro['product_price'];
	$pro_desc= $row_pro['product_desc'];
	$pro_keywords = $row_pro['product_keywords']; 
	$pro_cat= $row_pro['product_cat'];
 $pro_brand= $row_pro['product_brand'];}
	//here we need the $pro_cat to b able to access the categories table therefore gettin the categories title name of that particuler $get_id
$get_cat ="select * from categories where cat_id='$pro_cat'";

$run_cat = mysqli_query($con, $get_cat);

$row_cat = mysqli_fetch_array($run_cat);

$category_title = $row_cat['cat_title'];


	//here we need the $pro_brand to b able to access the brands table therefore gettin the brand title name of that particuler $get_id 
 $get_brand ="select * from brands where brand_id='$pro_brand'";

$run_brand = mysqli_query($con, $get_brand);

$row_brand = mysqli_fetch_array($run_brand);

$brand_title = $row_brand['brand_title'];

 }
 
 
 
 
 
 ?>
<html>
<head>
<title>update product</title>
<!--NOTE u need a textarea box only to runs this script -->

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
  
  
  
</head>
</head>

<body bgcolor="skyblue">

<form id="insert" action="" method="post" enctype="multipart/form-data">

<table align="center" width="795" bgcolor="white" border="2">


  <tr align="center">
      <td colspan="7"><h2> Edit & update Product</h2></td> <!--colspan means the number of td size-lenght before the nex <td> ----- -->

  </tr>
  
 <tr>
      <td align="right"><b>product Title:<b></td>
	  <td>  <input type="text" name="product_title" size="60" value="<?php echo $pro_title; ?>" /> </td> 
  </tr>
  
  <tr>
      <td align="right"><b>product Catogory:</b></td>
	  <td>
	  <select name="product_cat">
 <option><?php echo $category_title;?></option>  
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
	       <option><?php echo $brand_title;?></option>  
			 
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
	  <td><input type="file" name="product_image" /> <img src="product_images/<?php echo $pro_image;?>" width="100" height="100"/></td>
	   
  </tr>
  <tr>
      <td align="right"><b>product Price:</b></td>
	  <td><input type="text" name="product_price"value="<?php echo $pro_price;?>" /> </td>
  </tr>
  <tr>
      <td align="right"><b>product Description:</b></td>
	  <td><textarea name="product_desc" cols="20" rows="10"> <?php echo $pro_desc;?></textarea> </td><!--the required html function do not work in the textarea -->
  </tr>
  <tr>
      <td align="right"><b>product Keywords:</b></td>
	  <td><input type="text" name="product_keywords" size="50" value="<?php echo $pro_keywords;?>" /> </td>
  </tr>
  
   <tr align="center">
      
	  <td colspan="7"><input type="submit" name="update_post"  value="Update Product"/> </td>
  </tr>


</table>




</form>

</body>
</html>

<?php

if(isset($_POST['update_post']))
	
         {
	   
	   $update_id = $pro_id;
	   
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
	
	
	$update_product = "update products set product_cat='$product_cat',product_brand='$product_brand',
	product_title='$product_title',product_price='$product_price',product_desc='$product_desc',
	product_image='$product_image',product_keywords='$product_keywords' where product_id='$update_id' ";
	
	$run_product = mysqli_query($con, $update_product);
	
	if($run_product){
		
		echo"<script>alert('product has been updated!')</script>";
		echo "<script>window.open('index.php?view_products','_self')</script>";
		
	}
	
}





 ?><?php }?>