
<?php



if(!isset($_SESSION['user_email']))  //'user_email' is from the database 


{
	
echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";	
	
}   else{



?>


<table width="795" align="center" bgcolor="pink">


<tr align="center">
<td colspan="6"><h2>View all Products Here  </h2></td>

</tr >



<tr align="center" bgcolor="skyblue">
      <th>S.N</th>
	   <th>Title</th>
	    <th>Image</th>
		 <th>Price</th>
		  <th>Edit</th>
		   <th>Delete</th>



</tr>
<?php 

include("includes/db.php");

$get_pro = "select *from products";

$run_pro = mysqli_query($con,$get_pro);

$i =0 ;  //starting from the first number an keep increementin

while($row_pro=mysqli_fetch_array($run_pro)){
	
	$pro_id = $row_pro['product_id'];
	$pro_title = $row_pro['product_title'];
	$pro_image = $row_pro['product_image'];
	$pro_price = $row_pro['product_price'];
	$i++;
?>
   <tr align="center">
   <td><?php echo $i;?></td>
   <td><?php echo $pro_title;?></td>
 <td> <img src="product_images/<?php echo $pro_image;?>" width="70" height="70"/> </td>
    <td><?php echo $pro_price;?></td>
    <td><a href="index.php?edit_pro=<?php echo $pro_id;?>">Edit</td>
    <td><a href="delete_pro.php?delete_pro=<?php echo $pro_id;?>">Delete</td>
   
   </tr>	
<?php  } ?>  





</table><?php }?>