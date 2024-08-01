<?php
include "config.php";
$nama=(isset($_POST['nama_menu'])) ? htmlentities($_POST['nama_menu']) : "";
$deskripsi=(isset($_POST['deskripsi'])) ? htmlentities($_POST['deskripsi']) : "";
$harga=(isset($_POST['harga'])) ? htmlentities($_POST['harga']) : "";
$kategori=(isset($_POST['kategori'])) ? htmlentities($_POST['kategori']) : "";
$status=(isset($_POST['status_menu'])) ? htmlentities($_POST['status_menu']) : "";

if (!empty($_POST['menu_validate'])){

        $query = mysqli_query($conn , "INSERT into menu (nama_menu, deskripsi, harga,kategori, status_menu) values
        ('$nama','$deskripsi','$harga','$kategori','$status')");
        if($query){
                $message = '<script>
                alert("Data Berhasil Dimasukan");
                window.location="../menu"
                </script>';
        }else{
                $message = '<script>
                alert("Data Gagal Dimasukan");
                window.location="../menu"
                </script>';
    
        }
    }
    

echo $message;
?>
