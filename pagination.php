

<?php

$per_page=6;
$page = $_GET[“page”];
$page=1;
$start_from = ($page-1) * $per_page;

//Now select all from table
$query =  "select * from products ";
$result = mysqli_query($con, $query);


$total_records = mysqli_num_rows($result);


$total_pages = ceil($total_records / $per_page);


echo “<center><a href=’all_products.php?page=1′>”.’First Page’.”</a> “;

for ($i=1; $i<=$total_pages; $i++) {

echo “<a href=’all_products.php?page=”.$i.”‘>”.$i.”</a> “;
};
// Going to last page
echo “<a href=’pagination.php?page=$total_pages’>”.’Last Page’.”</a></center> “;
?>

