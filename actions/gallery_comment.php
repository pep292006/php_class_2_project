<?php 
include("../config/db_con.php");
 // add data to the database

 if(isset($_POST['gallery_comment'])) 
 {
  $image_id = $_POST['image_id'];
  $user_id = $_POST['user_id'];
  $comment = $_POST['comment'];
  $created_at = date("Y-m-d H:i:s");

  // echo "<pre>";
  // print_r($_POST);
  // echo "</pre>";
  // die();
  $link->query("INSERT INTO gallery_comments (image_id, user_id, comment, created_at) VALUES ('$image_id', '$user_id', '$comment', '$created_at')");
  header("location: ../image_detail.php?id=$image_id");
 }