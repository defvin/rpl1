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
    //     $id_order = $record['id_order'];
    //     $id_meja = $record['meja'];
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
            <a href="order" class="btn btn-info mb-3">Back</a>
            <div class="input-group mb-3">
                <span class="input-group-text">Kode Order</span>
                <input disabled type="text" class="form-control" id="id_order" value="<?php echo $id_order ?>">
                <span class="input-group-text">No Meja</span>
                <input disabled type="text" class="form-control" id="floatingInput" value="<?php echo $id_meja ?>">
            </div>

            <!-- Modal Tam item-->
            <div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="proses/input_order_item.php" method="POST">
                                <input type="hidden" value="<?php echo $id_order ?>" name="order">
                                <input type="hidden" value="<?php echo $id_meja ?>" name="id_meja">
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="menu">
                                        <option selected hidden value="">Pilih Menu</option>
                                        <?php
                                        foreach ($select_menu as $value) {
                                            echo "<option value=\"" . $value['id_menu'] . "\">" . $value['nama_menu'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <label for="menu">Menu Makanan/Minuman</label>

                                </div>
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="floatingInput" placeholder="Jumlah Porsi " name="jumlah" required>
                                    <label for="floatingInput">Jumlah Porsi</label>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="order_item_validate" value="1" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- akhir Modal Tam item-->
            <?php
            foreach ($result as $row) {
            ?>
                <!-- Modal vim Menu-->
                <div class="modal fade" id="modalviw<?php echo $row['id_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">View Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="">
                                    <div class="form-floating mb-3">
                                        <input disabled type="text" class="form-control" id="floatingInput" value="<?php echo $row['id_menu'] ?>">
                                        <label for="floatingInput">id</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input disabled type="text" class="form-control" id="floatingInput" value="<?php echo $row['nama_menu'] ?>">
                                        <label for="floatingInput">nama</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input disabled type="text" class="form-control" id="floatingInput" value="<?php echo $row['deskripsi'] ?>">
                                        <label for="floatingInput">deskripsi</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input disabled type="number" class="form-control" id="floatingInput" value="<?php echo $row['harga'] ?>">
                                        <label for="floatingInput">Harga</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input disabled type="text" class="form-control" id="floatingInput" value="<?php echo $row['kategori'] ?>">
                                        <label for="floatingInput">kategori</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input disabled type="text" class="form-control" id="floatingInput" value="<?php echo $row['status_menu'] ?>">
                                        <label for="floatingInput">status</label>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- akhir Modal vim Menu-->

                <!-- Modal edit Menu-->
                <div class="modal fade" id="modaledit<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="proses/edit_order_item.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id_list_order'] ?>" name="id_list_order">
                                    <input type="hidden" value="<?php echo $id_order ?>" name="order">
                                    <input type="hidden" value="<?php echo $id_meja ?>" name="id_meja">

                                    <div class="form-floating mb-3">
                                        <input disabled type="text" class="form-control" id="floatingInput" value="<?php echo $row['nama_menu'] ?>">
                                        <label for="floatingInput">nama</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" disabled name="harga" required value="<?php echo $row['harga'] ?>">
                                        <label for="floatingInput">Harga</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="Jumlah Porsi " name="jumlah" required value="<?php echo $row['jumlah'] ?>">
                                        <label for="floatingInput">Jumlah Porsi</label>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="edit_item_validate" value="1" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- akhir Modal edit Menu-->

                <!-- Modal delt Menu-->
                <div class="modal fade" id="modaldelt<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="proses/dlt_order_item.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id_list_order'] ?>" name="id_list_order">
                                    <input type="hidden" value="<?php echo $id_order ?>" name="order">
                                    <input type="hidden" value="<?php echo $id_meja ?>" name="id_meja">
                                    Apakah anda ingin menghapus menu ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="delete_item_validate" value="1" class="btn btn-primary">Save changes</button>
                            </div>
                            </form>
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
                                <input type="hidden" value="<?php echo $row['id_list_order'] ?>" name="list_order">
                            
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
                <table class="table table-hover">
                    <div class="modal-footer">
                        <button class="<?php echo (!empty($row['id_transaksi'])) ? "btn btn-secondary btn-sm me-1 disabled" :"btn btn-primary btn-sm me-1"?>" data-bs-toggle="modal" data-bs-target="#modaltambah">
                            Tambah Pesanan
                        </button>
                        <button class="<?php echo (!empty($row['id_transaksi'])) || ($row['status_list_order'] != "selesai") ? "btn btn-secondary btn-sm me-1 disabled" :"btn btn-success btn-sm me-1"?>" data-bs-toggle="modal" data-bs-target="#bayar">
                            Bayar
                        </button>

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
                                <th scope="col">Aksi</th>
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
                                    <td class="d-flex">



                                        <button class="<?php echo (!empty($row['id_transaksi'])) ? "btn btn-secondary btn-sm me-1 disabled" :"btn btn-warning btn-sm me-1"?>" data-bs-toggle="modal" data-bs-target="#modaledit<?php echo $row['id_list_order'] ?>">
                                            <i class="bi bi-pencil-square">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                </svg>
                                            </i>
                                        </button>

                                        <button class="<?php echo (!empty($row['id_transaksi'])) ? "btn btn-secondary btn-sm me-1 disabled" :"btn btn-danger btn-sm me-1"?>" data-bs-toggle="modal" data-bs-target="#modaldelt<?php echo $row['id_list_order'] ?>">
                                            <i class="bi bi-trash3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                </svg>
                                            </i>
                                        </button>

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
                </table>

            </div>

        </div>

    </div>


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