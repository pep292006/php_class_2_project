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
// Include the database configuration file
include ("config/db_con.php");

// Get images from the database
$query = $link->query("SELECT * FROM images ORDER BY created_at DESC");

?>
    <?php if($query->num_rows > 0): ?>
    <?php while($row = $query->fetch_assoc()): ?>
    <div class="card mb-4">
     <a href="#!"><img class="card-img-top" src="actions/images/<?php echo $row['file_name']; ?>" alt="..." /></a>
     <div class="card-body">
      <div class="small text-muted"><?php echo date("F j, Y", strtotime($row['created_at'])); ?></div>
      <!-- <h2 class="card-title">Featured Post Title</h2> -->
      <p class="card-text"><?php echo substr($row['description'], 0, 100); ?></p>
      <a class="btn btn-primary" href="image_detail.php?id=<?php echo $row['id']; ?>">Read more →</a>
     </div>
    </div>
    <?php endwhile; ?>
    <?php else: ?>
    <p>No image(s) found...</p>
    <?php endif; ?>
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
 <?php 
/*
<a href="#" class="card-post__author-avatar card-post__author-avatar--small"
        style="background-image: url('actions/images/<?php echo $row['file_name']; ?>');">Written by John Doe</a>
 <a class="text-fiord-blue" href="single-post.html"><?php echo $row['title']; ?></a>



 <?php if($query->num_rows > 0): ?>
 <?php while($row = $query->fetch_assoc()): ?>
 <div class="card card-small card-post card-post--1">
  <div class="card mb-4" style="background-image: url('actions/images/<?php echo $row['file_name']; ?>');">
   <a href="single-post.html" class="card-post__category badge badge-pill badge-primary">Travel</a>
   <div class="card-post__author d-flex">

    <div class="card-post__author-name">
     <a href="#">John Doe</a>
    </div>
   </div>
  </div>
  <div class="card-body">
   <h5 class="card-title">
   </h5>
   <p class="card-text d-inline-block mb-8"><?php echo $row['description']; ?></p>
   <span class="text-muted">
    <?php echo date("F j, Y", strtotime($row['created_at'])); ?>
   </span>
  </div>
 </div>
 <?php endwhile; ?>
 <?php else: ?>
 <p>No image(s) found...</p>
 <?php endif; ?>
 */

 ?>