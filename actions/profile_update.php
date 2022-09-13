<?php
include("../config/db_con.php");

function updateProfile($id, $photo)
{
 $link = mysqli_connect("localhost", "root", "", "one_project_db");
 $sql = "UPDATE users SET photo = '$photo' WHERE id = '$id'";
 $result = mysqli_query($link, $sql);
 if($result){
  return true;
 }else{
  return false;
 }
}
// profile update
if(isset($_POST['update'])){
 $id = $_POST['id'];
 $photo = $_FILES['photo']['name'];
 $photo_tmp = $_FILES['photo']['tmp_name'];
 move_uploaded_file($photo_tmp, "images/$photo");
 updateProfile($id, $photo);
 header("location: ../admin/profile.php");
}