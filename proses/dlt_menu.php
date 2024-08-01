<?php
include "config.php";
$id=(isset($_POST['id_menu'])) ? htmlentities($_POST['id_menu']) : "";

if (!empty($_POST['edit_menu_validate'])){
    $query = mysqli_query($conn , "DELETE FROM menu WHERE id_menu='$id'");
    if($query){
            $message = '<script>
            alert("Data Berhasil Di hapus");
            window.location="../menu"
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
