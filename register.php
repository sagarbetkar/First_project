<?php
include('db.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
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
          <!--<a class="navbar-brand" href="#"><img src="images/logo.png" class="title-img" alt="logo"></a>-->
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
		<div class="main row">
			<div class="main-center">
			    <div class="panel panel-default">
			    	<div class="panel-heading">Registration</div>
			    	    <div class="panel-body">
			    	    	<div class="panel panel-default">
			    	    		<div class="panel-heading">* All fields are mandatory</div>
			    	    		<div class="panel-body">
			    	    			<form class="form-horizontal" action="submit.php" method="post">
										<div class="form-group">
			    	    					<label for="Company_name" class="col-sm-3 control-label">Company Name</label>
			    	    					<div class="col-sm-6">
			    	    						<input type="text" name="company_name" id="company_name" class="form-control" value="" required>
			    	    					</div>
			    	    				</div>
			    	    				<div class="form-group">
			    	    					<label for="Name" class="col-sm-3 control-label">Full Name</label>
			    	    					<div class="col-sm-6">
			    	    						<input type="text" name="name" id="name" class="form-control" value="" required>
			    	    					</div>                 
			    	    				</div>
					    	    		<div class="form-group">
			    	    					<label for="registration" class="col-sm-3 control-label">Email ID</label>
			    	    					<div class="col-sm-6">
			    	    						<input type="email" name="email" required placeholder="Enter your email" id="email" class="form-control" value="">
			    	    					</div>
			    	    				</div>
			    	    				<div class="form-group">
			    	    					<label for="registration" class="col-sm-3 control-label">Mobile No.</label>
			    	    					<div class="col-sm-6">
			    	    						<input type="tel" name="contact_no" maxlength="11" pattern="[789][0-9]{9}" required placeholder="10 Digit Mobile No." id="contact_no" class="form-control" value="">
			    	    					</div>
			    	    				</div>
				    	    			<div class="form-group">
			    	    					<label for="address" class="col-sm-3 control-label">Address</label>
			    	    					<div class="col-sm-6">
			    	    						<textarea class="form-control" name="address" id="address" rows="3" placeholder="1250 words"></textarea>	
			    	    					</div>
			    	    				</div>
				    	    			<div class="form-group">
			    	    					<label for="shipcountry" class="col-sm-3 control-label"> Country</label>
			    	    					<div class="col-sm-6">
												<select name="country" class="form-control" onchange="getState(this);">
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
                                 				<input type="hidden" name="country_text" id="country_text">
								 			</div>
								 		</div>
			    	    				<div class="form-group">
			    	    					<label for="state" class="col-sm-3 control-label"> State</label>
			    	    					<div class="col-sm-6">
												<select name="state" id="state" class="form-control">
                                  					<option value=''>Select State</option>
                                 				</select>
								 			</div>
										</div>
										<div class="form-group">
			    	    					<label for="city" class="col-sm-3 control-label">City</label>
			    	    					<div class="col-sm-6">
			    	    						<input type="text" name="city" id="city" class="form-control" value="" required>
			    	    					</div>
			    	    				</div>
										<div class="form-group">
			    	    					<label for="city" class="col-sm-3 control-label">ZipCode</label>
			    	    					<div class="col-sm-6">
			    	    						<input type="text" name="zipcode" id="zipcode" class="form-control" value="" required>
			    	    					</div>
			    	    				</div>
			    	    				<div class="form-group">
			    	    					<label for="PRODUCTS" class="col-sm-3 control-label">PRODUCTS</label>
			    	    					<div class="col-sm-6">
			    	    						<input type="checkbox" name="products[]" value="Premium Starter Kit"> Premium Starter Kit<br>
			    	    						<input type="checkbox" name="products[]" value="Passport Security Tag"> Passport Security Tag<br>
			    	    						<input type="checkbox" name="products[]" value="Pet Recovery Tag"> Pet Recovery Tag<br>
			    	    						<input type="checkbox" name="products[]" value="Passport Security Case"> Passport Security Case<br>
			    	    						<input type="checkbox" name="products[]" value="Passport Security Case(NFC)"> Passport Security Case(NFC)<br>
			    	    						<input type="checkbox" name="products[]" value="Bag Tags"> Bag Tags<br>
			    	    						<input type="checkbox" name="products[]" value="Key Tags"> Key Tags<br>
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
			</div>
		</div>

		<script>
function getState(val)
{
	document.getElementById('country_text').value = val.options[val.selectedIndex].text;
    x = val.options[val.selectedIndex].value;
	$.ajax({
		type:"POST",
		url:"states.php",
		data:'country_id='+x,
		success: function(data){
			$("#state").html(data);
		}
	});
}
</script>
</body>
</html>