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
            <a href="laporan" class="btn btn-info mb-3">Back</a>
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
                            
                            $total += $row['total_harga'];
                        }
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
                </table>

            </div>

        </div>

    </div>

    <form>

    <?php
                    }
    ?>

    <script>
        // Fungsi untuk melihat order
        function viewOrder(orderId) {
            // Implementasi fungsi melihat order di sini
            console.log("View order with ID:", orderId);
        }

        // Fungsi untuk mengedit order
        function editOrder(orderId) {
            // Implementasi fungsi mengedit order di sini
            console.log("Edit order with ID:", orderId);
        }

        // Fungsi untuk menghapus order
        function deleteOrder(orderId) {
            // Implementasi fungsi menghapus order di sini
            console.log("Delete order with ID:", orderId);
        }
    </script>