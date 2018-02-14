<?php
include ('db.php');
session_start();
if(!isset($_SESSION['usertype']))
{
   header("location: login.php");

}
$name=$_SESSION['usertype'];
$id=$_SESSION['id'];
$cid=$_SESSION['c_id'];
$query="SELECT order_id FROM order_details WHERE c_id ='$cid' and dispatch_status='pending' ";
$que="SELECT * FROM invoice where c_id='$cid'";
$result=mysqli_query($con,$query);
$res=mysqli_query($con,$que);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/app.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
      .title-img
      {
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
        <div class="panel-heading">Invoice</div>
        <div class="panel-body">
          <table id="info" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>                
                <th>Invoice Id</th>
                <th>Invoice Name</th>
                <th>Date</th>
                <th>Order Id</th>
                <th>File Name</th>
                <th>Path</th>
                <th>Order Dispatch Status</th>
                <th>Order Invoice Status</th>
              </tr>
            </thead>
            <?php
            while($rows=mysqli_fetch_assoc($res))
            {
              $id1=$rows['order_id'];
              $o_id=$rows['id'];
              $name=$rows['name'];
              $date=$rows['date'];
              $file_name=$rows['file_name'];
              $path=$rows['path'];
            ?>
            <tr>
              <td><?php echo $o_id; ?></td>
              <td><?php echo $name; ?></td>
              <td><?php echo $date; ?></td>
              <td><?php echo $id1;?></td>
              <td><?php echo $file_name; ?></td>
              <td><button><a href="<?php echo $rows['path']; ?>" target="_blank" class="button">View</a></button></td>
              <td><select name="order_dropdown" class="form-control"><option value="">Select Order Status</option><option value="Pending">Pending</option><option value="Dispatched">Dispatched</option></select></td>
              <td><select name="invoice_dropdown" class="form-control"><option value="">Select Invoice Status</option><option value="Pending">Pending</option><option value="Invoice Raised">Invoice Raised</option><option value="Complete">Complete</option></select></td>
            </tr>
            <?php
          }
          ?>
          </table>
          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add New</button>
          <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload Invoice</h4>
        </div>
        <div class="modal-body">
          <div class="panel panel-default">
        <div class="panel-heading">Invoice</div>
        <div class="panel-body">
          <form action="" method="POST" enctype="multipart/form-data">
            <table id="invoice" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th></th>
                <th>Select Order ID</th>
                </tr>
              </thead>
  <?php
        while($row=mysqli_fetch_assoc($result))
        {
          $id2=$row['order_id'];
          

        ?>
   <tr>     
      <td><input type="checkbox" name="techno[]" value="<?php echo $id;?>"></td>
      <td><?php echo $id2;?></td>  
   </tr>  
   
   <?php 
}
   ?>
   
   </table> 
   <div class="container">
   <input id="input-7" name="pdf_file" type="file" class="file file-loading" accept="application/pdf" required></p>
          <!--<input type="hidden" name="abc" value="<?php //echo $id;?>"> -->
          <input type="text" name="invoice_name"  placeholder="Add Invoice Name">
          <input type="submit" name="sub" class="btn btn-info" value="Upload" />

        </div>
          </form>
          <?php

if(isset($_POST['sub']))  
{  $allow=array('pdf');
  $temp=explode(".",$_FILES['pdf_file']['name']);
  $extension=end($temp);
  $upload_file=$_FILES['pdf_file']['name'];
  $path="files1/invoice/".$upload_file;
  move_uploaded_file($_FILES['pdf_file']['tmp_name'],"files1/invoice/".$_FILES['pdf_file']['name']);
  //$a=$_POST['abc'];  //get the id of particular table row from database
//connection string 
//echo"$a" ;
$checkbox1=$_POST['techno']; 

$chk="";  
foreach($checkbox1 as $chk1)  // to get the checked items
   {  
      $chk .= $chk1.",";  
   }  
   //echo"$chk";
   //2nd foreach to insert in the checked items
   foreach ($checkbox1 as $key => $value) {
    # code...
   
$in_ch=mysqli_query($con,"update order_details set invoice='$path',file_name='$upload_file',dispatch_status='dispatch' where order_id='$value'");  
}
if($in_ch==1)  
   {  
      echo'<script>alert("Inserted Successfully")</script>';  
   }  
else  
   {  
      echo'<script>alert("Failed To Insert")</script>';  
   }  
} 
//header("Location:invoice.php");
//echo"$id"; 
?>
        </div>
    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
        </div>
  </div>
  </div>
<?php
if(isset($_POST['sub']))
{

  $checkbox1=$_POST['techno'];
  $exampleEncoded = json_encode($checkbox1);
  $invoice_name=$_POST['invoice_name'];
  $allow=array('pdf');
  $temp=explode(".",$_FILES['pdf_file']['name']);
  $extension=end($temp);
  $upload_file=$_FILES['pdf_file']['name'];
  $path="files1/invoice/".$upload_file;
  move_uploaded_file($_FILES['pdf_file']['tmp_name'],"files1/invoice/".$_FILES['pdf_file']['name']);
$sql = "INSERT INTO invoice (order_id,name,file_name,path,c_id,u_id) VALUES ('$exampleEncoded','$invoice_name','$upload_file','$path','$cid','$id')";
  var_dump($sql);
if(mysqli_query($con, $sql)){
   // echo "Records added successfully.";
} else{
    //echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

mysqli_close($con);
}
?> 

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">
    $('#invoice').DataTable({
      "paging":   false,
      "ordering":false,
      "info":false
    });
  </script>
  <script type="text/javascript">
    $('#info').DataTable();
  </script>
</body>
</html>