<?php
include "config.php";
$id_list = (isset($_POST['id_list_order'])) ? htmlentities($_POST['id_list_order']) : "";
$id = (isset($_POST['order'])) ? htmlentities($_POST['order']) : "";
$meja = (isset($_POST['id_meja'])) ? htmlentities($_POST['id_meja']) : "";
$menu = (isset($_POST['menu'])) ? htmlentities($_POST['menu']) : "";
$jumlah =  (isset($_POST['jumlah'])) ? htmlentities($_POST['jumlah']) : "";
$status_list ="diterima";

if (!empty($_POST['terima_validate'])) {

        $query = mysqli_query($conn, "UPDATE list_order set status_list_order = '$status_list' where id_list_order = '$id_list'");
        
        if ($query) {
            $message = '<script>alert("Data Berhasil Diterima"); window.location="../pesanan"</script>';
        } else {
            $message = '<script>alert("Data Gagal Diterima"); window.location="../pesanan"</script>';
        }
    }

echo $message;
?>
