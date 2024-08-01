<?php
$id = isset($_POST['id_order']) ? htmlentities($_POST['id_order']) : "";
$id_meja = isset($_POST['id_meja']) ? htmlentities($_POST['id_meja']) : "";
$total = isset($_POST['total']) ? htmlentities($_POST['total']) : "";
$menu = isset($_POST['menu']) ? $_POST['menu'] : []; // Array
$jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : []; // Array
$harga = isset($_POST['harga']) ? $_POST['harga'] : []; // Array
$waktu = isset($_POST['waktu']) ? htmlentities($_POST['waktu']) : "";
$nominal = isset($_POST['nominal']) ? htmlentities($_POST['nominal']) : "";
$total = (int)$total;
$nominal = (int)$nominal;
$kembalian = $nominal - $total;
?>
<center>


<h2>Struk Resto Unikom</h2>
<h3>Bandung, Dipati Ukur</h3>
<p>============================</p>
<p>Id order: <?php echo $id ?></p>
<p>No meja: <?php echo $id_meja ?> </p>
<p>Waktu order: <?php echo date('d/m/Y H:i:s', strtotime($waktu)) ?></p>
<p>============================</p>
<table>
    <th>Menu</th>
    <th>Jumlah</th>
    <th>Harga</th>
    <?php foreach ($menu as $index => $menuItem) { ?>
    <tr>
        
        <td>
           <?php echo htmlentities($menuItem)  ?>
        </td>
        <td>
           <?php echo htmlentities($jumlah[$index])  ?>
        </td>
        <td>
           <?php echo htmlentities(number_format($harga[$index], 0, ',', '.') )  ?>
        </td>
        
    </tr>
    <?php }?>
    <tr>
        <td><br></td>
    </tr>
    <tr>
        <td colspan="2">
            <b>total</b>
            
        </td>
        <td>
            <b><?php echo number_format($total, 0, ',', '.')  ?> </b>
        </td>
    </tr>
    <tr>
        <td colspan="2">
          <b>Nominal Uang</b>  
        </td>
        <td>
           <b><?php echo number_format($nominal, 0, ',', '.')  ?></b> 
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <b>
            Kembalian
            </b>
            
        </td>
        <td>
            <b>
            <?php echo number_format($kembalian, 0, ',', '.')  ?>
            </b>
            
        </td>
    </tr>
</table>
<p>Terimakasih sudah datang</p>

<script>
    window.print();
    setTimeout(function() {
        window.history.back();
    }, 1000);
</script>

</center>