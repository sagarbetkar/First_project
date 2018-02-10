<?php
include('db.php'); 

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
   
$in_ch=mysqli_query($con,"update order_details set invoice='$path',file_name='$upload_file',dispatch_status='dispatch' where id='$value'");  
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