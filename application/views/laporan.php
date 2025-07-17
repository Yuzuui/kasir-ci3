<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    th,
    td {
        padding: 5px;
    }
    </style>
</head>

<body>
    <center>
        <h3>Laporan Penjualan
            <?= date_format(date_create($tanggal1),"d M Y");?> Sampai <?= date_format(date_create($tanggal2),"d M Y");?>
        </h3>
        <table border=1>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>No Nota</th>
                    <th>Nominal</th>
                    <th>Pelanggan</th>
                </tr>
            </thead>
            <tbody>
                <?php $total=0; $no = 1; foreach($transaksi as $data){ ?>
                <tr>
                    <td> <?= $no++;?> </td>
                    <td> <?= date_format(date_create($data['tanggal']),"d M Y");?></td>
                    <td> <?= $data['nota'];?> </td>
                    <td style="txt-align: right;">RP. <?= number_format($data['tagihan']); ?></td>
                    <td><?= $data['nama']; ?></td>

                </tr>
                <?php $total=$total+$data['tagihan']; $no++; }?>
                <tr>
                    <td colspan=3>Total</td>
                    <td style="txt-align: right;">Rp.<?= number_format($total); ?></td>
                </tr>
            </tbody>
        </table>
    </center>
    <script>
    window.print();
    </script>
</body>

</html>