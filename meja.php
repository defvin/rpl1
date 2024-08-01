<?php
include "proses/config.php";

// Menjalankan query 'order'
$query = mysqli_query($conn, "SELECT * FROM meja where status_meja = 'kosong' ");

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
                Meja
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col d-flex justify-content-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaltam">Tambah Meja</button>
                    </div>
                </div>
                <!-- Modal Tam Meja-->
<div class="modal fade" id="modaltam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Meja</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="proses/input_meja.php" method="POST">
          <div class="form-floating mb-3">
              <input type="number" class="form-control" id="floatingInput" placeholder="Daya tampung" name="daya_tampung" required>
              <label for="floatingInput">Daya Tampung</label>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="input_meja_validate" value="1" class="btn btn-primary">Simpan</button>
          </div>
          </form>
      </div>
    </div>
  </div>
</div>
<!-- akhir Modal Tam Meja-->
 <?php
foreach ($result as $row) {
  ?>
<!-- Modal edit Meja-->
<div class="modal fade" id="modaledit<?php echo $row['id_meja'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="proses/edit_meja.php" method="POST">
      <input type="hidden" value="<?php echo $row['id_meja'] ?>" name="id_meja">
          <div class="form-floating mb-3">
              <input disabled type="text" class="form-control" id="floatingInput" name="id_meja" value="<?php echo $row['id_meja'] ?>">
              <label for="floatingInput">No</label>
          </div>
          <div class="form-floating mb-3">
              <input type="number" class="form-control" id="floatingInput" name="daya_tampung" value="<?php echo $row['dayaTampung'] ?>">
              <label for="floatingInput">Daya Tampung</label>
          </div>
          <div class="form-floating">
            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="status_meja" required>
              <option selected hidden><?php echo $row['status_meja'] ?></option>
              <option value="diperbaiki">diperbaiki</option>
            </select>
            <label for="floatingInput">status</label>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="edit_meja_validate" value="1" class="btn btn-primary">Simpan</button>
          </div>
          </form>
      </div>
    </div>
  </div>
</div>
<!-- akhir Modal edit Menu-->

<!-- Modal delt Menu-->
<div class="modal fade" id="modaldelt<?php echo $row['id_meja'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Menu</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="proses/dlt_meja.php" method="POST">
        <input type="hidden" value="<?php echo $row['id_meja'] ?>" name="id_meja">
        Apakah anda ingin menghapus meja ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="delete_meja_validate" value="1" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- akhir Modal delt Menu-->
<?php
}
?>
                <div class="table-responsive">
                <table  id="table_barang" class="table table-striped table-bordered table-sm dt-responsive nowrap">
 <?php
 if (empty($result)){
    echo "Data menu tidak ada";
 }else{

 
 ?>               
<thead>
    <tr>
        <th scope="col">No meja</th>
        <th scope="col">Daya tampung</th>
        <th scope="col">Status</th>
        <th scope="col">Aksi</th>
    </tr>
</thead>
<tbody>
    <?php
    $no = 1; // Variabel penghitung untuk nomor urut
    foreach ($result as $row) {
    ?>
    <tr>
        <td><?php echo $row['id_meja'] ?></td>
        <td><?php echo $row['dayaTampung'] ?></td>
        <td><?php echo $row['status_meja'] ?></td>
        <td class="d-flex">        
        <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modaledit<?php echo $row['id_meja'] ?>">
            <i class="bi bi-pencil-square">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                </svg>
            </i>
        </button>

        <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modaldelt<?php echo $row['id_meja'] ?>">
            <i class="bi bi-trash3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                </svg>
            </i>
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