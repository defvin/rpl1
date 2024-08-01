<?php

$conn = mysqli_connect("localhost", "root", "","resto");
if (!$conn){
     echo 'koneksi gagal';
    }
    
date_default_timezone_set('Asia/Jakarta');   
?>