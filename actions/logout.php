<?php 
// user logout
include("../config/db_con.php");
session_start();
session_destroy();
header("location: ../login_form.php");