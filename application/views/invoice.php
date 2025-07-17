<section class="w-100 p-4 justify-content-center">
    <div class="card">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                <div class="row d-flex align-items-baseline">
                    <div class="col-xl-9">
                        <p style="color: #7e8d9f;font-size: 20px;">Invoice <?= $transaksi->nota; ?></strong></p>
                    </div>


                </div>

                <div class="container">
                    <div class="col-md-12">
                        <div class="text-center">
                            <i class="fab fa-mdb fa-4x ms-0"></i>
                            <p class="pt-0">
                            <h3><b>T Mart</b></h3>
                            </p>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-xl-4">
                            <ul class="list-unstyled">
                                <li class="text-muted">From : <span> <b>T Mart</b></span>
                                </li>
                                <li class="text-muted">Alamat : Jl.Imam Bonjol 06 jabar</li>
                                <li class="text-muted">Phone : 0008977</li>
                                <li class="text-muted">Email : mart.t@gmail.com</li>

                            </ul>
                        </div>
                        <div class="col-xl-4">
                            <ul class="list-unstyled">
                                <li class="text-muted">To: <span><?= $transaksi->nama; ?></span>
                                </li>
                                <li class="text-muted"><?= $transaksi->alamat; ?></li>
                                <li class="text-muted"><?= $transaksi->no_hp; ?></li>

                            </ul>
                        </div>
                        <div class="col-xl-4">
                            <p class="text-muted">Invoice</p>
                            <ul class="list-unstyled">
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="fw-bold">ID:</span><?= $transaksi->nota; ?></li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="fw-bold">Creation Date: </span><?= $transaksi->tanggal; ?></li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="me-1 fw-bold">Status:</span><span
                                        class="badge bg-warning text-black fw-bold">
                                        Unpaid</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="row my-2 mx-1 justify-content-center">
                        <table class="table table-striped table-borderless">
                            <!-- <thead style="background-color:#84B0CA ;" class="text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $total=0; $no=1; foreach($detail_transaksi as $data){ ?>
                                <tr>
                                    <td> <?= $no;?> </td>
                                    <td> <?= $data['barcode'];?> </td>
                                    <td><?= $data['nama']; ?></td>
                                    <td><?= $data['jumlah']; ?></td>
                                    <td>Rp. <?= number_format($data['harga']) ?></td>
                                    <td>Rp. <?= number_format($data['jumlah']*$data['harga']) ?></td>
                                </tr>
                                <?php $total=$total+$data['jumlah']*$data['harga']; $no++; }?>
                                <tr>
                                    <td colspan=5>Total Harga</td>
                                    <td>Rp. <?= number_format($total); ?></td>
                                </tr>
                            </tbody> -->

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Diskon</th>
                                    <th>Total</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $cek=0; $total=0; $no=1; foreach($detail_transaksi as $data){ 
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

                                    </td>
                                    <td>Rp. <?= number_format($data['harga']) ?></td>
                                    <td><?= $data['diskon']; ?>%</td>
                                    <td>Rp. <?= number_format($subtotal_setelah_diskon) ?></td>
                                </tr>
                                <?php $no++; }?>
                                <tr>
                                    <td colspan=6>Total Harga</td>
                                    <td>Rp. <?= number_format($total); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-xl-10">
                        <p>Thank you for your purchase</p>
                    </div>
                    <div class="col-xl-2">
                        <a href="<?= base_url('penjualan/print/'.$nota); ?>" class="btn btn-primary pull-right"
                            target="_blank">Cetak</a>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>