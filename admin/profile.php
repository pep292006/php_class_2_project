<?php session_start();
include("function.php");
$auth = check();

// user detail
$user_id = $_SESSION['id'];
$user_name = $_SESSION['username'];
$user_email = $_SESSION['email'];
$user_phone = $_SESSION['phone'];
$user_address = $_SESSION['address'];
$user_photo = $_SESSION['photo'];

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
     <h1 class="mt-4">Profile Dashboard <span>
       <h2><?php //echo $user_id; ?></h2>
      </span></h1>
     <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active"><?php echo $auth; ?></li>
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
       <table class="table">
        <tr>
         <th>Username</th>
         <td><?php echo $user_name; ?></td>
        </tr>
        <tr>
         <th>Email</th>
         <td><?php echo $user_email; ?></td>
        </tr>
        <tr>
         <th>Phone</th>
         <td><?php echo $user_phone; ?></td>
        </tr>
        <tr>
         <th>Address</th>
         <td><?php echo $user_address; ?></td>
        </tr>
       </table>
       <card class="mb-4">
        <?php 
        include("../config/db_con.php");
        // get profile image from the database
        $id = $user_id;
        $query = $link->query("SELECT * FROM users WHERE id = $id");
        $row = $query->fetch_assoc();
        ?>
        <div class="profile">
         <div class="avatar">
          <img src="../actions/images/<?php echo $row['photo']; ?>" class="img-raised rounded-circle img-fluid"
           width="200px" height="200px" alt="">
         </div>
        </div>
       </card>
       <div class="row">
        <div class="col-lg-6">
         <div class="card mb-4">
          <div class="col-lg-4">
           <div class="card-body">
            <form action="../actions/profile_update.php" method="post" enctype="multipart/form-data">
             <input type="hidden" name="id" id="id" value="<?php echo $user_id; ?>">
             <div class="form-group">
              <label for="photo">Profile Photo</label>
              <input type="file" name="photo" id="photo" class="form-control">
             </div>
             <div class="form-group mt-3">
              <input type="submit" name="update" id="update" value="Update Profile" class="btn btn-outline-primary">
             </div>
            </form>
           </div>
          </div>
         </div>
        </div>
        <div class="col-lg-4">
         <div class="card">
          <div class="card-header">
           <h1>User Password Update</h1>
          </div>
          <div class="card-body">
           <form action="../actions/pw_update.php" method="post">
            <input type="hidden" name="id" value="<?= $user_id ?>">
            <div class="mb-3">
             <label for="email">Email</label>
             <input type="email" name="email" id="email" class="form-control" value="<?= $user_email?>">
            </div>
            <div class="mb-3">
             <label for="password">Password</label>
             <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="mb-3">
             <input type="submit" name="pwupdate" value="Password Update" class="btn btn-outline-primary">
            </div>
           </form>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </main>
   <?php include("includes/footer.php"); ?>