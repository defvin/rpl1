<?php
include "config.php";

$id = isset($_POST['kode_order']) ? htmlentities($_POST['kode_order']) : "";
$meja = isset($_POST['id_meja']) ? htmlentities($_POST['id_meja']) : "";
$pelayan = isset($_POST['pelayan']) ? htmlentities($_POST['pelayan']) : "";

if (!empty($_POST['edit_order_validate'])) {
    $query = mysqli_query($conn, "UPDATE pesanan SET meja='$meja', pelayan='$pelayan' WHERE id_order='$id'");
    
    if ($query) {
        $message = '<script>
                alert("Data Berhasil Di edit");
                window.location="../order"
                </script>';
    } else {
        $message = '<script>
                alert("Data Gagal Di edit");
                window.location="../order"
                </script>';
    }
}

echo $message;

?>
