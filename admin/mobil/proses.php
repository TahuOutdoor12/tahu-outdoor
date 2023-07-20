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
$title_web = 'Tambah Barang';
include '../header.php';
if (empty($_SESSION['USER'])) {
    session_start();
}

if ($_GET['aksi'] == 'tambah') {
    
    $dir = '../../assets/image/';
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $temp = explode(".", $_FILES["gambar"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $target_path = $dir . basename($newfilename);
    $allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );

    if ($_FILES['gambar']["error"] > 0) {
        echo '<script>alert("Error file");history.go(-1)</script>';
        exit();
    } elseif (!in_array($_FILES['gambar']["type"], $allowedImageType)) {
        echo '<script>alert("You can only upload JPG, PNG and GIF file");window.location="tambah.php"</script>';
        exit();
    } elseif (round($_FILES['gambar']["size"] / 1024) > 4096) {
        echo '<script>alert("WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB !");window.location="tambah.php"</script>';
        exit();
    } else {
        if (move_uploaded_file($tmp_name, $target_path)) {
            $data[] = $_POST['nama_barang'];
            $data[] = $_POST['harga'];
            $data[] = $_POST['deskripsi'];
            $data[] = $_POST['status'];
            $data[] = $newfilename;

            // var_dump($data);

            $sql = "INSERT INTO `barang`(`merk`, `harga`, `deskripsi`, `status`, `gambar`) 
                VALUES (?,?,?,?,?)";
            $row = $koneksi->prepare($sql);
            $row->execute($data);
            echo '<script>alert("sukses");window.location="barang.php"</script>';
        } else {
            echo '<script>alert("Harap Upload Gambar !");window.location="tambah.php"</script>';
        }
    }
}

if ($_GET['aksi'] == 'edit') {
    $dir = '../../assets/image/';
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $temp = explode(".", $_FILES["gambar"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $target_path = $dir . basename($newfilename);
    $allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );

    $gambar = $_POST['gambar_cek'];
    
    $id = $_GET['id'];
    
    
    // $data[] = $_POST['merk'];
    $merk = $_POST['merk'];
    // $data[] = $_POST['harga'];
    $harga = $_POST['harga'];
    // $data[] = $_POST['deskripsi'];
    $deskripsi = $_POST['deskripsi'];
    // $data[] = $_POST['status'];
    $status = $_POST['status'];
    if ($_FILES['gambar']["size"] > 0) {
        if ($_FILES['gambar']["error"] > 0) {
            echo '<script>alert("Error file");history.go(-1)</script>';
            exit();
        } elseif (!in_array($_FILES['gambar']["type"], $allowedImageType)) {
            echo '<script>alert("You can only upload JPG, PNG and GIF file");history.go(-1)</script>';
            exit();
        } elseif (round($_FILES['gambar']["size"] / 1024) > 4096) {
            echo '<script>alert("WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB !");history.go(-1)</script>';
            exit();
        } else {
            if (move_uploaded_file($tmp_name, $target_path)) {
                if (file_exists('../../assets/image/'.$gambar)) {
                    unlink('../../assets/image/'.$gambar);
                }
                // $data[] = $newfilename;
                $saved_image = $newfilename;
            } else {
                echo '<script>alert("Error file");history.go(-1)</script>';
                exit();
            }
        }
    } else {
        // $data[] = $_POST['gambar_cek'];
        $saved_image = $_POST['gambar_cek'];
    }
    // $data[] = $id;
    
    $sql = "UPDATE barang SET `merk`='$merk', `harga`='$harga', `deskripsi`='$deskripsi', `status`='$status', `gambar`='$saved_image' WHERE `id_barang`='$id'";
    // var_dump($sql); 
    mysqli_query(mysqli_connect('localhost', 'root', '', 'rental_tahu_outdooor'), $sql);
    echo '<script>alert("sukses");window.location="barang.php"</script>';

    // $row = $koneksi->prepare($sql);
    // $row->execute($data);

}


if (!empty($_GET['aksi'] == 'hapus')) {
    $id = $_GET['id'];
    $gambar = $_GET['gambar'];

    unlink('../../assets/image/'.$gambar);

    $sql = "DELETE FROM barang WHERE id_barang = ?";
    $row = $koneksi->prepare($sql);
    $row->execute(array($id));

    echo '<script>alert("sukses hapus");window.location="barang.php"</script>';
}
