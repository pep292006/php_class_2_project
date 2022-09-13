<?php include("includes/head.php"); ?>

<body class="sb-nav-fixed">

 <?php include("includes/top_navbar.php"); ?>

 <div id="layoutSidenav">
  <div id="layoutSidenav_nav">
   <?php include("includes/sidebar.php"); ?>
  </div>
  <div id="layoutSidenav_content">
   <main>
    <div class="container-fluid px-4">
     <h1 class="mt-4">Post Detail Dashboard</h1>
     <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Dashboard</li>
     </ol>
     <?php //include("includes/top_card.php") ?>
     <?php //include("includes/chart.php"); ?>
     <div class="card mb-4">
      <div class="card-header">
       <i class="fas fa-table me-1"></i>
       DataTable Example
      </div>
      <div class="card-body">
       <!-- add to datatable -->
       <?php 
       include("../config/db_con.php");
       $id = $_GET['id'];
       //$sql = "SELECT * FROM posts WHERE id = $id";
        $sql = "SELECT posts.*, users.username AS name, categories.category_name AS cat_name FROM posts LEFT JOIN users ON posts.user_id = users.id LEFT JOIN categories ON posts.category_id = categories.id WHERE posts .id";
       $result = mysqli_query($link, $sql);
       $row = mysqli_fetch_assoc($result);

       ?>
       <table class="table">
        <tr>
         <th>ID</th>
         <td><?= $row['id'] ?></td>
        </tr>
        <tr>
         <th>user ID</th>
         <td><?= $row['name'] ?></td>
        </tr>
        <tr>
         <th>category ID</th>
         <td><?= $row['cat_name'] ?></td>
        </tr>
        <tr>
         <th>Title</th>
         <td><?= $row['title'] ?></td>
        </tr>
        <tr>
         <th>Post Description</th>
         <td><?= $row['description'] ?></td>
        </tr>
        <tr>
         <th>Post Image</th>
         <td>
          <img src="../actions/post_photo/<?= $row['file_name'] ?>" alt="" width="100px">
         </td>
        </tr>
       </table>
      </div>
     </div>
    </div>
   </main>
   <?php include("includes/footer.php"); ?>