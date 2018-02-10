<?php 
include 'db.php';

if(!empty($_POST["id"])){
	//$id = isset($_POST['id']) ? $_POST['id'] : '';
	$id = $_POST["id"];
	$qry = "SELECT agent_code FROM agent WHERE id = $id";
	print_r($qry);
	
	$test = mysqli_query($con,$qry);
	
	foreach ($test as $code) {
		?>
		<option value="<?php echo $code['agent_code']?>"><?php echo $code['agent_code']?></option>

		<?php
	}
	}
?>s