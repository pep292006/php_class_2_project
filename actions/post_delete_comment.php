<?php 
// delete_comment
include("../config/db_con.php");
// delete comment
if(isset($_POST['delete'])) 
{
 $id = $_POST['id'];
 $post_id = $_POST['post_id'];
 $link->query("DELETE FROM comments WHERE id = '$id'");
 header("location: ../post_detail.php?id=$post_id");
}
/*
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $link->query("DELETE FROM gallery_comments WHERE id = '$id'");
    header("location: ../image_detail.php?id=$id"); 
}else{
    header("location: ../index.php");
}

*/
?>