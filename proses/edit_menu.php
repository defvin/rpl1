<?php
include "config.php";
$id=(isset($_POST['id_menu'])) ? htmlentities($_POST['id_menu']) : "";
$nama=(isset($_POST['nama_menu'])) ? htmlentities($_POST['nama_menu']) : "";
$deskripsi=(isset($_POST['deskripsi'])) ? htmlentities($_POST['deskripsi']) : "";
$harga=(isset($_POST['harga'])) ? htmlentities($_POST['harga']) : "";
$kategori=(isset($_POST['kategori'])) ? htmlentities($_POST['kategori']) : "";
$status=(isset($_POST['status_menu'])) ? htmlentities($_POST['status_menu']) : "";

if (!empty($_POST['edit_menu_validate'])){
    $query = mysqli_query($conn , "UPDATE menu SET harga='$harga',status_menu='$status' WHERE id_menu='$id'");
    if($query){
            $message = '<script>
            alert("Data Berhasil Di edit");
            window.location="../menu"
            </script>';
    }else{
            $message = '<script>
            alert("Data Gagal Di edit");
            window.location="../menu"
            </script>';
    
    }
}
    

echo $message;
?>