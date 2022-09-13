<?php 
// delete_comment
include("../config/db_con.php");
// delete comment
if(isset($_POST['delete_comment'])) 
{
 $id = $_POST['id'];
 $image_id = $_POST['image_id'];
 $link->query("DELETE FROM gallery_comments WHERE id = '$id'");
 header("location: ../image_detail.php?id=$image_id");
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