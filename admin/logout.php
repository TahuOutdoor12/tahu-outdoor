<?php
/*
  | Source Code Aplikasi Rental Tahu Outdoor PHP & MySQL
  | 
  | @@package   : Rental Perlengkapan Outdoor
  | @file	   : Tahu Outdoor.php 
  | @author    : M Rizki Saepul Rohman
  | 
  | 
  | 
 */
    session_start();
    session_destroy();

    echo '<script>alert("Anda Telah Logout");window.location="../index.php";</script>';
?>