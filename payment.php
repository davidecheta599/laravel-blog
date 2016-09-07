<!-- <div>

<h2> Pay now with paypal </h2>
<p style="text-align:center;"><img src="paypal.jpg" width="400" height="100"/></p>



</div> --->

<div>
     <?php
	 include("includes/db.php");
            
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
				  
			$product_price =array($pp_price['product_price']);	  //we used array bcos the product_price might b morethaan one some time
			
			$product_name = $pp_price['product_title'];
			
			
			
			$values =array_sum($product_price); //therefore the array_sum function sum up all the prices in the array
			
			$total += $values;  //here  ' we incatinating the initial price plus total_sum 
			
			  }  
		  }
//getting the quantity of the product
		  $get_qty = "select * from cart where p_id='$pro_id'";
		  
		  $run_qty = mysqli_query($con, $get_qty);
		  
		  $row_qty = mysqli_fetch_array($run_qty);
		  
		  $qty = $row_qty['qty'];
		  //from our database qty is default 0 bt is not a value so therefore
		  if($qty==0){
			  $qty=1;
		  }
		  else{$qty=$qty;
		   
		  }
	 ?>
	 
	  <!-------------------------your order summary display table ---------------------------------------->
	 
<h2> Pay now with paypal </h2>
<!-- form action="https://www.sandbox/paypal.com/cgi-bin/webscr" method="post"  for testing purpose-->
  <form action="https://www.paypal.com/cgi-bin/webscr" method="post">

  <!-- Identify your paypal-business email in the value= so that you can collect the payments. -->
  <input type="hidden" name="business" value="davidbusness@599.com">

  <!-- Specify a Buy Now button. -->
  <input type="hidden" name="cmd" value="_xclick">
          
  <!-- Specify details about the item that buyers will purchase.Note paypal name=constant ie dont change -->
  <input type="hidden" name="item_name" value="<?php echo $product_name;?>">
   <input type="hidden" name="item_number" value="<?php echo $pro_id; ?>">
  <input type="hidden" name="amount" value="<?php echo $total; ?>">
   <input type="hidden" name="quantity" value="<?php echo $qty; ?>">
  <input type="hidden" name="currency_code" value="USD">
  
  <input type="hidden" name="return" value="http://www.http://davidecheta599.net16.net/ecommerce/paypal_success.php"/>
    <input type="hidden" name="cancel_return" value="http://www.http://davidecheta599.net16.net/ecommerce/paypal_cancel.php"/>

  <!-- Display the payment button. -->
  <!-- to change the Display payment button copy&paste the URL http:// of that particuler paypal button here. Or save the image an do the normar html src-->
  <input type="image" name="submit" border="0"
  src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" 
  alt="PayPal - The safer, easier way to pay online">
  <img alt="" border="0" width="1" height="1"
  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form> 

</div>