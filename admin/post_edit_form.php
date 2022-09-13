<?php 
session_start();
include("function.php");
$auth = check();
$auth_id = $_SESSION['id'];

?>
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
     <h1 class="mt-4">Post Detail Dashboard


     </h1>
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
       $sql = "SELECT posts.*, users.username AS name, categories.category_name AS cat_name FROM posts LEFT JOIN users ON posts.user_id = users.id LEFT JOIN categories ON posts.category_id = categories.id WHERE posts.id = $id";
       $result = mysqli_query($link, $sql);
       $row = mysqli_fetch_assoc($result);

       // post update
      


       ?>
       <form action="../actions/post_update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="mb-3">
         <select name="category_id" class="form-select form-select-sm" aria-label=".form-select-sm example" name=""
          id="">
          <option value="<?= $row['id'] ?>"><?= $row['cat_name'] ?></option>
         </select>
        </div>
        <div class="mb-3">
         <label for="exampleInputEmail1" class="form-label">Post Title </label>
         <input type="text" name="title" class="form-control" id="exampleInputEmail1" value="<?= $row['title'] ?>">
        </div>

        <div class="mb-3">
         <label for="exampleInputEmail1" class="form-label">Post Description </label>
         <textarea name="description" class="form-control" id="" cols="30"
          rows="10"><?= $row['description'] ?></textarea>
        </div>
        <div class="mb-3">
         <img src="../actions/post_photo/<?= $row['file_name']?>" alt="" width="200px" height="200px">
        </div>
        <div class="input-group mb-3">

         <label class="input-group-text" for="inputGroupFile01">Upload</label>
         <input type="file" name="file" class="form-control" id="inputGroupFile01">
        </div>
        <div class="mb-3 mt-3">
         <button type="submit" name="post_update" class="btn btn-primary">Update Post</button>
        </div>
       </form>
      </div>
     </div>
    </div>
   </main>
   <?php include("includes/footer.php"); ?>