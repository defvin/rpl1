<?php
include "config.php";

$id = (isset($_POST['order'])) ? htmlentities($_POST['order']) : "";
$meja = (isset($_POST['id_meja'])) ? htmlentities($_POST['id_meja']) : "";
$pelayan = (isset($_POST['pelayan'])) ? htmlentities($_POST['pelayan']) : "";
$waktu_order = date('Y-m-d H:i:s'); 
$status_meja = "terisi";
$status_order = "belum bayar";


if (!empty($_POST['order_validate'])) {
    $id = mysqli_real_escape_string($conn, $id);
    $select = mysqli_query($conn, "SELECT * FROM pesanan WHERE id_order = '$id'");
    
    if (!$select) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Id menu yang dimasukan sudah ada"); window.location="../order"</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO pesanan (id_order, meja, pelayan, waktu_order) VALUES ('$id', '$meja', '$pelayan', '$waktu_order')");
        $update_meja = mysqli_query($conn, "UPDATE meja set status_meja ='$status_meja'where id_meja = '$meja' ");
        $update_status_order = mysqli_query($conn, "UPDATE pesanan set status_order ='$status_order'where id_order = '$id' ");
        if ($query) {
            $message = '<script>alert("Data Berhasil Dimasukan"); window.location="../?x=orderitem&order='.$id.'&meja='.$meja.'"</script>';
        } else {
            $message = '<script>alert("Data Gagal Dimasukan"); window.location="../order"</script>';
        }
    }
}
echo $message;
?>
