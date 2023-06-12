<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : Rental Perlengkapan Outdoor
  | @file	   : Tahu Outdoor.php 
  | @author    : M Rizki Saepul Rohman
  | 
  | 
  | 
 */ 
    $user = 'root';
    $pass = '';

    $koneksi = new PDO("mysql:host=localhost;dbname=codekop_free_rental_mobil", $user, $pass);

    global $url;
    $url = "http://localhost/aku/";

    $sql_web = "SELECT * FROM infoweb WHERE id = 1";
    $row_web = $koneksi->prepare($sql_web);
    $row_web->execute();
    global $info_web;
    $info_web = $row_web->fetch(PDO::FETCH_OBJ);

    error_reporting(0);
?>