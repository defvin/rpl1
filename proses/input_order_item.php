<?php
include "config.php";
$id = (isset($_POST['order'])) ? htmlentities($_POST['order']) : "";
$meja = (isset($_POST['id_meja'])) ? htmlentities($_POST['id_meja']) : "";
$menu = (isset($_POST['menu'])) ? htmlentities($_POST['menu']) : "";
$jumlah =  (isset($_POST['jumlah'])) ? htmlentities($_POST['jumlah']) : "";
$status_list= "menunggu";

if (!empty($_POST['order_item_validate'])) {

    $select = mysqli_query($conn, "SELECT * FROM list_order WHERE id_menu = '$menu' && id_order = '$id'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Item yang dimasukan sudah ada"); window.location="../?x=orderitem&order='.$id.'&meja='.$meja.'"</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO list_order (id_menu, id_order, jumlah) VALUES ('$menu', '$id', '$jumlah')");
        if ($query) {
            $id_list = mysqli_insert_id($conn); // Mendapatkan id_list_order yang baru diinsert
            $update_status_list = mysqli_query($conn, "UPDATE list_order SET status_list_order ='$status_list' WHERE id_list_order = '$id_list'");
            if ($update_status_list) {
                $message = '<script>alert("Data Berhasil Dimasukan"); window.location="../?x=orderitem&order='.$id.'&meja='.$meja.'"</script>';
            } else {
                $message = '<script>alert("Data Berhasil Dimasukan, tapi gagal mengupdate status"); window.location="../?x=orderitem&order='.$id.'&meja='.$meja.'"</script>';
            }
        } else {
            $message = '<script>alert("Data Gagal Dimasukan"); window.location="../?x=orderitem&order='.$id.'&meja='.$meja.'"</script>';
        }
    }
}
echo $message;
?>
