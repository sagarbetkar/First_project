<html>
<head>
</head>
<body>
<?php
include('db.php');


?>
<option>Select State</option>
<?php
$res=mysqli_query($con,"select state_name from state WHERE country_id = '" . $_POST["country_id"] . "'");
								while($row=mysqli_fetch_array($res))
								{
									?>
									<option value="<?php echo $row["state_name"]; ?>"><?php echo $row["state_name"]; ?></option>
									<?php
								}
								
							?>
<body>
</html>