<?php
include 'db.php';
if(!empty($_POST["id"])){
	//$id = isset($_POST['id']) ? $_POST['id'] : '';
	$id = $_POST["id"];
	$que = "SELECT bill_address FROM agent_billing_address WHERE id = $id ";
	$res = mysqli_query($con,$que);

	foreach ($res as $bill){
		?>
		<option value="<?php echo $bill['bill_address']?>"><?php echo $bill['bill_address']?></option>
		<?php 
	}
	}
?>