<?php
include "proses/config.php";

date_default_timezone_set('Asia/Jakarta');
// Menjalankan query 'order'
$query = mysqli_query($conn, "SELECT *, SUM(jumlah * harga) AS total_harga FROM transaksi 
LEFT JOIN pesanan ON transaksi.id_order = pesanan.id_order 
LEFT JOIN list_order ON pesanan.id_order = list_order.id_order 
LEFT join menu ON menu.id_menu = list_order.id_menu 
LEFT JOIN user on user.id = pesanan.pelayan
GROUP by pesanan.id_order
ORDER BY transaksi.waktu_bayar ASC");

// Memeriksa 
if (!$query) {
    die("Query failed: " . mysqli_error($conn));
}

// Mengambil hasil query dan menyimpannya dalam array
$result = array();
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

// Menutup koneksi
mysqli_close($conn);
?>
<div class="col-lg-9  mt-2">
    <div class="card">
        <div class="card-header">
            Struk
        </div>
        <div class="card-body">
            
            <?php
            foreach ($result as $row) {
            ?>


                

                
            <?php
            }
            ?>
            <div class="table-responsive">
                <table id="table_barang" class="table table-striped table-bordered table-sm dt-responsive nowrap">
                    <?php
                    if (empty($result)) {
                        echo "Data order tidak ada";
                    } else {


                    ?>
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">Id Order</th>
                                <th scope="col">Waktu Order </th>
                                <th scope="col">Waktu bayar</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Pelayan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1; // Variabel penghitung untuk nomor urut
                            foreach ($result as $row) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++; ?></th>
                                    <td><?php echo $row['id_order'] ?></td>
                                    <td><?php echo $row['waktu_order'] ?></td>
                                    <td><?php echo $row['waktu_bayar'] ?></td>
                                    <td><?php echo $row['total_harga'] ?></td>
                                    <td><?php echo $row['nama'] ?></td>
                                    
                                    <td class="d-flex">

                                        <a href="./?x=strukitem&order=<?php echo $row['id_order'] . "&meja=" . $row['meja'] ?>" class="btn btn-info btn-sm me-1">
                                            <i class="bi bi-eye">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                </svg>
                                            </i>
                                        </a>


                                       

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
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
 
 <?php include "template/footer.php" ?>