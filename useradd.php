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
$first_name = mysqli_real_escape_string($link, $_REQUEST['first_name']);
$last_name = mysqli_real_escape_string($link, $_REQUEST['last_name']);
$contact_no = mysqli_escape_string($link, $_REQUEST['contact_no']);
$emailid = mysqli_escape_string($link, $_REQUEST['emailid']);
$usertype = mysqli_real_escape_string($link, $_REQUEST['usertype']);
$username = mysqli_real_escape_string($link, $_REQUEST['username']);
$password = mysqli_real_escape_string($link, $_REQUEST['password']);
$status = mysqli_escape_string($link, $_REQUEST['status']);

// attempt insert query execution
$sql = "INSERT INTO user (first_name,last_name,contact_no,email,usertype,username,password,status) VALUES ('$first_name','$last_name','$contact_no','$emailid','$usertype','$username','$password','$status')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// close connection
mysqli_close($link);
?>