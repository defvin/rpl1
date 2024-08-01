<?php
include "config.php";
$id=(isset($_POST['id_meja'])) ? htmlentities($_POST['id_meja']) : "";
$daya=(isset($_POST['daya_tampung'])) ? htmlentities($_POST['daya_tampung']) : "";
$status=(isset($_POST['status_meja'])) ? htmlentities($_POST['status_meja']) : "";

if (!empty($_POST['edit_meja_validate'])){
    $query = mysqli_query($conn , "UPDATE meja SET dayaTampung = '$daya', status_meja= '$status' WHERE id_meja='$id'");
    if($query){
            $message = '<script>
            alert("Data Berhasil Di edit");
            window.location="../meja"
            </script>';
    }else{
            $message = '<script>
            alert("Data Gagal Di edit");
            window.location="../meja"
            </script>';
    
    }
}
    
echo $message;
?>
