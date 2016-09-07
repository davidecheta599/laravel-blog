<?php
session_start();
session_destroy();
               //logout-page for customer/logout (../index   this means go back two folders) 
 echo"<script>window.open('../index.php','_self') </script>";
			 

?>