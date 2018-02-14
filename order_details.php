<?php
include 'db.php'; //connect the connection page
 session_start();
if(!isset($_SESSION['usertype']))
{
   header("location: login.php");

}
$name=$_SESSION['usertype'];
$id=$_SESSION['id'];
$cid=$_SESSION['c_id'];
//echo"$id";
//echo "$cid";
include('db.php');
$query="select * from order_details where c_id = '$cid' ORDER BY order_id DESC";
$result=mysqli_query($con,$query);
//var_dump($query);
 ?>



<html>
<head>
	<title>
		Order Details
	</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/app.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style type="text/css">
        .title-img{
    width:100px;
    height: 50px;
    margin-top: 0px
}
    </style>

	</head>
	<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          <a class="navbar-brand" href="#"><img src="images/logo.png" class="title-img" alt="logo"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="order_form.php">Home</a></li>
            <li><a href="details1.php">List Of Agents</a></li>
            <li><a href="agent.php">Add Agents/Address</a></li>
            <li><a href="order_details.php">View Orders</a></li>
            <li><a href="invoice.php">Invoice</a></li>
            <li><a href="register.php">Add Company</a></li>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">How it Works</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php //echo $_SESSION['username']; ?><span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
    </div>
  </nav>

		<div class="container-fluid">
			<h1>Order Details</h1>
			 <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%" border="4px" style="width:1500px; line-height: 50px;">
			 	<thead>
			 		<tr>
			 			<th>Order ID</th>
			 			<th>Order Date</th>
			 			<th>Agent Name</th>
			 			<th>Agent Code</th>
			 			<th>Shipping Address</th>
			 			<th>Billing Address</th>
			 			<th>Product</th>
			 			<th>Quantity</th>
			 			<th>Dispatch Status</th>
			 			<th>Invoice</th>
			 			<th>Order Status</th>
			 		</tr>
			 	</thead>
			 	<?php
			 	while($row=mysqli_fetch_assoc($result))
			 	{
			 		$id=$row['order_id'];
			 		$date=$row['order_date'];
			 		$agent_name=$row['agent_name'];
			 		$agent_code=$row['agent_code'];
			 		$shipping_address=$row['ship_address'];
			 		$billing_address2=$row['bill_address'];
			 		$product_name=$row['product'];
			 		$quantity=$row['quantity'];
			 		$dispatchstatus=$row['dispatch_status'];
			 		$orderstatus=$row['order_status'];
			 		$invoice=$row['invoice'];
			 		$file_name=$row['file_name'];

			 	?>
			 	<tr>
			 		<td><?php echo $id;?></td>
			 		<td><?php echo $date; ?></td>
			 		<td><?php echo $agent_name; ?></td>
			 		<td><?php echo $agent_code; ?></td>
			 		<td><?php echo $shipping_address; ?></td>
			 		<td><?php echo $billing_address2; ?></td>
			 		<td><?php echo $product_name; ?></td>
			 		<td><?php echo $quantity; ?></td>
			 		<td><?php echo $dispatchstatus; ?></td>
			 		<td><?php echo $file_name; ?><br>
			 	<!--script to upload file for particular row in datatable-->	<!--<td><form class="uploadForm" method="post" enctype="multipart/form-data">
			 			<p><label>Please select PDF file</label>
          <input id="input-7" name="pdf_file" type="file" class="file file-loading" accept="application/pdf" style="top: 0px;"></p>-->
          <input type="hidden" name="abc" value="<?php echo $id;?>">
          <!--<input type="submit" name="submit" class="btn btn-info" value="Download" />-->
          <button><a href="<?php echo $row['invoice']; ?>" class="button">View</a></button>
         


      </td>
			 		<td><?php echo $orderstatus; ?></td>
			 		</tr>

			 	<?php	}
			 	?>


			 	<?php/* to upload a file
include('../connect.php');




if(isset($_POST["submit"])){
$a=$_POST['abc'];
echo $a;
	$allow=array('pdf');
	$temp=explode(".",$_FILES['pdf_file']['name']);
	$extension=end($temp);
	$upload_file=$_FILES['pdf_file']['name'];
	$path="files1/invoice/".$upload_file;
	move_uploaded_file($_FILES['pdf_file']['tmp_name'],"files1/invoice/".$_FILES['pdf_file']['name']);
	//for($i=0;$i<$id1;$i++){
	$query=mysqli_query($mysqli,"UPDATE order_details set invoice='.$path.',file_name='$upload_file' WHERE order_id='$a'");
	
	if($query){
		echo "FILE UPLOAD SUCCESS";
	}else{
		echo "file upload error";
	}
}
*/?>

			 </table>
	</div>	

	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    
<script type="text/javascript">
$('#example').DataTable();
</script>			
	</body>
</html>






















