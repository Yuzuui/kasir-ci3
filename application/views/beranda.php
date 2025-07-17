<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="col-lg-3 col-md-5 col-5 mb-4 stretch-card transparent">
    <div class="card card-tale">
        <div class="card-body">
            <p class="mb-4">Penjualan Hari Ini</p>
            <p class="fs-30 mb-2">Rp. <?= number_format($hari_ini) ?> </p>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-5 col-5 mb-4 stretch-card transparent">
    <div class="card card-dark-blue">
        <div class="card-body">
            <p class="mb-4">Penjualan Bulan Ini</p>
            <p class="fs-30 mb-2">Rp. <?= number_format($bulan_ini) ?></p>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-5 col-5 mb-4 stretch-card transparent">
    <div class="card card-light-blue">
        <div class="card-body">
            <p class="mb-4">Transaksi Hari Ini</p>
            <p class="fs-30 mb-2"><?= number_format($transaksi) ?></p>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-5 col-5 mb-4 stretch-card transparent">
    <div class="card card-light-danger">
        <div class="card-body">
            <p class="mb-4">Produk</p>
            <p class="fs-30 mb-2"><?= number_format($produk) ?> </p>
        </div>
    </div>
</div>




<div class="col-md-6 grid-margin stretch-card">
    <?php
    $nama_now = date('M');
    $nama_1 = date('M', strtotime("-1 month"));
    $nama_2 = date('M', strtotime("-2 month"));
    $nama_3 = date('M', strtotime("-3 month"));
    $nama_4 = date('M', strtotime("-4 month"));
    $nama_5 = date('M', strtotime("-5 month"));
    
   

    $tanggal = date("Y-m");
    $this->db->select('sum(tagihan) as total')->from('transaksi')->where("DATE_FORMAT(tanggal, '%Y-%m') =", $tanggal);
    $bulan_ini = $this->db->get()->row()->total;

    $tanggal = date("Y-m", strtotime("-1 month"));
    $this->db->select('sum(tagihan) as total')->from('transaksi')->where("DATE_FORMAT(tanggal, '%Y-%m') =", $tanggal);
    $bulan_1 = $this->db->get()->row()->total;

    $tanggal = date("Y-m", strtotime("-2 month"));
    $this->db->select('sum(tagihan) as total')->from('transaksi')->where("DATE_FORMAT(tanggal, '%Y-%m') =", $tanggal);
    $bulan_2 = $this->db->get()->row()->total;

    $tanggal = date("Y-m", strtotime("-3 month"));
    $this->db->select('sum(tagihan) as total')->from('transaksi')->where("DATE_FORMAT(tanggal, '%Y-%m') =", $tanggal);
    $bulan_3 = $this->db->get()->row()->total;

    $tanggal = date("Y-m", strtotime("-4 month"));
    $this->db->select('sum(tagihan) as total')->from('transaksi')->where("DATE_FORMAT(tanggal, '%Y-%m') =", $tanggal);
    $bulan_4 = $this->db->get()->row()->total;

    $tanggal = date("Y-m", strtotime("-5 month"));
    $this->db->select('sum(tagihan) as total')->from('transaksi')->where("DATE_FORMAT(tanggal, '%Y-%m') =", $tanggal);
    $bulan_5 = $this->db->get()->row()->total;

    if($bulan_1==NULL) {$bulan_1 = 0; }
    if($bulan_2==NULL) {$bulan_2 = 0; }
    if($bulan_3==NULL) {$bulan_3 = 0; }
    if($bulan_4==NULL) {$bulan_4 = 0; }
    if($bulan_5==NULL) {$bulan_5 = 0; }
    
    ?>
    <div class="card">
        <div class="card-body">
            <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

            <script>
            const xValues = ["<?= $nama_5?>", "<?= $nama_4?>", "<?= $nama_3?>", "<?= $nama_2?>", "<?= $nama_1?>",
                "<?= $nama_now?>"
            ];

            const yValues = [<?= $bulan_5 ?>, <?= $bulan_4 ?>, <?= $bulan_3 ?>, <?= $bulan_2 ?>, <?= $bulan_1 ?>,
                <?= $bulan_ini ?>
            ];

            const barColors = ["red", "green", "blue", "orange", "brown", "yellow"];

            new Chart("myChart", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: "Penjualan 5 Bulan Terakhir"
                    }
                }
            });
            </script>
        </div>
    </div>
</div>