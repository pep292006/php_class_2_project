<?php
include("../config/db_con.php");

function PWUpdate($id, $password)
{
 $link = mysqli_connect("localhost", "root", "", "one_project_db");
 $sql = "UPDATE users SET password = '$password' WHERE id = '$id'";
 $result = mysqli_query($link, $sql);
 if($result){
  return true;
 }else{
  return false;
 }
}
// password update
if(isset($_POST['pwupdate'])){
 $id = $_POST['id'];
 $password = md5($_POST['password']);
 PWUpdate($id, $password);
 header("location: ../admin/profile.php");
}