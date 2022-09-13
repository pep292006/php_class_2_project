<?php 
include("../config/db_con.php");
if(isset($_POST['create_category']))
{

 
 $category = $_POST['category_name'];
 echo $category;
 $query = "INSERT INTO categories(category_name) VALUES('$category')";
 $result = mysqli_query($link, $query);
 if($result)
 {
  //echo "<script>alert('Category Created Successfully')</script>";
  //echo "<script>window.open('category_index.php','_self')</script>";
  header("Location: ../admin/category_index.php");
 }else{
  echo "<script>alert('Category Not Created')</script>";
  echo "<script>window.open('category_index.php','_self')</script>";
 }
}