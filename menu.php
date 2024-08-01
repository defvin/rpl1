<?php
include "proses/config.php";

// Menjalankan query 'order'
$query = mysqli_query($conn, "SELECT * FROM `menu` ");

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
                Menu
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col d-flex justify-content-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaltam">Tambah Menu</button>
                    </div>
                </div>
                <!-- Modal Tam Menu-->
<div class="modal fade" id="modaltam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="proses/input_menu.php" method="POST">   
          <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" placeholder="nama menu" name="nama_menu" required>
              <label for="floatingInput">nama</label>
          </div>
          <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" placeholder="keterangan" name="deskripsi" required>
              <label for="floatingInput">deskripsi</label>
          </div>
          <div class="form-floating mb-3">
              <input type="number" class="form-control" id="floatingInput" placeholder="5000" name="harga" required>
              <label for="floatingInput">Harga</label>
          </div>
          <div class="form-floating mb-3">
          <select class="form-select" aria-label="Default select example" name="kategori" required>
              <option selected hidden>kategori</option>
              <option value="makanan">makanan</option>
              <option value="minuman">minuman</option>
          </select>
          </div>
          <div class="form-floating mb-3">
          <select class="form-select" aria-label="Default select example" name="status_menu" required>
              <option selected hidden>status menu</option>
              <option value="ready">Ready</option>
              <option value="unready">UnReady</option>
          </select>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="menu_validate" value="1" class="btn btn-primary">Save changes</button>
          </div>
          </form>
      </div>
    </div>
  </div>
</div>
<!-- akhir Modal Tam Menu-->
 <?php
foreach ($result as $row) {
  ?>
 <!-- Modal vim Menu-->
<div class="modal fade" id="modalviw<?php echo $row['id_menu'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<div class="modal fade" id="modaledit<?php echo $row['id_menu'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="proses/edit_menu.php" method="POST">
      <input type="hidden" value="<?php echo $row['id_menu'] ?>" name="id_menu">
          <div class="form-floating mb-3">
              <input disabled type="text" class="form-control" id="floatingInput" name="id_menu" value="<?php echo $row['id_menu'] ?>">
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
              <input type="number" class="form-control" id="floatingInput" name="harga"required value="<?php echo $row['harga'] ?>">
              <label for="floatingInput">Harga</label>
          </div>
          <div class="form-floating mb-3">
              <input disabled type="text" class="form-control" id="floatingInput" value="<?php echo $row['kategori'] ?>">
              <label for="floatingInput">kategori</label>
          </div>
          <div class="form-floating">
            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="status_menu" required>
              <option selected hidden><?php echo $row['status_menu'] ?></option>
              <option value="ready">ready</option>
              <option value="unready">unready</option>
            </select>
            <label for="floatingInput">status</label>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" name="edit_menu_validate" value="1" class="btn btn-primary">Save changes</button>
          </div>
          </form>
      </div>
    </div>
  </div>
</div>
<!-- akhir Modal edit Menu-->

<!-- Modal delt Menu-->
<div class="modal fade" id="modaldelt<?php echo $row['id_menu'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Menu</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="proses/dlt_menu.php" method="POST">
        <input type="hidden" value="<?php echo $row['id_menu'] ?>" name="id_menu">
        Apakah anda ingin menghapus menu ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="edit_menu_validate" value="1" class="btn btn-primary">Save changes</button>
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
                <table  id="table_barang"  class="table table-striped table-bordered table-sm dt-responsive nowrap" width="100%">
 <?php
 if (empty($result)){
    echo "Data menu tidak ada";
 }else{

 
 ?>               
<thead class="thead-purple">
    <tr>
        <th scope="col">NO</th>
        <th scope="col">nama</th>
        <th scope="col">deskripsi</th>
        <th scope="col">Kategori</th>
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
        <td><?php echo $row['nama_menu'] ?></td>
        <td><?php echo $row['deskripsi'] ?></td>
        <td><?php echo $row['kategori'] ?></td>
        <td class="d-flex">
        <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalviw<?php echo $row['id_menu'] ?>">
            <i class="bi bi-eye">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                </svg>
            </i>
        </button>

        
        
        <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modaledit<?php echo $row['id_menu'] ?>">
            <i class="bi bi-pencil-square">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                </svg>
            </i>
        </button>

        <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modaldelt<?php echo $row['id_menu'] ?>">
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