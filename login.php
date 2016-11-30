<?php
session_start();
require_once("connection.php");

if( $_GET['action'] == 'success' ) {
    echo "<script>alert ('you are successfully registered. you can now log in') </script>";
    }

if( $_GET['action'] == 'loggedin' ) {
    echo "<script>alert ('Incorrect email or password. Please Try again') </script>";
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h2>this is the log in page</h2>
<h1>sign up</h1>
      <form action="process.php" method="post">
          <input type="text" name="first_name" placeholder="first name">
          <input  type="text" name="last_name" placeholder="last name">
          <input type="text" name="email" placeholder="email">
          <input type="password" name="password" placeholder="password">
          <input type="hidden" name="source" value="register">
          <input type="submit" value="Register">
      </form>
    <hr>
        <h1>Log In</h1>
      <form action="process.php" method="post">
          <input type="text" name="email" placeholder="email">
          <input type="password" name="password" placeholder="password">
          <input type="hidden" name="source" value="login">
          <input type="submit" value="LogIn">
      </form>
</body>
</html>