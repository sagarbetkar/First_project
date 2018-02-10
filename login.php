<?php
include('db.php');
/*$con=mysql_connect("localhost","root","");
if(!$con)
{
	echo"unabel to connect".mysql_error();
}
$db=mysql_select_db("order _portal",$con);
if(!$db)
{
	echo"database not found".mysql_error();
}*/
if(isset($_POST['submit'])){
	$usertype=$_POST['usertype'];
	$username=$_POST['username'];
	$password=$_POST['pwd'];
		$query="select * from company where username='$username' and password='$password' and usertype='$usertype'";
		$result=mysqli_query($mysqli,$query);
		while ($row=mysqli_fetch_array($result)){
			if($row['username']==$username && $row['password']==$password && $row['usertype']=='Admin'){
				header("location:../Controller/order_form.php");
			}
			elseif ($row['username']==$username && $row['password']==$password && $row['usertype']=='User') {
				header("location:details1.php");
			}
		}		
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tag8 - Login</title>
	<link rel="stylesheet" href="css/app.css"/>
	<link rel="stylesheet" href="css/login.css"/>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#"><img class="title-img" src="images/logo.png" /></a>
			</div>
		</div>
	</nav>
	<div class="container">
  		<div class="panel panel-default">
  			<div class="panel-heading">Login</div>
  			<div class="panel-body">
     			<form class="form-horizontal" action="">
        				<div class="form-group">
      			<label class="control-label col-sm-2" for="email">Username:</label>
      			<div class="col-sm-10">
        			<input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
     			</div>
    		</div>
    		<div class="form-group">
      			<label class="control-label col-sm-2" for="pwd">Password:</label>
      			<div class="col-sm-10">          
        			<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
      			</div>
    		</div>
    		<div class="form-group">        
      			<div class="col-sm-offset-2 col-sm-10">
      				<div>
      					<a href="forgotpass.php">Forgot Your Password?</a>
      				</div>
        			<div class="checkbox">
          				<label><input type="checkbox" name="remember"> Remember me</label>
        			</div>
      			</div>
    		</div>
    		<div class="form-group">        
      			<div class="col-sm-offset-2 col-sm-10">
        			<button type="submit" class="btn btn-primary" name="submit" value="login">Login</button>
      			</div>
    		</div>
  		</form>

  			</div>
  		</div>
  	</div>

	
</body>
</html>
