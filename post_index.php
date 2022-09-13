<?php 
include("layouts/head.php");
include("function.php");
?>

<body>
 <!-- Responsive navbar-->
 <?php include("layouts/navbar.php"); ?>
 <!-- Page header with logo and tagline-->
 <?php include("layouts/header.php"); ?>
 <!-- Page content-->
 <div class="container">
  <div class="row">
   <h1 class="text-center">Post index page</h1>
   <!-- Blog entries-->
   <div class="col-lg-8">
    <!-- Featured blog post-->
    <?php 
    include("config/db_con.php");
    $query = $link->query("SELECT posts.*, users.username AS name, categories.category_name AS cat_name FROM posts LEFT JOIN users ON posts.user_id = users.id LEFT JOIN categories ON posts.category_id = categories.id");
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

            $query = $link->query("SELECT posts.*, users.username AS name, categories.category_name AS cat_name FROM posts LEFT JOIN users ON posts.user_id = users.id LEFT JOIN categories ON posts.category_id = categories.id ORDER BY posts.created_at DESC LIMIT $offset, $num_per_page");
    ?>
    <?php if($query->num_rows > 0): ?>
    <?php while($row = $query->fetch_assoc()): ?>
    <div class="card mb-4">
     <a href="#!"><img class="card-img-top" src="actions/post_photo/<?php echo $row['file_name']; ?>" alt="..." /></a>
     <div class="card-body">
      <div class="small text-muted"><?php echo date("F j, Y", strtotime($row['created_at'])); ?> ||
       <?= time_Ago($row['created_at']); ?><span class="float-end">
        <h4>Posted by : <?= $row['name']; ?></h4>
       </span></div>
      <h6 class="card-title">Post Category : <?php echo $row['cat_name']; ?></h6>
      <h2 class="card-title">Post Title : <?= $row['title']; ?></h2>
      <p class="card-text"><?= $row['description']; ?></p>

      <a class="btn btn-primary" href="post_detail.php?id=<?= $row['id']; ?>">Read more →</a>
     </div>
    </div>
    <?php endwhile; endif; ?>
    <!-- Pagination-->
    <div class="text-center">
     <ul class="pagination justify-content-center mb-4">
      <li class="page-item disabled">
       <a href="#" class="page-link" tabindex="-1" aria-disabled="true">Newer</a>
      </li>
      <?php 
        // for($i = 1; $i <= $num_pages; $i++){
        //    echo '<li class="page-item">
        //    <a class="page-link" href="post_index.php?page=' . $i . '">' . $i . '</a>
        //    </li>';        
        // } 
        for($i = 1; $i <= $num_pages; $i++) :
        ?>
      <li class="page-item">
       <a class="page-link" href="post_index.php?page=<?= $i; ?>"><?= $i; ?></a>
      </li>

      <?php endfor; ?>
      <li class="page-item">
       <a href="#" class="page-link">Older</a>
      </li>
     </ul>
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