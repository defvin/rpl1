<?php
include "config.php";
$id = (isset($_POST['order'])) ? htmlentities($_POST['order']) : "";
$meja = (isset($_POST['id_meja'])) ? htmlentities($_POST['id_meja']) : "";
$menu = (isset($_POST['menu'])) ? htmlentities($_POST['menu']) : "";
$jumlah =  (isset($_POST['jumlah'])) ? htmlentities($_POST['jumlah']) : "";
$total = (isset($_POST['total'])) ? htmlentities($_POST['total']) : "";
$nominal = (isset($_POST['nominal'])) ? htmlentities($_POST['nominal']) : "";
// $total = (int)$total;
// $nominal = (int)$nominal;
$kembalian = $nominal - $total;
$waktu_bayar = date('Y-m-d H:i:s'); 
$status_meja = "kosong";
$status_order = "dibayar";

if (!empty($_POST['bayar_validate'])) {
    $cek_status_menu = mysqli_query($conn, "SELECT status_list_order from list_order");
    if ($kembalian < 0) {
        $message = '<script>alert("Nominal kurang"); window.location="../?x=orderitem&order=' . $id . '&meja=' . $meja . '"</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO transaksi (id_order, nominal_uang, total_bayar,waktu_bayar) VALUES ('$id', '$nominal', '$total', '$waktu_bayar')");
        $update_meja = mysqli_query($conn, "UPDATE meja set status_meja ='$status_meja'where id_meja = '$meja' ");
        $update_status_order = mysqli_query($conn, "UPDATE pesanan set status_order ='$status_order'where id_order = '$id' ");
        if ($query) {
            $message = '<script>alert("Transaksi Berhasil Dilakukan\nUang Kembalian Rp. '.$kembalian.' "); window.location="../?x=orderitem&order=' . $id . '&meja=' . $meja . '"</script>';
        } else {
            $message = '<script>alert("Transaksi Gagal Dilakukan"); window.location="../?x=orderitem&order=' . $id . '&meja=' . $meja . '"</script>';
        }
    }
}
echo $message;
