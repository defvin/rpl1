<?php
include "config.php";
$id_list = (isset($_POST['id_list_order'])) ? htmlentities($_POST['id_list_order']) : "";
$id = (isset($_POST['order'])) ? htmlentities($_POST['order']) : "";
$meja = (isset($_POST['id_meja'])) ? htmlentities($_POST['id_meja']) : "";
$menu = (isset($_POST['menu'])) ? htmlentities($_POST['menu']) : "";
$jumlah =  (isset($_POST['jumlah'])) ? htmlentities($_POST['jumlah']) : "";

if (!empty($_POST['edit_item_validate'])) {

        $query = mysqli_query($conn, "UPDATE list_order set jumlah = '$jumlah' where id_list_order = '$id_list'");
        
        if ($query) {
            $message = '<script>alert("Data Berhasil Diedit"); window.location="../?x=orderitem&order='.$id.'&meja='.$meja.'"</script>';
        } else {
            $message = '<script>alert("Data Gagal Diedit"); window.location="../?x=orderitem&order='.$id.'&meja='.$meja.'"</script>';
        }
    }

echo $message;
?>
