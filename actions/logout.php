<?php 
  session_start(); 
  session_unset();  //clear session data
  session_destroy(); 
  header("Location: ../index.php"); 
  exit; 
?> 