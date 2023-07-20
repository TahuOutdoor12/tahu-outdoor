<?php
/*
  | Source Code Aplikasi Rental Tahu Outdoor PHP & MySQL
  | 
  | @package   : Rental Perlengkapan Outdoor
  | @file	   : Tahu Outdoor.php 
  | @author    : M Rizki Saepul Rohman
  | 
  | 
  | 
 */
 require '../../koneksi/koneksi.php';

if($_GET['id'] == 'konfirmasi')
{
    $data2[] = $_POST['status'];
    $data2[] = $_POST['id_barang'];
    $sql2 = "UPDATE `barang` SET `status`= ? WHERE id_barang= ?";
    $row2 = $koneksi->prepare($sql2);
    $row2->execute($data2);

    echo '<script>alert("Status Barang di pinjam");history.go(-1);</script>'; 
}