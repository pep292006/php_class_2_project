<?php 
include("../config/db_con.php");
// $id = $_POST['id'];
// echo $id;
  $data = [
   'id' => $_POST['id'],
         "category_id" => $_POST['category_id'], 
         "title" => $_POST['title'],
         "description" => $_POST['description'],
         "file_name" => $_FILES['file']['name'],
         "file_tmp" => $_FILES['file']['tmp_name'],
         "file_type" => $_FILES['file']['type'],
         ];
         // echo "<pre>";
         // print_r($data);
         // echo "</pre>";
         // die();

     if(isset($_POST['post_update']) && isset($data))
           {
             $query = "UPDATE posts SET category_id = '$data[category_id]', title = '$data[title]',description = '$data[description]', file_name = '$data[file_name]' WHERE id = '$data[id]'";
             $result = mysqli_query($link, $query);
             if($result)
             {
              move_uploaded_file($data['file_tmp'], "post_photo/".$data['file_name']);
              header("location: ../admin/post_index.php");
             }  
             else
             {
              echo "Error: "  . $query . "<br>" . mysqli_error($link);
             }
           }