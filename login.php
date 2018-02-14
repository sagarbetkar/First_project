<?php
session_start();
include ('db.php'); //connect the connection page
/*if(empty($_SESSION)) // if the session not yet started 
   session_start();*/


// if already login
 // send to home page
  

?>
<!DOCTYPE html>
<html>
<head>
  <title>LOGIN</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
      img{
        width: 100px;
        height: 50px;
      }
    </style>
</head>
<body>
  <form method="POST" action="login_proccess.php">
    <table>
      <tr>
        <td>User Type</td>
        <td>
          <select name="usertype">
          <option value="-1">Select User Type</option>
          <option value="Admin">Admin </option>
          <option value="User">User</option>          
          </select>
        </td>
      </tr>
      <tr>
        <td>Username</td>
        <td><input type="text" name="username" placeholder="username"></td>
      </tr>
      <tr>
        <td>Password</td>
        <td><input type="password" name="pwd" placeholder="password">
          <input type="hidden" name="id">

        </td>

      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="submit" value="login"></td>
      </tr>
    </table>
  </form>
</body>
</html>

