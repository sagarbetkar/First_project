<?php
$id = $_GET['id'];
include 'db.php';
$qry=mysqli_query($con,"SELECT agent_code FROM agent WHERE id=$id");
//$shipqry=mysqli_query($con,"SELECT address1 FROM agent_shipping_address WHERE id=$id");
//$billqry=mysqli_query($con,"SELECT address1 FROM agent_billing_address WHERE id=$id");
$qry_res= mysqli_fetch_array($qry);
//$billqry_res= mysqli_fetch_array($billqry);
//$shipqry_res= mysqli_fetch_array($shipqry);
echo $qry_res[0];
//echo $billqry_res[0];
//echo $shipqry_res[0];
?>