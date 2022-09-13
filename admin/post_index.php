<?php session_start();
include("function.php");
$auth = check();
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
     <h1 class="mt-4">Post Dashboard</h1>
     <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Dashboard</li>
     </ol>
     <?php //include("includes/top_card.php") ?>
     <?php //include("includes/chart.php"); ?>
     <div class="card mb-4">
      <div class="card-header">
       <i class="fas fa-table me-1"></i>
       Post List <span><a href="" class="btn btn-outline-primary" data-bs-toggle="modal"
         data-bs-target="#exampleModal">Post Create</a></span>
      </div>
      <div class="card-body">
       <!-- add to datatable -->
       <table id="datatablesSimple">
        <thead>
         <tr>
          <th>ID</th>
          <th>User</th>
          <th>Category</th>
          <th>Title</th>
          <th>Description</th>
          <th>Image</th>
          <th>Action</th>
         </tr>
        </thead>
        <tbody>
         <?php
          include("../config/db_con.php");
          // get all post
          $sql = "SELECT posts.*, users.username AS name, categories.category_name AS cat_name FROM posts LEFT JOIN users ON posts.user_id = users.id LEFT JOIN categories ON posts.category_id = categories.id";
          $result = mysqli_query($link, $sql);
          while($row = mysqli_fetch_assoc($result)) :
          ?>
         <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['name'] ?></td>
          <td><?= $row['cat_name'] ?></td>
          <td><?= $row['title'] ?></td>
          <td><?= substr($row['description'],0,20) ?></td>
          <td><img src="../actions/post_photo/<?= $row['file_name'] ?>" alt="" width="50px"></td>
          <td><a href="post_edit_form.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary"><i
             class="fa-solid fa-pen-to-square"></i></a>
           <a href="post_detail.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary"><i
             class="fa-solid fa-eye"></i></a>
           <a href="../actions/post_delete.php?id=<?= $row['id'] ?>" class="btn btn-outline-danger"><i
             class="fa-solid fa-trash"></i></a>
          </td>
         </tr>
         <?php endwhile; ?>
        </tbody>
       </table>
      </div>
     </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
      <div class="modal-content">
       <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Post Create</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
        <form action="../actions/post_create.php" method="POST" enctype="multipart/form-data">
         <input type="hidden" value="">
         <div class="mb-3">
          <select name="category_id" class="form-select form-select-sm" aria-label=".form-select-sm example" name=""
           id="">
           <option value="">Select Category</option>
           <?php 
            include("../config/db_con.php");
            // get all categories data from database
            $sql = "SELECT * FROM categories";
            $result = mysqli_query($link, $sql);
            while($row = mysqli_fetch_assoc($result)){
              $id = $row['id'];
              $name = $row['category_name'];
              echo "<option value='$id'>$name</option>";
            }
            /*
            while($row = mysqli_fetch_assoc($result)) :
            ?>
           <option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
           <?php endwhile; ?>
           <?php
           while($row = mysqli_fetch_assoc($result)) {
           ?>
           <option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>

           <?php
            }
            ?>
           */

           ?>
          </select>
         </div>
         <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Post Title </label>
          <input type="text" name="title" class="form-control" id="exampleInputEmail1"
           placeholder="Enter Your Post Title">
         </div>

         <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Post Description </label>
          <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
         </div>
         <div class="input-group mb-3">
          <label class="input-group-text" for="inputGroupFile01">Upload</label>
          <input type="file" name="file" class="form-control" id="inputGroupFile01">
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" name="create_post" value="Add Post">
         </div>
        </form>
       </div>

      </div>
     </div>
    </div>
   </main>
   <?php include("includes/footer.php"); ?>