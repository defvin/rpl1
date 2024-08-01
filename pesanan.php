<?php
include "proses/config.php";

// Menjalankan query 'order'
$query = mysqli_query($conn, "SELECT pesanan.*, menu.*, list_order.* FROM list_order
left join pesanan on list_order.id_order = pesanan.id_order
left join menu on menu.id_menu = list_order.id_menu 
left join transaksi on transaksi.id_order = pesanan.id_order
where list_order.status_list_order != 'selesai' 

order by waktu_order ASC

 ");


// Memeriksa 
if (!$query) {
    die("Query failed: " . mysqli_error($conn));
}

// Mengambil hasil query dan menyimpannya dalam array
$result = array();
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
    //     $id_order = $record['id_order'];
    //     $id_meja = $record['meja'];
}
//$select_menu = mysqli_query($conn, "SELECT id_menu, nama_menu FROM menu where status_menu = 'ready'");
// Menutup koneksi
mysqli_close($conn);
?>
<div class="col-lg-9  mt-2">
    <div class="card">
        <div class="card-header">
            Order List
        </div>
        <div class="card-body">



            <!-- akhir Modal Tam item-->
            <?php
            foreach ($result as $row) {
            ?>


                <!-- Modal edit Menu-->
                <div class="modal fade" id="modalterima<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="proses/terima_pesanan.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id_list_order'] ?>" name="id_list_order">

                                    <div class="form-floating mb-3">
                                        <input disabled type="text" class="form-control" id="floatingInput" value="<?php echo $row['nama_menu'] ?>">
                                        <label for="floatingInput">nama</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" disabled name="harga" required value="<?php echo $row['harga'] ?>">
                                        <label for="floatingInput">Harga</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" disabled placeholder="Jumlah Porsi " name="jumlah" required value="<?php echo $row['jumlah'] ?>">
                                        <label for="floatingInput">Jumlah Porsi</label>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="terima_validate" value="1" class="btn btn-primary">Terima</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- akhir Modal edit Menu-->

                <!-- Modal delt Menu-->
                <div class="modal fade" id="modalsiap<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="proses/selesai_pesanan.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id_list_order'] ?>" name="id_list_order">

                                    <div class="form-floating mb-3">
                                        <input disabled type="text" class="form-control" id="floatingInput" value="<?php echo $row['nama_menu'] ?>">
                                        <label for="floatingInput">nama</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" disabled name="harga" required value="<?php echo $row['harga'] ?>">
                                        <label for="floatingInput">Harga</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" disabled placeholder="Jumlah Porsi " name="jumlah" required value="<?php echo $row['jumlah'] ?>">
                                        <label for="floatingInput">Jumlah Porsi</label>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="selesai_validate" value="1" class="btn btn-primary">Selesai</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- akhir Modal delt Menu-->
            <?php
            }
            ?>
            <!-- Modal bayar-->
            <div class="modal fade modal-lg" id="bayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">
                            <div class="table-responsif">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="text-nowarp">
                                            <th scope="col">Menu</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Banyak</th>
                                            <th scope="col">Total</th>

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
                                </table>
                            </diV>
                        </div>


                        <form action="proses/bayar.php" method="POST">
                            <input type="hidden" value="<?php echo $id_order ?>" name="order">
                            <input type="hidden" value="<?php echo $id_meja ?>" name="id_meja">
                            <input type="hidden" value="<?php echo $total ?>" name="total">

                            <diV class="col-lg-20">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="floatingInput" placeholder="Nominal Uang" name="nominal" required>
                                    <label for="floatingInput">Masukan Nominal Uang</label>
                                </div>
                            </diV>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="bayar_validate" value="1" class="btn btn-primary">Bayar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- akhir Modal bayar-->
        <div class="table-responsive">
            <table id="table_barang"  class="table table-striped table-bordered table-sm dt-responsive nowrap">
                <div class="modal-footer">


                </div>
                <?php
                if (empty($result)) {
                    echo "Data menu tidak ada";
                } else {


                ?>
                    <thead>
                        <tr>
                            <th scope="col">Id order</th>
                            <th scope="col">waktu order</th>
                            <th scope="col">menu</th>
                            <th scope="col">Banyak</th>

                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($result as $row) {
                        ?>
                            <tr>

                                <td><?php echo $row['id_order'] ?></td>
                                <td><?php echo $row['waktu_order'] ?></td>
                                <td><?php echo $row['nama_menu'] ?></td>
                                <td><?php echo $row['jumlah'] ?></td>
                                <td>
                                    <?php echo $row['status_list_order'] ?>
                                </td>
                                <td class="d-flex">



                                    <button class="<?php echo ($row['status_list_order'] == 'menunggu' && $row['status_list_order'] != 'selesai') ? 'btn btn-primary btn-sm me-1' : 'btn btn-secondary btn-sm me-1 disabled' ?>" data-bs-toggle="modal" data-bs-target="#modalterima<?php echo $row['id_list_order'] ?>">
                                        terima
                                    </button>

                                    <button class="<?php echo (empty($row['status_list_order']) || ($row['status_list_order'] != 'diterima' && $row['status_list_order'] = 'menunggu')) ? 'btn btn-secondary btn-sm me-1 disabled' : 'btn btn-success btn-sm me-1' ?>" data-bs-toggle="modal" data-bs-target="#modalsiap<?php echo $row['id_list_order'] ?>">
                                        selesai
                                    </button>

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