<?php
include "config.php";

$id = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";

if (!empty($_POST['hapus_order_validate'])) {
        $query = mysqli_query($conn, "DELETE FROM pesanan WHERE id_order='$id'");
        if ($query) {
                $message = '<script>
                alert("Data Berhasil Di hapus");
                window.location="../order"
                </script>';
        } else {
                $message = '<script>
                alert("Data Gagal Di hapus");
                window.location="../order"
                </script>';
        }
}


echo $message;

?>
