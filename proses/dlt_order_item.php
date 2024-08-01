<?php
include "config.php";
$id = (isset($_POST['order'])) ? htmlentities($_POST['order']) : "";
$id_list = (isset($_POST['id_list_order'])) ? htmlentities($_POST['id_list_order']) : "";
$meja = (isset($_POST['id_meja'])) ? htmlentities($_POST['id_meja']) : "";
$menu = (isset($_POST['menu'])) ? htmlentities($_POST['menu']) : "";
$jumlah =  (isset($_POST['jumlah'])) ? htmlentities($_POST['jumlah']) : "";

if (!empty($_POST['delete_item_validate'])) {
    $query = mysqli_query($conn, "DELETE From list_order where id_list_order = '$id_list'");
        if ($query) {
            $message = '<script>alert("Data Berhasil Dihapus"); window.location="../?x=orderitem&order='.$id.'&meja='.$meja.'"</script>';
        } else {
            $message = '<script>alert("Data Gagal Dihapus"); window.location="../?x=orderitem&order='.$id.'&meja='.$meja.'"</script>';
        }
    
}
echo $message;
?>
