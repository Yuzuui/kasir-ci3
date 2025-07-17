<div id="menghilang">
    <?php if ($this->session->flashdata('alert')): ?>
    <?= $this->session->flashdata('alert'); ?>
    <?php endif; ?>
</div>
<!-- Button to trigger modal -->
<button type="button" class="btn btn-primary  mt-5" data-toggle="modal" data-target="#userModal">
    Tambah pelanggan
</button>

<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Tambah Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('pelanggan/simpan') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">Nomer HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan no_hp"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat"
                            required>
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
            <h4 class="card-title">Table Pelanggan</h4>
            <div class="table-responsive" style="overflow-x: auto;">
                <table class="table" style="width: 100%; font-size: larger;">
                    <thead>
                        <tr>
                            <th style="width: 20%;">Nama</th>
                            <th style="width: 20%;">Alamat</th>
                            <th style="width: 30%;">No HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($pelanggan as $data){ ?>
                        <tr>
                            <td> <?= $data['nama'];?> </td>
                            <td><?= $data['alamat']; ?></td>
                            <td><?= $data['no_hp']; ?></td>
                            <td>
                                <a class="btn btn-danger"
                                    onClick="return confirm('Apakah anda yakin menghapus data ini?')"
                                    href=" <?= base_url('pelanggan/hapus/').$data['id_pelanggan']?>">

                                    <span class="mdi mdi-delete-alert"></span>
                                </a>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#userModalEdit<?= $data['id_pelanggan']; ?>">
                                    <span class="mdi mdi-tag-edit"></span>

                                </button>

                                <div class="modal fade" id="userModalEdit<?= $data['id_pelanggan']; ?>" tabindex="-1"
                                    role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="userModalLabel">Edit Pelanggan</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="<?= base_url('pelanggan/update') ?>">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_pelanggan"
                                                        value="<?= $data['id_pelanggan']; ?>">
                                                    <div class="form-group">
                                                        <label for="nama">Nama</label>
                                                        <input type="text" class="form-control" id="nama" name="nama"
                                                            value="<?= $data['nama']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat">Alamat</label>
                                                        <input type="text" class="form-control" id="alamat"
                                                            name="alamat" value="<?= $data['alamat']; ?>" require>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="no_hp">no_hp</label>
                                                        <input type="text" class="form-control" id="no_hp" name="no_hp"
                                                            value="<?= $data['no_hp']; ?>" require>
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