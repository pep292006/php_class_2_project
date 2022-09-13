<?php
include("../config/db_con.php");
// delete image data
if(isset($_GET['id']))
{
$id = $_GET['id'];
$sql = "DELETE FROM images WHERE id = '$id'";
$result = mysqli_query($link, $sql);
if($result){
 header("Location: ../admin/image_index.php?success");
}else{
 header("Location: ../admin/image_index.php?error");

}
}