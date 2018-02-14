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
    $query="select username,password,usertype from user where username='$username' and password='$password' and usertype='$usertype'";
    $result=mysqli_query($con,$query);
    while ($row=mysqli_fetch_array($result)){
      if($row['username']==$username && $row['password']==$password && $row['usertype']=='Admin'){
        header("location: order_form.php");
      }
      elseif ($row['username']==$username && $row['password']==$password && $row['usertype']=='User') {
        header("location: order_form.php");
      }
    } 
    $sql="select id,c_id from user where username='$username' and password='$password' and usertype='$usertype'";  
    $res=mysqli_query($con,$sql);
    while($row=mysqli_fetch_assoc($res)){
      $id=$row['id'];
      $cid=$row['c_id'];

    }

}


//if(isset($_POST['submit']))
/*$query="select id,cid from user";
$result=mysqli_query($mysqli,$query);
while($row=mysqli_fetch_assoc($result))
        {
          $id=$row['id'];
          $cid=$row['cid'];
        }
*/       
if(isset($_POST['usertype']))
{
  session_start();
  $_SESSION['usertype']=$_POST['usertype'];
  $_SESSION['id']=$id;
  $_SESSION['c_id']=$cid;

}
?>