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
  </nav>s="container">
		<div class="main row">
			<div class="main-center">
			    <div class="panel panel-default">
			    	<div class="panel-heading">User Registration</div>
			    	<div class="panel-body">
			    	    <div class="panel panel-default">
			    	    	<div class="panel-heading">* All fields are mandatory</div>
			    	    	<div class="panel-body">
			    	    		<form class="form-horizontal" action="useradd.php" method="post">
			    	    		<div class="form-group">
			    	    			<label for="Company_name" class="col-sm-3 control-label">First Name</label>
			    	    			<div class="col-sm-6">
			    	    				<input type="text" name="first_name" id="first_name" class="form-control" value="" required>
			    	    			</div>
			    	    		</div>
			    	    		<div class="form-group">
			    	    			<label for="Name" class="col-sm-3 control-label">Last Name</label>
			    	    			<div class="col-sm-6">
			    	    				<input type="text" name="last_name" id="last_name" class="form-control" value="" required>
			    	    			</div>                 
			    	    		</div>			    	    		
			    	    		<div class="form-group">
			    	    			<label for="registration" class="col-sm-3 control-label">Contact No.</label>
			    	    			<div class="col-sm-6">
			    	    				<input type="tel" name="contact_no" maxlength="11" pattern="[789][0-9]{9}" required placeholder="10 Digit Mobile No." id="contact_no" class="form-control" value="">
			    	    			</div>
			    	    		</div>
								<div class="form-group">
			    	    			<label for="registration" class="col-sm-3 control-label">Email ID</label>
			    	    			<div class="col-sm-6">
			    	    				<input type="email" name="emailid" required placeholder="Enter your email" id="emailid" class="form-control" value="">
			    	    			</div>
			    	    		</div>
			    	    		<div class="form-group">
                                    <label for="registration" class="col-sm-3 control-label">Company</label>
                                    <div class="col-sm-6">
                                        <select name="company_name" class="form-control">
                                			<option value=''>Select Company</option>
                                
                                <?php 
                                $res=mysqli_query($con,"select * from company");
                                while($row=mysqli_fetch_array($res))
                                {
                                    ?>
                                    <option value="<?php echo $row["id"]; ?>"><?php echo $row["company_name"]; ?></option>

                                    <?php
                                }
                                
                                ?>

                                		</select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="User Type" class="col-sm-3 control-label">User Type</label>
                                    <div class="col-sm-6">
                                        <select name="usertype" id="usertype" class="form-control">
                                			<option value=''>Select User</option>                               
                                			<option>Admin</option>
                                			<option>User</option>                              
                           				</select>
                                    </div>
                                </div>
			    	    		<div class="form-group">
			    	    			<label for="username" class="col-sm-3 control-label">Username</label>
			    	    			<div class="col-sm-6">
			    	    				<input type="text" name="username" id="username" class="form-control" value="" required>
			    	    			</div>
			    	    		</div>
			    	    		<div class="form-group">
			    	    			<label for="password" class="col-sm-3 control-label">Password</label>
			    	    			<div class="col-sm-6">
			    	    				<input type="password" name="password" id="password" class="form-control" value="" required>
			    	    			</div>
			    	    		</div>
			    	    		<div class="form-group">
			    	    			<label for="address" class="col-sm-3 control-label">Status</label>
			    	    			<div class="col-sm-6">
			    	    				<select name="status" id="status" class="form-control">
											<option value=''>Select Status</option>
											<option>Active</option>
											<option>InActive</option>
											<!--<option>Delete</option>-->
										</select>
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
</body>
</html>