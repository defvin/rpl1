<?php
include "config.php";
$id=(isset($_POST['id_meja'])) ? htmlentities($_POST['id_meja']) : "";

if (!empty($_POST['delete_meja_validate'])){
    $query = mysqli_query($conn , "DELETE FROM meja WHERE id_meja='$id'");
    if($query){
            $message = '<script>
            alert("Data Berhasil Di hapus");
            window.location="../meja"
            </script>';
    }else{
            $message = '<script>
            alert("Data Gagal Di hapus");
             window.location="../meja"
            </script>';
    
    }
}
    

echo $message;
?>
