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
    <?php 
    include("config/db_con.php");
    // images details from the database
    $id = $_GET['id'];
    $deatil = $link->query("SELECT * FROM images WHERE id = '$id'");
    $row = $deatil->fetch_assoc();
    
    ?>
    <!-- Featured blog post-->
    <div class="card mb-4">
     <?php //echo "<h1>" . $user_id."</h1>"; ?>
     <a href="#!"><img class="card-img-top" src="actions/images/<?php echo $row['file_name']; ?>" alt="..." /></a>
     <div class="card-body">
      <div class="small text-muted"><?php echo $row['created_at'] ?></div>
      <h2 class="card-title">Posted By : <?php echo $auth ?></h2>
      <p class="card-text"><?php echo $row['description'] ?></p>
      <a class="btn btn-primary" href="index.php">Back →</a>
     </div>
    </div>
    <section class="mb-5">
     <div class="card bg-light">
      <div class="card-body">
       <?php 
        $id = $_GET['id'];
        ?>
       <!-- Comment form-->
       <form class="mb-4" action="actions/gallery_comment.php" method="post">
        <textarea name="comment" class="form-control" rows="3" placeholder="Join the discussion and leave a comment!">
        </textarea>
        <input type="hidden" name="image_id" value="<?php echo $id; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

        <div class="mb-3">
         <input type="submit" name="gallery_comment" class="btn btn-outline-primary" value="Submit">
        </div>
       </form>
       <!-- Comment with nested comments-->
       <!-- Single comment-->
       <?php 
      $sql= "SELECT gallery_comments.*, users.username AS name FROM gallery_comments LEFT JOIN users ON gallery_comments.user_id = users.id Where gallery_comments.image_id = '$id' ORDER BY gallery_comments.id DESC";
      $result = $link->query($sql);
      if($result->num_rows > 0) :
        while($row = $result->fetch_assoc()) :
          ?>
       <div class="d-flex">
        <?php
        // image link url random
        //$id = $user_id;
        $id = $row['user_id'];
        $deatil = $link->query("SELECT * FROM users WHERE id = '$id'");
        $profile = $deatil->fetch_assoc();
        
        ?>
        <div class="flex-shrink-0"><img class="rounded-circle" src="actions/images/<?php if ($row['user_id'] == $user_id) {
            echo $profile['photo'];
          } ?>" alt="..." width="50px" height="50px" /></div>
        <div class="ms-3">
         <div class="fw-bold"><?php echo $row['name'] ?></div>
         <p><?php echo $row['comment'] ?></p>
         <div class="text-muted">

         
          <!-- delete comment link -->
          <?php if($row['user_id'] == $user_id) : ?>
          <form action="actions/delete_comment.php" method="post">
           <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
           <input type="hidden" name="image_id" value="<?php echo $row['image_id']; ?>">
           <?php echo date("F j, Y", strtotime($row['created_at'])); ?>
           <button type="submit" name="delete_comment" class="btn btn-outline-danger md-5 ms-3 px-2"><i class="fa-solid fa-trash"></i></button>
          </form>
          
          <?php endif; ?>
           
          <?php 
          /*
          <a href="actions/delete_comment.php?id=<?php echo $row['id'] ?>&image_id=<?php echo $id ?>"
          class="btn btn-outline-danger ms-3 px-2"><i class="fa-solid fa-trash"></i></a>
          <?php endif; ?>
          */
          ?>
         </div>
        </div>
       </div>
       <?php endwhile; ?>
       <?php endif; ?>
      </div>
     </div>
    </section>
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