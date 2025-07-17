<div class="container">
    <div id="menghilang">
        <?php echo $this->session->flashdata('alert', true);?>
    </div>
    <div class="row">
        <!-- Form Masukan Produk -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Masukan Produk</h4>

                    <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <input type="text" class="form-control" name="id_penjualan" value="<?= $jenengsengtuku?>"
                            readonly>
                    </div>
                    <form action="<?= base_url('penjualan/addtemp')?> " method="post">
                        <input type="hidden" name="id_pelanggan" value="<?= $id_pelanggan?>">
                        <div class=" form-group">
                            <label>Produk</label>
                            <input type="hidden" name="nota" value="<?= $nota?>" required>
                            <select name="id_produk" class="form-control">
                                <?php foreach($produk as $data){?>
                                <option value="<?= $data['id_produk']?>"><?= $data['nama']?> -
                                    <?= $data['barcode']?>(<?= $data['stok']?>)</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" placeholder="jumlah produk"
                                required>
                        </div>
                        <label for="diskon">Diskon (%)</label>
                        <input type="number" name="diskon" id="diskon" class="form-control" value="0">

                        <div class="form-group">
                            <button type="submit" class="btn btn-dark btn-rounded btn-fw">Tambah Keranjang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Table Pelanggan -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Table Pelanggan</h4>
                    <div class="table-responsive" style="overflow-x: auto;">
                        <table class="table" style="width: 100%; font-size: larger;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Diskon</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cek=0; $total=0; $no=1; foreach($temp as $data){ 
                                    $subtotal = $data['jumlah'] * $data['harga'];
                                    $diskon = ($subtotal * $data['diskon']) /100;
                                    $subtotal_setelah_diskon = $subtotal - $diskon; // Harga setelah diskon

                                    $total += $subtotal_setelah_diskon;
                                    ?>
                                <tr>
                                    <td> <?= $no;?> </td>
                                    <td> <?= $data['barcode'];?> </td>
                                    <td><?= $data['nama']; ?></td>
                                    <td>
                                        <?= $data['jumlah']; ?>
                                        <?php
                                        if($data['jumlah']>$data['stok']){
                                            echo "<span class='badge badge-danger'>Stok tidak mencukupi</span>";
                                            $cek =1;
                                        }
                                        ?>
                                    </td>
                                    <td>Rp. <?= number_format($data['harga']) ?></td>
                                    <td><?= $data['diskon']; ?>%</td>
                                    <td>Rp. <?= number_format($subtotal_setelah_diskon) ?></td>
                                    <td> <a class="btn btn-danger"
                                            onClick="return confirm('Apakah anda yakin menghapus data ini?')"
                                            href="<?= base_url('penjualan/hapus_temp/').$data['id_temp']?>">
                                            <span class="mdi mdi-delete-alert"></span>
                                        </a>
                                    </td>
                                </tr>
                                <?php $no++; }?>
                                <tr>
                                    <td colspan=6>Total Harga</td>
                                    <td>Rp. <?= number_format($total); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('penjualan/payment')?>" method="post">
                        <input type="hidden" name="id_pelanggan" value="<?=$id_pelanggan;?>">
                        <input type="hidden" name="total_harga" value="<?=$total;?>">
                        <?php if(($temp<>NULL) AND ($cek==0)){?>
                        <button type="submit" class="btn btn-dark btn-rounded btn-fw">Bayar</button>
                        <?php } ?>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>