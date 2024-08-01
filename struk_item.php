<?php
include "proses/config.php";

// Menjalankan query 'order'
$query = mysqli_query($conn, "SELECT *, SUM(harga*jumlah) AS total_harga FROM list_order
left join pesanan on list_order.id_order = pesanan.id_order
left join menu on menu.id_menu = list_order.id_menu 
left join transaksi on transaksi.id_order = pesanan.id_order
group by id_list_order
HAVING list_order.id_order = $_GET[order] ");

$id_order = $_GET['order'];
$id_meja = $_GET['meja'];

// Memeriksa 
if (!$query) {
    die("Query failed: " . mysqli_error($conn));
}

// Mengambil hasil query dan menyimpannya dalam array
$result = array();
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;

}
$select_menu = mysqli_query($conn, "SELECT id_menu, nama_menu FROM menu where status_menu = 'ready'");
// Menutup koneksi
mysqli_close($conn);
?>
<div class="col-lg-9  mt-2">
    <div class="card">
        <div class="card-header">
            Order List
        </div>
        <div class="card-body">
            <a href="struk" class="btn btn-info mb-3">Back</a>
            <div class="input-group mb-3">
                <span class="input-group-text">Kode Order</span>
                <input disabled type="text" class="form-control" id="id_order" value="<?php echo $id_order ?>">
                <span class="input-group-text">No Meja</span>
                <input disabled type="text" class="form-control" id="floatingInput" value="<?php echo $id_meja ?>">
            </div>

            
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <div class="modal-footer">
                        
                    </div>
                    <?php
                    if (empty($result)) {
                        echo "Data menu tidak ada";
                    } else {


                    ?>
                        <thead>
                            <tr>
                                <th scope="col">Menu</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Banyak</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            foreach ($result as $row) {
                            ?>
                                <tr>

                                    <td><?php echo $row['nama_menu'] ?></td>
                                    <td>
                                        <?php echo number_format($row['harga'], 0, ',', '.') ?></td>
                                    <td><?php echo $row['jumlah'] ?></td>
                                    <td>
                                        <?php echo number_format($row['total_harga'], 0, ',', '.') ?></td>
                                    <td>
                                    <?php echo $row['status_list_order'] ?>
                                    </td>
                                    
                                </tr>
                            <?php
                            }
                            $total += $row['total_harga'];
                            ?>
                            <tr>
                                <td colspan="3" class="fw-bold">
                                    Total Harga
                                </td>
                                <td class="fw-bold">
                                    <?php echo number_format($total, 0, ',', '.') ?>
                                </td>
                            </tr>
                        </tbody>
                        
    <?php
                    }
    ?>
                </table>
                
            </div>
    <form action="cetak_struk.php" method="POST">
        <input type="hidden" name="id_order" value="<?php echo $id_order ?>">
        <input type="hidden" name="id_meja" value="<?php echo $id_meja ?>">
        <input type="hidden" name="total" value="<?php echo $total ?>">
        <input type="hidden" name="nominal" value="<?php echo $row['nominal_uang']?>" >
        <?php
    foreach ($result as $row) {
    ?>
        <!-- Menggunakan array untuk menyimpan data menu -->
        <input type="hidden" name="menu[]" value="<?php echo $row['nama_menu'] ?>">
        <input type="hidden" name="jumlah[]" value="<?php echo $row['jumlah'] ?>">
        <input type="hidden" name="harga[]" value="<?php echo $row['harga'] ?>">
    <?php
    }
    ?>
        <input type="hidden" name="waktu" value="<?php echo $row['waktu_order'] ?>">
        <button class="btn btn-success">
                    Cetak 
        </button>
    </form>
            
        </div>
        
    </div>
    
</div>
  

