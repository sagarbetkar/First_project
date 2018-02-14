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
echo"$id";
echo "$cid";
/*if(empty($_SESSION)) // if the session not yet started 
   session_start();

if(!isset($_SESSION['username'])) { //if not yet logged in
   header("Location: login.php");// send to login page
   exit;
} */

//include('../connect.php');

if($_SESSION['usertype']=="Admin" &&  $_SESSION['c_id'])
{

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details</title>
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
    <div class="container">
         <div class="panel panel-default">
            <div class="panel-heading">List Of Agents</div>
            <div class="panel-body">
               <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Agent Code</th>
                <th>Agent Name</th>
                <th>Ship Company</th>
                <!--<th>Bill Company</th>-->
                <th>Email ID</th>
                <th>Contact No</th>
                <th>Shipping Address</th>
                <th>Billing Address</th>
                <th>Action</th>
            </tr>
            </thead>
        </table> 
            </div>
        </div> 

        <!--create modal dialog for display detail info for edit on button cell click-->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div id="content-data"></div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
            var dataTable=$('#example').DataTable({
                "processing": true,
                "serverSide":true,
                "ajax":{
                    url:"fetch.php",
                    type:"post"
                }
            });
        });
    </script>
    <!--script js for get edit data-->
    <script>
        $(document).on('click','#getEdit',function(e){
            e.preventDefault();
            var per_id=$(this).data('id');
            //alert(per_id);
            $('#content-data').html('');
            $.ajax({
                url:'editdata.php',
                type:'POST',
                data:'id='+per_id,
                dataType:'html'
            }).done(function(data){
                $('#content-data').html('');
                $('#content-data').html(data);
            }).fial(function(){
                $('#content-data').html('<p>Error</p>');
            });
        });
    </script>
</body>
</html>

<?php
$con=mysqli_connect('localhost','root','','tag8_local');
if(isset($_POST['btnEdit'])){
    $new_id=mysqli_real_escape_string($con,$_POST['txtid']);
    $new_agentcode=mysqli_real_escape_string($con,$_POST['agentcode']);
    $new_agentname=mysqli_real_escape_string($con,$_POST['agentname']);
    $new_ship_company_name=mysqli_real_escape_string($con,$_POST['ship_company_name']);
    $new_bill_company_name=mysqli_real_escape_string($con,$_POST['bill_company_name']);
    $new_emailid=mysqli_real_escape_string($con,$_POST['emailid']);
    $new_contactno=mysqli_real_escape_string($con,$_POST['contactno']);
    $new_shippingaddress=mysqli_real_escape_string($con,$_POST['shippingaddress']);
    $new_billingaddress=mysqli_real_escape_string($con,$_POST['billingaddress']);
    
    $sqlupdate="UPDATE agent_details SET agent_code='$new_agentcode',
                agent_name='$new_agentname',ship_company_name='$new_ship_company_name',bill_company_name='$new_bill_company_name',agent_emailid='$new_emailid',
                contact_no='$new_contactno',shipping_address1='$new_shippingaddress',billing_address1='$new_billingaddress'
                WHERE id='$new_id'";
    $result_update=mysqli_query($con,$sqlupdate);
    if($result_update){
        echo '<script>window.location.href="details1.php"</script>';
    }
    else{
        echo '<script>alert("Update Failed")</script>';
    }
}
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $sqldelete="DELETE FROM agent_details WHERE id='$id'";
    $result_delete=mysqli_query($con,$sqldelete);
    if($result_delete){
        echo'<script>window.location.href="details1.php"</script>';
    }
    else{
        echo'<script>alert("Delete Failed")</script>';
    }
}
?>
<?php
}
if($_SESSION['usertype']=="User" && $_SESSION['id'] && $_SESSION['c_id'])
{

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details</title>
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
    <div class="container">
         <div class="panel panel-default">
            <div class="panel-heading">List Of Agents</div>
            <div class="panel-body">
               <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Agent Code</th>
                <th>Agent Name</th>
                <th>Ship Company</th>
                <!--<th>Bill Company</th>-->
                <th>Email ID</th>
                <th>Contact No</th>
                <th>Shipping Address</th>
                <th>Billing Address</th>
                <th>Action</th>
            </tr>
            </thead>
        </table> 
            </div>
        </div> 

        <!--create modal dialog for display detail info for edit on button cell click-->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div id="content-data"></div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
            var dataTable=$('#example').DataTable({
                "processing": true,
                "serverSide":true,
                "ajax":{
                    url:"fetch.php",
                    type:"post"
                }
            });
        });
    </script>
    <!--script js for get edit data-->
    <script>
        $(document).on('click','#getEdit',function(e){
            e.preventDefault();
            var per_id=$(this).data('id');
            //alert(per_id);
            $('#content-data').html('');
            $.ajax({
                url:'editdata.php',
                type:'POST',
                data:'id='+per_id,
                dataType:'html'
            }).done(function(data){
                $('#content-data').html('');
                $('#content-data').html(data);
            }).fial(function(){
                $('#content-data').html('<p>Error</p>');
            });
        });
    </script>
</body>
</html>

<?php
$con=mysqli_connect('localhost','root','','tag8_local');
if(isset($_POST['btnEdit'])){
    $new_id=mysqli_real_escape_string($con,$_POST['txtid']);
    $new_agentcode=mysqli_real_escape_string($con,$_POST['agentcode']);
    $new_agentname=mysqli_real_escape_string($con,$_POST['agentname']);
    $new_ship_company_name=mysqli_real_escape_string($con,$_POST['ship_company_name']);
    $new_bill_company_name=mysqli_real_escape_string($con,$_POST['bill_company_name']);
    $new_emailid=mysqli_real_escape_string($con,$_POST['emailid']);
    $new_contactno=mysqli_real_escape_string($con,$_POST['contactno']);
    $new_shippingaddress=mysqli_real_escape_string($con,$_POST['shippingaddress']);
    $new_billingaddress=mysqli_real_escape_string($con,$_POST['billingaddress']);
    
    $sqlupdate="UPDATE agent_details SET agent_code='$new_agentcode',
                agent_name='$new_agentname',ship_company_name='$new_ship_company_name',bill_company_name='$new_bill_company_name',agent_emailid='$new_emailid',
                contact_no='$new_contactno',shipping_address1='$new_shippingaddress',billing_address1='$new_billingaddress'
                WHERE id='$new_id'";
    $result_update=mysqli_query($con,$sqlupdate);
    if($result_update){
        echo '<script>window.location.href="details1.php"</script>';
    }
    else{
        echo '<script>alert("Update Failed")</script>';
    }
}
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $sqldelete="DELETE FROM agent_details WHERE id='$id'";
    $result_delete=mysqli_query($con,$sqldelete);
    if($result_delete){
        echo'<script>window.location.href="details1.php"</script>';
    }
    else{
        echo'<script>alert("Delete Failed")</script>';
    }
}
?>
<?php
}
?>