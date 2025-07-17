<div class="container">
    <div id="menghilang">
        <?php echo $this->session->flashdata('alert', true);?>
    </div>
</div>
<!-- Button to trigger modal -->
<button type="button" class="btn btn-primary mr-3" data-toggle="modal" data-target="#userModal">
    Tambah Produk
</button>

<button type="button" class="btn btn-info btn-icon-text" data-toggle="modal" data-target="#PrintModal">
    Print
    <i class="ti-printer btn-icon-append"></i>
</button>


<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('produk/simpan') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Masukkan harga"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="stok" class="form-control" id="stok" name="stok" placeholder="Masukkan stok"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="barcode">Kode Produk</label>
                        <input type="barcode" class="form-control" id="barcode" name="barcode"
                            placeholder="Masukkan kode produk" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- tabel -->
<div class="col-lg-12 grid-margin stretch-card mt-3">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Table Produk</h4>
            <div class="table-responsive" style="overflow-x: auto;">
                <table class="table" style="width: 100%; font-size: larger;">
                    <thead>
                        <tr>
                            <th >Nama</th>
                            <th >Harga</th>
                            <th>Stok</th>
                            <th>Kode Produk</th>
                            <th style="">Barcode</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($produk as $data){ ?>
                        <tr>
                            <td> <?= $data['nama'];?> </td>
                            <td>Rp. <?= number_format($data['harga']) ?></td>
                            <td><?= $data['stok']; ?></td>
                            <td><?= $data['barcode']; ?></td>
                            <td><img src="<?= $data['barcode_image']; ?>" alt="Barcode <?= $data['barcode']; ?>" width="100" style="border-radius: 0;"></td>
                            <td>
                                <a class="btn btn-danger"
                                    onClick="return confirm('Apakah anda yakin menghapus data ini?')"
                                    href=" <?= base_url('produk/hapus/').$data['id_produk']?>"></i>
                                    <span class="mdi mdi-delete-alert"></span>
                                </a>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#userModalEdit<?= $data['id_produk']; ?>">
                                    <span class="mdi mdi-tag-edit"></span>

                                </button>

                                <div class="modal fade" id="userModalEdit<?= $data['id_produk']; ?>" tabindex="-1"
                                    role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="userModalLabel">Tambah User</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="<?= base_url('produk/update') ?>">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_produk"
                                                        value="<?= $data['id_produk']; ?>">
                                                    <div class="form-group">
                                                        <label for="nama">Nama</label>
                                                        <input type="text" class="form-control" id="nama" name="nama"
                                                            value="<?= $data['nama']; ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="harga">Harga</label>
                                                        <input type="text" class="form-control" id="harga" name="harga"
                                                            value="<?= $data['harga']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="stok">Stok</label>
                                                        <input type="text" class="form-control" id="stok" name="stok"
                                                            value="<?= $data['stok']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Print -->
<div class="modal fade" id="PrintModal" tabindex="-1" role="dialog" aria-labelledby="pLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pLabel">Laporan Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="get" action="<?= base_url('produk/print') ?>" target="_blank">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <select name="status" class="form-control">
                            <option value="Ada">Ada</option>
                            <option value="Habis">Habis</option>
                            <option value="Semua">Semua</option>
                        </select>
                    </div>
                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Print</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const barcodeInput = document.getElementById("barcode");

    if (barcodeInput) {
        barcodeInput.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Mencegah submit default
                document.querySelector("#formTambahProduk").submit(); // Submit form otomatis
            }
        });
    }
});
</script>