<?php
    session_start();
    if(empty($_SESSION['username_resto'])){
        header('location:login');
    }
    include 'proses/config.php';
    $query = mysqli_query($conn , "SELECT * FROM user WHERE nama = '$_SESSION[username_resto]'");
    $hasil = mysqli_fetch_array($query);
  
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resto | UNIKOM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="height: 3000px;">
    <?php include "template/header.php"; ?>
    <?php include "template/sidebar.php"; ?>

    <!-- content -->
    <?php
    include $page;
    ?>
    <!-- end content -->
    </div>

    <div class="fixed-bottom text-center mb-2">
        &copy; Tim Kopi Manggar 2024
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>

