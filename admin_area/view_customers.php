<?php


if(!isset($_SESSION['user_email']))  //'user_email' is from the database 


{
	
echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";	
	
}   else{



?>

<table width="795" align="center" bgcolor="pink">


<tr align="center">
<td colspan="6"><h2>View all Customers Here  </h2></td>

</tr >



<tr align="center" bgcolor="skyblue">
      <th>S.N</th>
	   <th>Name</th>
	    <th>Email</th>
		  <th>image</th>
		   <th>Delete</th>



</tr>
<?php 

include("includes/db.php");

$get_c = "select * from customer ";

$run_c = mysqli_query($con, $get_c);

$i =0 ;  //starting from the first number an keep increementin

while ($row_c = mysqli_fetch_array($run_c)){
	
	$c_id = $row_c['customer_id'];
	$c_name = $row_c['customer_name'];
	$c_email = $row_c['customer_email'];
	$c_image = $row_c['customer_image'];
	$i++;
?>
  <tr align="center">
     <td><?php echo $i;?></td>
     <td><?php echo $c_name;?></td>
     <td><?php echo $c_email;?></td>
     <td> <img src="../customer/customer_images/<?php echo $c_image;?>" width="70" height="70"/> </td>
     <td><a href="delete_c.php?delete_c=<?php echo $c_id;?>">Delete</td>
   
  </tr>	
<?php  } ?>  





</table><?php }?>