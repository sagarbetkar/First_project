<?php
include('db.php');

/*$res=mysqli_query($con,"select * from country");
$countries = array();
while($row=mysqli_fetch_array($res))
{
	$countries.push($row["name"])

}*/
session_start();
if(!isset($_SESSION['usertype']))
{
   header("location: login.php");

}
$name=$_SESSION['usertype'];
$id=$_SESSION['id'];
$cid=$_SESSION['c_id'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Tag8 - ADD/Modify Agents</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/app.css">
	<link rel="stylesheet" href="css/agent.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
    <div class="container">
    	<div class="panel panel-default">
    		<div class="panel-heading">ADD/Modify Agent</div>
    		<div class="panel-body">
    			<div class="panel panel-default">
  					<div class="panel-heading">* All fields are mandatory</div>
    				<div class="panel-body">
    			        <form class="form-horizontal" action="agentadd.php" method="post">
    			        	<div class="form-group">
								<label for="agent_code" class="col-sm-3 control-label">Agent Code</label>
								<div class="col-sm-6">
									<input type="text" name="agent_code" id="agent_code" class="form-control" value="" required>
								</div>
							</div>
							<div class="form-group">
			    	    		<label for="agent_name" class="col-sm-3 control-label">Agent_Name</label>
			    	    		<div class="col-sm-6">
			    	    			<input type="text" name="agent_name" id="agent_name" class="form-control" value="" required>
			    	    		</div>                 
			    	    	</div>
			    	    	<div class="form-group">
			    	    		<label for="registration" class="col-sm-3 control-label">Email ID</label>
			    	    		<div class="col-sm-6">
			    	    			<input type="email" name="email_id" placeholder="Enter your email" id="email_id" class="form-control" value="" required>
			    	    		</div>
			    	    	</div>
			    	    	<div class="form-group">
			    	    		<label for="registration" class="col-sm-3 control-label">Mobile No.</label>
			    	    		<div class="col-sm-6">
			    	    			<input type="tel" name="contact_no" maxlength="11" pattern="[789][0-9]{9}" placeholder="10 Digit Mobile No." id="contact_no" class="form-control" value="" required>
			    	    		</div>
			    	    	</div>
			    	    	<div class="form-group">
			    	    		<div class="col-sm-2 control-label"><u>Shipping Details</div>
			    	    	</div>
			    	    	<div class="form-group">
			    	    		<label for="Shipping Company Name" class="col-sm-3 control-label">Shipping Company Name</label>
			    	    		<div class="col-sm-6">
			    	    			<input type="text" name="shipping_company_name" id="shipping_company_name" class="form-control" value="" required>
			    	    		</div>
			    	    	</div>
			    	    	<div class="form-group">
			    	    		<label for="Shipping Address" class="col-sm-3 control-label">Shipping Address</label>
			    	    		<div class="col-sm-6">
			    	    			<textarea class="form-control" name="ship_address" id="ship_address" rows="3" placeholder="255 words" value=""></textarea>
			    	    		</div>
			    	    	</div>	
							<!--<div class="form-group">
			    	    		<label for="Shipping Address" class="col-sm-3 control-label">Shipping Address2</label>
			    	    		<div class="col-sm-6">
			    	    			<textarea class="form-control" name="ship_add2" id="ship_add2" rows="3" placeholder="255 words" value=""></textarea>
			    	    		</div>
			    	    	</div>	-->
			    	    	<div class="form-group">
			    	    		<label for="shipcity" class="col-sm-3 control-label">Ship City</label>
			    	    		<div class="col-sm-6">
			    	    			<input type="text" name="ship_city" id="ship_city" class="form-control" value=""  required>
			    	    		</div>
			    	    	</div>
			    	    	<div class="form-group">
			    	    		<label for="shipcountry" class="col-sm-3 control-label">Ship Country</label>
			    	    		<div class="col-sm-6">
			    	    			<select name="ship_country" id="ship_country" onchange="getState(this);" class="form-control">
			    	    				<option value=''>Select Country</option>
			    	    				<?php 
								$res=mysqli_query($con,"select * from country");
								while($row=mysqli_fetch_array($res))
								{
									?>
									<option value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
									<?php
								}
								
								?>
			    	    				<!--<?php 
								//$res=mysqli_query($con,"select * from country");
								//for($i)
								{
									?>
									<option value="<?php //echo $i; ?>"><?php //echo $countries[$i]; ?></option>
									<?php
								}
								?>-->
			    	    			</select>
			    	    			<input type="hidden" id="ship_country_text" name="ship_country_text">
			    	    		</div>
			    	    	</div>
			    	    	<div class="form-group">
			    	    		<label for="state" class="col-sm-3 control-label">Ship State</label>
			    	    		<div class="col-sm-6">
			    	    			<select name="ship_state" id="ship_state" class="form-control">
                                		<option value=''>Select State</option>
                                 	</select>
			    	    		</div>
			    	    	</div>
			    	    	<div class="form-group">
			    	    		<label for="shipping Zipcode" class="col-sm-3 control-label">Shipping Zipcode</label>
			    	    		<div class="col-sm-6">
								    <input type="text" name="ship_zipcode" id="ship_zipcode" class="form-control" value="" required>
								</div>
			    	    	</div>
			    	    	<div class="form-group">
			    	    	<div class="col-sm-5 control-label">
			    	    		<input type="checkbox" id="ship_checkbox" onclick="copy()">
								<em>Check this box if Billing Details are same as</em>
								<b>Shipping Address</b>
							</div>
			    	    	</div>
			    	    	<div class="form-group">
			    	    		<div class="col-sm-2 control-label"><u>Billing Details</u></div>
			    	    	</div>
			    	    	<div class="form-group">
			    	    		<label for="Billing Company Name" class="col-sm-3 control-label">Billing Company Name</label>
			    	    		<div class="col-sm-6">
			    	    			<input type="text" name="billing_company_name" id="billing_company_name" class="form-control" value="" required>
			    	    		</div>
			    	    	</div>
			    	    	<div class="form-group">
			    	    		<label for="Billing_Address" class="col-sm-3 control-label">Billing Address</label>
			    	    		<div class="col-sm-6">
			    	    			<textarea class="form-control" name="bill_address" id="bill_address" rows="3" placeholder="255 words"></textarea>
			    	    		</div>
			    	    	</div>	
							<!--<div class="form-group">
			    	    		<label for="Billing_Address" class="col-sm-3 control-label">Billing Address2</label>
			    	    		<div class="col-sm-6">
			    	    			<textarea class="form-control" name="bill_add2" id="bill_add2" rows="3" placeholder="255 words"></textarea>
			    	    		</div>
			    	    	</div>	-->
			    	    	<div class="form-group">
			    	    		<label for="Bill_city" class="col-sm-3 control-label">Bill City</label>
			    	    		<div class="col-sm-6">
			    	    			<input type="text" name="bill_city" id="bill_city" class="form-control" value="" required>
			    	    		</div>
			    	    	</div>
			    	    	<div class="form-group">
			    	    		<label for="billCountry" class="col-sm-3 control-label">Bill Country</label>
			    	    		<div class="col-sm-6">
									<select name="bill_country" id="bill_country" onChange="getStat(this.value);" class="form-control">
										<option value=''>Select Country</option>
								
								<?php 
								$res=mysqli_query($con,"select * from country");
								while($row=mysqli_fetch_array($res))
								{
									?>
									<option value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
									<?php
								}
								
								?>
 
                                 	</select>
								</div>
							</div>
							<div class="form-group">
			    	    		<label for="state" class="col-sm-3 control-label">Bill State</label>
			    	    		<div class="col-sm-6">
									<select name="bill_state" id="bill_state" class="form-control">
										<option value=''>Select State</option>
									</select>
								 </div>
			    	    	</div>
			    	    	<div class="form-group">
								<label for="Billing Zipcode" class="col-sm-3 control-label">Billing Zipcode</label> 
								<div class="col-sm-6">
								    <input type="text" name="bill_zipcode" id="bill_zipcode" class="form-control" value="" required>
								</div>
							</div>
							<div class="form-group">        
			    	    		<div class="col-sm-offset-3 col-sm-6">
			    	    			<button type="submit" class="btn btn-primary">Submit</button>
			    	    		</div>
			    	    	</div>
    			        </form>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="js/form.js" type="text/javascript"></script>
	
</body>
</html>