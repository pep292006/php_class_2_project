<?php 
session_start();
include("function.php");
$auth = check();

// user detail
$user_id = $_SESSION['id'];
$user_name = $_SESSION['username'];
$user_email = $_SESSION['email'];
$user_phone = $_SESSION['phone'];
$user_address = $_SESSION['address'];
$id = $_GET['id'];
 ?>
<?php 
include("layouts/head.php");
?>

<body>
 <!-- Responsive navbar-->
 <?php include("layouts/navbar.php"); ?>
 <!-- Page header with logo and tagline-->
 <?php include("layouts/header.php"); ?>
 <!-- Page content-->
 <div class="container">
  <div class="row">
   <!-- Blog entries-->
   <div class="col-lg-8">
    <!-- Featured blog post-->
    <?php 
       include("config/db_con.php");
       $id = $_GET['id'];
       //$sql = "SELECT * FROM posts WHERE id = $id";
       $sql = "SELECT posts.*, users.username AS name, categories.category_name AS cat_name FROM posts LEFT JOIN users ON posts.user_id = users.id LEFT JOIN categories ON posts.category_id = categories.id WHERE posts.id = $id";
       $result = mysqli_query($link, $sql); 
       $row = mysqli_fetch_assoc($result);

       ?>
    <div class="card mb-4">
     <a href="#!"><img class="card-img-top" src="actions/post_photo/<?= $row['file_name'] ?>" alt="..." width="850px"
       height="350px" /></a>
     <div class="card-body">
      <div class="small text-muted"><?= $row['created_at'] ?></div>
      <h2 class="card-title"><?= $row['title'] ?></h2>
      <p class="card-text"><?= $row['description'] ?></p>
      <a class="btn btn-primary" href="post_index.php">
       <- Back</a>
     </div>
    </div>
    <div class="row d-flex">
     <div class="col-md-12 col-lg-12">
      <div class="card shadow-0 border" style="background-color: #f0f2f5;">
       <div class="card-body p-4">
        <form action="actions/post_comment_create.php" method="POST">
         <div class="form-outline mb-4">
          <div class="row">
           <div class="col-lg-9">
            <input type="hidden" name="post_id" value="<?= $id ?>">
            <input type="hidden" name="user_id" value="<?= $user_id ?>">
            <input type="text" name="comment" id="addANote" class="form-control" placeholder="Type comment..." />
           </div>
           <div class="col-lg-3">
            <input type="submit" name="post_comment" class="btn btn-warning" value="Submit">
           </div>
          </div>
         </div>
        </form>
        <?php 
          $sql= "SELECT comments.*, users.username AS name FROM comments LEFT JOIN users ON comments.user_id = users.id Where comments.post_id = '$id' ORDER BY comments.id DESC";
      $result = $link->query($sql);
      if ($result->num_rows > 0) :
        while($row = $result->fetch_assoc()) :
          ?>
        <div class="card mb-4">
         <div class="card-body">

          <div class="d-flex justify-content-between">
           <?php
            // image link url random
            //$id = $user_id;
              $id = $row['user_id'];
             $deatil = $link->query("SELECT * FROM users WHERE id = '$id'");
            $profile = $deatil->fetch_assoc();
           //include("function.php");
        ?>
           <div class="d-flex flex-row align-items-center">
            <img src="actions/images/<?php if ($row['user_id'] == $user_id) {
            echo $profile['photo'];
          } ?>" alt="avatar" width="25" height="25" class="rounded-circle" />
            <p class="small mb-0 ms-2"><?= $row['name'] ?></p>
            <p class="small mb-0 ms-2"><?= time_Ago($row['created_at']) ?></p>

           </div>

           <p><?= $row['comment'] ?></p>
           <div class="d-flex flex-row align-items-center">
            <?php if($row['user_id'] == $user_id) : ?>
            <form action="actions/post_delete_comment.php" method="POST">
             <input type="hidden" name="id" value="<?= $row['id'] ?>">
             <input type="hidden" name="post_id" value="<?= $row['post_id'] ?>">
             <input type="submit" name="delete" class="btn btn-danger" value="Delete">
            </form>
            <?php endif; ?>
           </div>
          </div>
         </div>
        </div>
        <?php endwhile; endif; ?>
       </div>
      </div>
     </div>
    </div>
   </div>
   <!-- Side widgets-->
   <div class="col-lg-4">
    <!-- Search widget-->
    <?php include("layouts/search.php"); ?>
    <!-- Categories widget-->
    <?php include("layouts/category_sidebar.php"); ?>
    <!-- Side widget-->
    <?php include("layouts/side_widget.php"); ?>
   </div>
  </div>
 </div>
 <!-- Footer-->
 <?php include("layouts/footer.php"); ?>