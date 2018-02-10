<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "tag8_local");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
//$company_id = mysqli_real_escape_string($link, $_REQUEST['company_id']);
$company_name = mysqli_real_escape_string($link, $_REQUEST['company_name']);
$name = mysqli_real_escape_string($link, $_REQUEST['name']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$contact_no = mysqli_real_escape_string($link, $_REQUEST['contact_no']);
$address = mysqli_real_escape_string($link, $_REQUEST['address']);
$country = mysqli_real_escape_string($link, $_REQUEST['country_text']);
$state = mysqli_real_escape_string($link, $_REQUEST['state']);
$city = mysqli_real_escape_string($link, $_REQUEST['city']);
$zipcode = mysqli_real_escape_string($link, $_REQUEST['zipcode']);
//$username = mysqli_real_escape_string($link, $_REQUEST['username']);
//$password = mysqli_real_escape_string($link, $_REQUEST['password']);
//$usertype = mysqli_real_escape_string($link, $_REQUEST['usertype']);
$products = $_REQUEST["products"];
 $b=implode(",",$products);
// attempt insert query execution
$sql = "INSERT INTO company (company_name,name,email,contact_no,address,country,state,city,zipcode,products) VALUES ('$company_name', '$name','$email','$contact_no','$address','$country','$state','$city','$zipcode','$b')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// close connection
mysqli_close($link);
//header("location:user_register.php");
?>