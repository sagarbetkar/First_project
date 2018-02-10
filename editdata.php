<?php
/**
 for display full info. and edit data
 */
// start again
$con=mysqli_connect('localhost','root','','sagar');  // this one in error
if(isset($_REQUEST['id'])){
    $id=intval($_REQUEST['id']);
    $sql="select * from agent_details WHERE id=$id";
    $run_sql=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($run_sql)){
        $per_id=$row[0];
        $per_agentcode=$row[1];
        $per_agentname=$row[2];
        $per_companyname=$row[3];
		$per_emailid=$row[4];
		$per_contactno=$row[5];
		$per_shippingaddress=$row[6];
		$per_billingaddress=$row[7];
		
    }//end while
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/app.css"> 
</head>
<body>
<form class="form-horizontal" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Information</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="txtid">ID</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="txtid" name="txtid" value="<?php echo $per_id;?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="agentcode">Agent Code</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="agentcode" name="agentcode" value="<?php echo $per_agentcode;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="agentname">Agent Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="agentname" name="agentname" value="<?php echo $per_agentname;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="companyname">Company</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="companyname" name="companyname" value="<?php echo $per_companyname;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="emailid">Email ID</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="emailid" name="emailid" value="<?php echo $per_emailid;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="contactno">Contact No</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="contactno" name="contactno" value="<?php echo $per_contactno ;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="shippingaddress">Shipping Address</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="shippingaddress" name="shippingaddress" value="<?php echo $per_shippingaddress;?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="billingaddress">Billing Address</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="billingaddress" name="billingaddress" value="<?php echo $per_billingaddress;?>">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <<div class="modal-footer">
                <a href="index.php"><button type="button" class="btn btn-danger">Cancel</button> </a>
                <button type="submit" class="btn btn-primary" name="btnEdit">Save</button>
            </div>
        </div>
    </form>
</body>
</html>
    
<?php
}//end if
?>









