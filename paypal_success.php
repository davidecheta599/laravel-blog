<!--setting ur paypal to automaticaaly redirect your users to paypal_success.php:
(1)from your bussines_acct -- profile -- my selling tools -- website preferences  update --- 
Auto Return On button click --- input the  paypal_success.php URL below then 'SAVE  -->
<?php
session_start();
?>


<html>

   <head>
        <title>payment successful!</title>
   </head>
<body>



<?php

        include("includes/db.php");
		include("functions/functions.php");
		
		//this is about the product detail that the customer is paying for
		
		  $total = 0;//initial price by default to avoid error display when the total price is empty
		  
		  global $con;
		  
		  $ip = getIp(); 
		  
		  $sel_price = "select * from cart where ip_add ='$ip'";
		  
		  $run_price = mysqli_query($con, $sel_price);
		  
		  while($p_price=mysqli_fetch_array($run_price)){
			  
			  $pro_id = $p_price['p_id'];                    //getting the p_id of each item he/she add_to_cart
			  
			  $pro_price ="select * from products where product_id='$pro_id'";                  //using the product_id='$pro_id' to look for all the item and each price tag in our all products table
			  
			  $run_pro_price = mysqli_query($con, $pro_price);
			  
			  while ($pp_price = mysqli_fetch_array($run_pro_price)){
				  
			
			$product_price =array($pp_price['product_price']);			//we used array bcos the product_price might b morethaan one some time
			
			$product_id = $pp_price['product_id'];
			
			$values =array_sum($product_price);                           //therefore the array_sum function sum up all the prices in the array
			
			$total += $values;                               //here  ' we incatinating the initial price plus total_sum 
			
				  
				  
				  
				  
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
			    $total = $total*$qty;
		  }
		  else
		  {//if is $qty > 0
			  $qty=$qty;
		  $total = $total*$qty;
		  
		  }
		  
		  
		  
		  
		  // this is about the customer who is paying for the product
		   $user = $_SESSION['customer_email'];
		
		$get_c = "select * from customer where customer_email='$user'";
		
		$run_c =mysqli_query($con, $get_c);
		
		$row_c = mysqli_fetch_array($run_c);
		
		$c_id = $row_c['customer_id'];
		
		//And payment details from paypal about how much the customer is paying for (NOTE the $_GET['amt']['tx']['cc'] are constant from paypal)
		
		$amount = $_GET['amt']; //this are paypal constant :Getting amount,currency and transaction_id
		$currency = $_GET['cc'];
		$trx_id = $_GET['tx'];
		
		
		//wen customer click the log in button from "paypal payment with my account form" then run this code below
		//hahahahaha payment and order table are like husband and wife sharing the same values in every purches transantion on the same time 
		
		//inserting the payment to table
		$insert_payment = "insert into payments (amount,customer_id,product_id,trx_id,currency,payment_date) values ('$amount','$c_id ',' $pro_id','$trx_id','$currency',NOW())";
		
		$run_payments =mysqli_query($con,$insert_payment );
		
		//inserting the order into table
		$insert_order = "insert into orders (p_id,c_id,qty,order_date) values ('$pro_id','$c_id','$qty ',NOW())";
		$run_order = mysqli_query($con, $insert_order);
		//removing the products from cart
		$empty_cart = "delete from cart";
		$run_cart = mysqli_query($con, $empty_cart);
		
		
		
		
		
		
		if ($amount==$total){
			
			echo "<h2>Welcome:" . $_SESSION['customer_email']. "<br>" . "Your payment was successful!</h2>";
			echo"<a href='http://www.http://davidecheta599.net16.net/ecommerce/customer/my_account.php'/>Go to your account</a>";
		}
		
		else
		{
		echo "<h2>Welcome Guest, payment was failed</h2><br>";
		echo"<a href='http://www.http://davidecheta599.net16.net/ecommerce'>Go back to Shop</a>";
			
		}

?>

</body>
</html>