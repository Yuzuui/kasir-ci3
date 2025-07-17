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
        <h3>Data Produk <?= $status;?></h3>
        <table class="table" border=1>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Kode Produk</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($produk as $data){ ?>
                <tr>
                    <td> <?= $data['nama'];?> </td>
                    <td>Rp. <?= number_format($data['harga']) ?></td>
                    <td class="right"><?= $data['stok']; ?></td>
                    <td class="right"><?= $data['barcode']; ?></td>

                </tr>
                <?php }?>
            </tbody>
        </table>
    </center>
    <script>
    window.print();
    </script>
</body>

</html>