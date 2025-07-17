<div class="container">
    <div id="menghilang">
        <?php echo $this->session->flashdata('alert', true);?>
    </div>
</div>
<!-- Button to trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userModal">
    Tambah User
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
            <form method="POST" action="<?= base_url('user/simpan') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Masukkan Username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Masukkan Password" required>
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="form-control" name="level" id="level">
                            <option value="admin">Admin</option>
                            <option value="pegawai">Pegawai</option>
                        </select>
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
            <h4 class="card-title">Table User</h4>
            <div class="table-responsive" style="overflow-x: auto;">
                <table class="table" style="width: 100%; font-size: larger;">
                    <thead>
                        <tr>
                            <th style="width: 20%;">Nama</th>
                            <th style="width: 20%;">Username</th>
                            <th style="width: 30%;">Level</th>
                            <th style="width: 30%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($user as $data){ ?>
                        <tr>
                            <td> <?= $data['nama'];?> </td>
                            <td><?= $data['username']; ?></td>
                            <td><?= $data['level']; ?></td>
                            <td>
                                <a class="btn btn-danger"
                                    onClick="return confirm('Apakah anda yakin menghapus data ini?')"
                                    href=" <?= base_url('user/hapus/').$data['id_user']?>">

                                    <span class="mdi mdi-delete-alert"></span>
                                </a>
                                <a class="btn btn-warning" onClick="return confirm('Apakah anda mereset password?')"
                                    href=" <?= base_url('user/reset/').$data['id_user']?>">

                                    <span class="mdi mdi-lock-reset"></span>

                                </a>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#userModalEdit<?= $data['id_user']; ?>">
                                    <span class="mdi mdi-tag-edit"></span>

                                </button>

                                <div class="modal fade" id="userModalEdit<?= $data['id_user']; ?>" tabindex="-1"
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
                                            <form method="POST" action="<?= base_url('user/update') ?>">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_user"
                                                        value="<?= $data['id_user']; ?>">
                                                    <div class="form-group">
                                                        <label for="nama">Nama</label>
                                                        <input type="text" class="form-control" id="nama" name="nama"
                                                            value="<?= $data['nama']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="username">Username</label>
                                                        <input type="text" class="form-control" id="username"
                                                            name="username" value="<?= $data['username']; ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="level">Level</label>
                                                        <select class="form-control" name="level" id="level">
                                                            <option value="admin"
                                                                <?php if ($data['level'] == 'admin'){echo "selected";} ?>>
                                                                Admin</option>
                                                            <option value="pegawai"
                                                                <?php if ($data['level'] == 'pegawai'){echo "selected";} ?>>
                                                                Pegawai</option>
                                                        </select>
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