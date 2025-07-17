<div class="container">
    <div id="menghilang">
        <?php echo $this->session->flashdata('alert', true);?>
    </div>
</div>
<!-- Button to trigger modal -->
<button type="button" class="btn btn-primary mr-3" data-toggle="modal" data-target="#userModal">
    Tambah penjualan
</button>

<button type="button" class="btn btn-info btn-icon-text " data-toggle="modal" data-target="#laporan">
    laporan
    <i class="ti-printer btn-icon-append"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Tambah Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table" style="width: 100%; font-size: larger;">
                    <thead>
                        <tr>
                            <th style="width: 20%;">No</th>
                            <th style="width: 20%;">Nama</th>
                            <th style="width: 20%;">Alamat</th>
                            <th style="width: 30%;">No HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($pelanggan as $data){ ?>
                        <tr>
                            <td> <?= $no++; ?> </td>
                            <td> <?= $data['nama'];?> </td>
                            <td><?= $data['alamat']; ?></td>
                            <td><?= $data['no_hp']; ?></td>
                            <td>
                                <a class="btn btn-danger"
                                    href=" <?= base_url('penjualan/transaksi/').$data['id_pelanggan']?>">
                                    pilih
                                </a>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>

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
                            <th>No</th>
                            <th>No Nota</th>
                            <th>Nominal</th>
                            <th>Pelanggan</th>
                            <th>Aksi</th>



                        </tr>
                    </thead>
                    <tbody>
                        <?php $total=0; $no = 1; foreach($penjualan as $data){ ?>
                        <tr>
                            <td> <?= $no++;?> </td>
                            <td> <?= $data['nota'];?> </td>
                            <td>RP. <?= number_format($data['tagihan']); ?></td>
                            <td><?= $data['nama']; ?></td>
                            <td>
                                <a href="<?= base_url('penjualan/invoice/'.$data['nota'])?>"
                                    class="btn-sm btn-warning">cek</a>
                            </td>
                        </tr>
                        <?php $total=$total+$data['tagihan']; $no++; }?>
                        <tr>
                            <td colspan=2>Total</td>
                            <td>Rp.<?= number_format($total); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- laporan -->
<div class="modal fade" id="laporan" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="get" action="<?= base_url('penjualan/laporan') ?>" target=_blank>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Dari</label>
                        <input type="date" class="form-control" name="tanggal1" required>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Sampai</label>
                        <input type="date" class="form-control" name="tanggal2" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Print</button>
                </div>
            </form>
        </div>
    </div>
</div>