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
     <h1 class="mt-4">User List Dashboard</h1>
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
       <table id="datatablesSimple">
        <thead>
         <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Start date</th>
          <th>Action</th>
         </tr>
        </thead>
        <tfoot>
         <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Start date</th>
          <th>Action</th>
         </tr>
        </tfoot>
        <tbody>

        </tbody>
       </table>
      </div>
     </div>
    </div>
   </main>
   <?php include("includes/footer.php"); ?>