<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk T Mart</title>
    <style>
    body {
        font-family: 'Courier New', Courier, monospace;
        font-size: 12px;
        margin: 0;
        padding: 0;
        width: 300px;
        text-align: center;
    }

    .header,
    .footer {
        text-align: center;
    }

    .header {
        margin-bottom: 10px;
    }

    .footer {
        margin-top: 10px;
        font-size: 10px;
    }

    .separator {
        border-top: 1px solid #000;
        margin: 5px 0;
    }

    table {
        width: 100%;
        margin-bottom: 10px;
    }

    table td {
        padding: 2px 0;
        font-size: 12px;
    }

    .right {
        text-align: right;
    }

    .bold {
        font-weight: bold;
    }

    .total td {
        font-size: 14px;
        font-weight: bold;
    }

    .line {
        border-top: 1px solid #000;
        margin-top: 10px;
    }
    </style>
</head>

<body>

    <!-- Header T Mart -->
    <div class="header">
        <div>T Mart</div>
        <div>Jl. Imam Bonjol 06, Jabar</div>
        <div>Telp. 85934556210</div>
    </div>

    <div class="separator"></div>

    <!-- No Nota dan Pelanggan -->
    <table>
        <tr>
            <td>No. Nota</td>
            <td>: #<?= $nota ?></td>
        </tr>
        <tr>
            <td>Pelanggan</td>
            <td>: <?= $transaksi->nama; ?></td>
        </tr>
    </table>

    <div class="separator"></div>

    <!-- Detail Transaksi -->
    <table>
        <?php 
        $item = 0;
        $total = 0;
        foreach($detail_transaksi as $data){ 
            $subtotal = $data['jumlah'] * $data['harga'];
            $diskon = ($subtotal * $data['diskon']) /100;
            $subtotal_setelah_diskon = $subtotal - $diskon; // Harga setelah diskon

            $total += $subtotal_setelah_diskon;
            ?>
        ?>
        <tr>
            <td colspan="3" class="bold"><?= $data['nama']; ?></td>
        </tr>
        <tr>
            <td><?= $data['jumlah'] ?> PCS</td>
            <td class="right">Rp. <?= number_format($data['harga']) ?></td>
            <td class="right">Rp. <?= number_format($subtotal_setelah_diskon) ?></td>
        </tr>
        <?php 
        $total +=  $subtotal_setelah_diskon; 
        $item += $data['jumlah']; 
        } 
        ?>
    </table>

    <div class="separator"></div>

    <!-- Total Tagihan -->
    <table class="total">
        <tr>
            <td>Total Tagihan:</td>
            <td class="right">Rp. <?= number_format($subtotal_setelah_diskon); ?></td>
        </tr>
    </table>

    <div class="separator"></div>

    <!-- Jumlah Item -->
    <div>Jumlah Item : <?= $item ?> Pcs</div>

    <div class="line"></div>

    <!-- Footer -->
    <div class="footer">
        ------- Terimakasih --------<br>
        =======================
    </div>

    <script>
    window.print();
    </script>
</body>

</html>