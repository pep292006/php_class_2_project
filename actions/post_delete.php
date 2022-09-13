<?php
include("../config/db_con.php");

$id = $_GET['id'];
// delete post from database by id
$sql = "DELETE FROM posts WHERE id = $id";
$result = mysqli_query($link, $sql);
if($result){
  header("Location: ../admin/post_index.php");
}else{
  echo "Error: " . $sql . "<br>" . mysqli_error($link);
}