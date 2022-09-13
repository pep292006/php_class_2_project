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
    <div class="clearfix">
     <?php 
            include("config/db_con.php");
            // pagination query 
            $query = $link->query("SELECT * FROM images");
            // number of rows
            $num_rows = $query->num_rows;
            // number of rows per page
            $num_per_page = 5;
            // number of pages
            $num_pages = ceil($num_rows / $num_per_page);   
            // get the current page or set a default
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }else{
                $page = 1;
            }

            // offset
            $offset = ($page - 1) * $num_per_page;
            // get the images from the database
            $query = $link->query("SELECT * FROM images ORDER BY created_at DESC LIMIT $offset, $num_per_page");
            ?>
     <?php if($query->num_rows > 0): ?>
     <?php while($row = $query->fetch_assoc()): ?>
     <div class="card mb-4">
      <a href="!#"><img class="card-img-top" src="actions/images/<?php echo $row['file_name']; ?>" alt="..." /></a>
      <div class="card-body">
       <div class="small text-muted">
        <?php echo date("F j, Y", strtotime($row['created_at'])); ?>
       </div>
       <p class="card-text"><?php echo substr($row['description'], 0, 100); ?></p>
       <a href="image_detail.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-primary">Read More</a>
      </div>
     </div>
     <?php endwhile; ?>
     <?php else: ?>
     <p>No image(s) found...</p>
     <?php endif; ?>
     <div class="text-center">
      <ul class="pagination justify-content-center mb-4">
       <li class="page-item disabled">
        <a href="#" class="page-link" tabindex="-1" aria-disabled="true">Newer</a>
       </li>
       <?php 
        for($i = 1; $i <= $num_pages; $i++){
           echo '<li class="page-item"><a class="page-link" href="index.php?page=' . $i . '">' . $i . '</a></li>';        
        } 
        ?>
       <li class="page-item">
        <a href="#" class="page-link">Older</a>
       </li>
      </ul>
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