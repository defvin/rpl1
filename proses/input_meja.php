<?php
include "config.php";
$daya=(isset($_POST['daya_tampung'])) ? htmlentities($_POST['daya_tampung']) : "";
$status = "kosong";

if (!empty($_POST['input_meja_validate'])){
        $query = mysqli_query($conn , "INSERT into meja (dayaTampung, status_meja) values
        ('$daya','$status')");
        if($query){
                $message = '<script>
                alert("Data Berhasil Dimasukan");
                window.location="../meja"
                </script>';
        }else{
                $message = '<script>
                alert("Data Gagal Dimasukan");
                window.location="../meja"
                </script>';
    
        }
    }
    

echo $message;
?>
