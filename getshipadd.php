<?php 
include 'db.php';

if(!empty($_POST["id"])){
	//$id = isset($_POST['id']) ? $_POST['id'] : '';
	$id = $_POST["id"];
	$query = "SELECT ship_address FROM agent_shipping_address WHERE id = $id";
	
	$results = mysqli_query($con,$query);
	
	foreach ($results as $ship) {
		?>
		<option value="<?php echo $ship['ship_address']?>"><?php echo $ship['ship_address']?></option>

		<?php
	}
	}
?>
