<?php 
    session_start();

// user login 
include("../config/db_con.php");

// login with md5 password 
if(isset($_POST['login'])){
  $email = $_POST['email'];
  $password =  md5($_POST['password']);
  $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_array($result);
  $count = mysqli_num_rows($result);
  if($count == 1){
    $_SESSION['id'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['phone'] = $row['phone'];
    $_SESSION['address'] = $row['address'];
    header("location: ../admin/profile.php");
  }else{
    header("location: ../login_form.php");
  }
  
}