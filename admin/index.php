<?php 
session_start();
include("../config/db_con.php");
include("function.php");
$auth = check();

include("includes/head.php"); ?>

<body class="sb-nav-fixed">

 <?php include("includes/top_navbar.php"); ?>

 <div id="layoutSidenav">
  <div id="layoutSidenav_nav">
   <?php include("includes/sidebar.php"); ?>
  </div>
  <div id="layoutSidenav_content">
   <main>
    <div class="container-fluid px-4">
     <h1 class="mt-4">Admin Dashboard</h1>
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
      </div>
     </div>
    </div>
   </main>
   <?php include("includes/footer.php"); ?>