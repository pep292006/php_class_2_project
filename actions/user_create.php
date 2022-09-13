<?php 
include("../config/db_con.php");
// user create
if(isset($_POST['create'])){
  $username = mysqli_real_escape_string($link, $_POST['username']);
  $email = mysqli_real_escape_string($link, $_POST['email']);
  
  $password = mysqli_real_escape_string($link, md5($_POST['password']));

  $phone = mysqli_real_escape_string($link, $_POST['phone']);
  $address = mysqli_real_escape_string($link, $_POST['address']);

  $sql = "INSERT INTO users (username, email, password, phone, address) VALUES ('$username', '$email', '$password', '$phone', '$address')";
  if(mysqli_query($link, $sql)){
    header("Location: ../thankyou.php");
  } else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
  }
}