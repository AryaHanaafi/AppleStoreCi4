<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Struk Pesanan #<?= esc($transaksi['id']) ?></title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            color: #000;
        }

        .container {
            width: 280px;
            /* Lebar umum kertas struk thermal */
            margin: auto;
        }

        .header,
        .footer {
            text-align: center;
        }

        h1 {
            font-size: 16px;
            text-align: center;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        p {
            margin: 2px 0;
        }

        .transaction-details,
        .items-table,
        .summary {
            margin: 15px 0;
        }

        .items-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .items-table td {
            padding: 3px 0;
        }

        .price {
            text-align: right;
        }

        .separator {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }

        @page {
            size: auto;
            margin: 5mm;
        }

        @media print {
            body {
                margin: 0;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>Apple Store</h1>
            <p>Jl. Jalan Sehat No.08</p>
            <p>Telepon: 0812-3456-7890</p>
        </div>

        <div class="separator"></div>

        <div class="transaction-details">
            <table>
                <tr>
                    <td>No. Struk</td>
                    <td>: #<?= esc($transaksi['id']) ?></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>: <?= date('d/m/Y H:i', strtotime($transaksi['created_at'])) ?></td>
                </tr>
                <tr>
                    <td>Pelanggan</td>
                    <td>: <?= esc($transaksi['username']) ?></td>
                </tr>
            </table>
        </div>

        <div class="separator"></div>

        <div class="items-table">
            <table>
                <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td colspan="2"><?= esc($item['nama']) ?></td>
                        </tr>
                        <tr>
                            <td><?= esc($item['jumlah']) ?> x
                                <?= number_format($item['subtotal_harga'] / $item['jumlah']) ?>
                            </td>
                            <td class="price"><?= number_format($item['subtotal_harga']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="separator"></div>

        <div class="summary">
            <table>
                <tbody>
                    <tr>
                        <td>Subtotal</td>
                        <td class="price"><?= number_format($transaksi['total_harga'] - $transaksi['ongkir']) ?></td>
                    </tr>
                    <tr>
                        <td>Ongkos Kirim</td>
                        <td class="price"><?= number_format($transaksi['ongkir']) ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">TOTAL</td>
                        <td class="price" style="font-weight: bold;"><?= number_format($transaksi['total_harga']) ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="separator"></div>

        <div class="footer">
            <p>Terima kasih telah berbelanja!</p>
            <p>Barang yang sudah dibeli tidak dapat ditukar.</p>
        </div>
    </div>

    <script>
        // Otomatis panggil dialog print saat halaman selesai dimuat
        window.onload = function () {
            window.print();
        }
    </script>

</body>

</html>