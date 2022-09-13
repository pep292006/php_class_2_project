<?php 
include("../config/db_con.php");

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
     <h1 class="mt-4">Category Dashboard</h1>
     <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Dashboard</li>
     </ol>
     <?php //include("includes/top_card.php") ?>
     <?php //include("includes/chart.php"); ?>
     <div class="card mb-4">
      <div class="card-header">
       <i class="fas fa-table me-1"></i>
       Category DataTable <span class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> + Add
        Category</span>
      </div>
      <div class="card-body">
       <!-- add to datatable -->
       <table id="datatablesSimple">
        <tr>
         <th>ID</th>
         <th>Category_Name</th>
         <th>Created Date</th>
         <th>Action</th>
        </tr>
        <tbody>
         <?php 
         $category_query = "SELECT * FROM categories";
         $category_result = mysqli_query($link, $category_query);
         
         while($row = mysqli_fetch_assoc($category_result)) :
          ?>
         <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['category_name']; ?></td>
          <td><?php echo $row['created_at']; ?></td>
          <td>
           <a class="btn btn-primary" href="category_edit.php?id=<?php echo $row['id']; ?>">Edit</a>
           <a class="btn btn-danger" href="category_delete.php?id=<?php echo $row['id']; ?>">Delete</a>
          </td>
         </tr>
         <?php endwhile; ?>

        </tbody>
       </table>
      </div>
     </div>
     <!-- Button trigger modal -->
     <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Launch demo modal
     </button> -->

     <!-- Modal -->
     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
       <div class="modal-content">
        <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <form action="../actions/category_create.php" method="POST">
          <div class="mb-3">
           <label for="exampleInputEmail1" class="form-label">Category Name </label>
           <input type="text" name="category_name" class="form-control" id="exampleInputEmail1"
            placeholder="Enter Your Category Name">
          </div>

          <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           <input type="submit" class="btn btn-primary" name="create_category" value="Add Category">
          </div>
         </form>
        </div>

       </div>
      </div>
     </div>
    </div>
   </main>
   <?php include("includes/footer.php"); ?>