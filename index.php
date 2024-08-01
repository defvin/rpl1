<!-- content -->
<?php
if (isset($_GET['x']) && $_GET['x'] == 'home') {
    $page = "home.php";
    include 'main.php';
} elseif (isset($_GET['x']) && $_GET['x'] == 'order') {
    $page = "order.php";
    include 'main.php';
} elseif (isset($_GET['x']) && $_GET['x'] == 'struk') {
    $page = "struk.php";
    include 'main.php';
} elseif (isset($_GET['x']) && $_GET['x'] == 'laporan') {
    $page = "laporan.php";
    include 'main.php';
} elseif (isset($_GET['x']) && $_GET['x'] == 'menu') {
    $page = "menu.php";
    include 'main.php';
} elseif (isset($_GET['x']) && $_GET['x'] == 'meja') {
    $page = "meja.php";
    include 'main.php';
} elseif (isset($_GET['x']) && $_GET['x'] == 'pesanan') {
    $page = "pesanan.php";
    include 'main.php';
} elseif (isset($_GET['x']) && $_GET['x'] == 'orderitem') {
    $page = "order_item.php";
    include 'main.php';
} elseif (isset($_GET['x']) && $_GET['x'] == 'strukitem') {
    $page = "struk_item.php";
    include 'main.php';
} elseif (isset($_GET['x']) && $_GET['x'] == 'viewitem') {
    $page = "view_item.php";
    include 'main.php';
} elseif (isset($_GET['x']) && $_GET['x'] == 'login') {
    include 'login.php';
} elseif (isset($_GET['x']) && $_GET['x'] == 'logout') {
    include 'proses/proses_logout.php';
} else {
    $page = "home.php";
    include 'main.php';
}
?>