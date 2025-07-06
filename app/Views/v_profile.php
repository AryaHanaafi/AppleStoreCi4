<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<main class="py-5 bg-body-tertiary">
    <div class="container">

        <div class="mb-5 text-center">
            <h1 class="fw-bolder display-5">Riwayat Transaksi</h1>
            <p class="text-secondary fs-4 fw-light">Halo, <?= esc($username) ?>! Klik pada setiap pesanan untuk melihat
                detail lengkapnya.</p>
        </div>

        <div class="list-group">
            <?php if (!empty($buy)): ?>
                <?php foreach ($buy as $index => $transaction): ?>
                    <?php
                    // Persiapan Variabel
                    $isCompleted = $transaction['status'] == "1";
                    $statusConfig = $isCompleted
                        ? ['class' => 'text-bg-success', 'text' => 'Selesai']
                        : ['class' => 'text-bg-warning', 'text' => 'Diproses'];

                    $foto_url = ($product[$transaction['id']][0]['foto'] ?? null) && file_exists(FCPATH . 'img/' . $product[$transaction['id']][0]['foto'])
                        ? base_url('img/' . $product[$transaction['id']][0]['foto'])
                        : 'https://via.placeholder.com/150/f1f3f5/6c757d?text=Produk';
                    ?>

                    <a href="#"
                        class="list-group-item list-group-item-action bg-white rounded-4 shadow-sm p-3 p-md-4 mb-3 border-0"
                        data-bs-toggle="modal" data-bs-target="#detailModal-<?= $transaction['id'] ?>">
                        <div class="d-flex flex-wrap flex-md-nowrap align-items-center">
                            <img src="<?= $foto_url ?>" alt="Produk" class="rounded-3 me-4"
                                style="width: 72px; height: 72px; object-fit: cover;">

                            <div class="flex-grow-1 my-2 my-md-0">
                                <p class="fw-bold text-dark fs-5 mb-1">Pesanan #<?= esc($transaction['id']) ?></p>
                                <p class="text-secondary small mb-0">
                                    <?= date('d F Y, H:i', strtotime($transaction['created_at'])) ?>
                                </p>
                            </div>

                            <div class="text-md-end ms-md-4 mt-2 mt-md-0">
                                <p class="fw-bolder text-dark fs-4 mb-2">
                                    <?= number_to_currency($transaction['total_harga'], 'IDR', 'id_ID') ?>
                                </p>
                                <span class="badge rounded-pill fs-6 fw-semibold py-2 px-3 <?= $statusConfig['class'] ?>">
                                    <?= $statusConfig['text'] ?>
                                </span>
                            </div>

                            <div class="d-none d-md-block ms-4 ps-2">
                                <i class="bi bi-chevron-right fs-4 text-secondary"></i>
                            </div>
                        </div>
                    </a>

                    <div class="modal fade" id="detailModal-<?= $transaction['id'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content border-0 shadow-lg" style="border-radius: 1rem;">
                                <div class="modal-header border-0 p-4 pb-3">
                                    <div>
                                        <h1 class="modal-title fs-4 fw-bold">Detail Pesanan #<?= esc($transaction['id']) ?></h1>
                                        <p class="text-secondary small mb-0">Dipesan pada
                                            <?= date('d F Y, H:i', strtotime($transaction['created_at'])) ?>
                                        </p>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">

                                    <div class="d-flex align-items-center mb-4">
                                        <div class="flex-fill text-center">
                                            <p class="fw-bold text-primary mb-1">Dibuat</p>
                                            <div class="progress" style="height: 4px;">
                                                <div class="progress-bar" role="progressbar" style="width: 100%;"
                                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="flex-fill text-center mx-3">
                                            <p class="fw-bold <?= $isCompleted ? 'text-primary' : 'text-body-tertiary' ?> mb-1">
                                                Selesai</p>
                                            <div class="progress" style="height: 4px;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: <?= $isCompleted ? '100%' : '0%' ?>;"
                                                    aria-valuenow="<?= $isCompleted ? '100' : '0' ?>" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-body-tertiary p-4 rounded-4">
                                        <h4 class="fs-6 fw-semibold mb-3"><i class="bi bi-box-seam me-2"></i>Produk Dipesan</h4>
                                        <?php if (isset($product[$transaction['id']])): ?>
                                            <?php foreach ($product[$transaction['id']] as $item_index => $item): ?>
                                                <div
                                                    class="d-flex align-items-start py-2 <?= ($item_index < count($product[$transaction['id']]) - 1) ? 'border-bottom' : '' ?>">
                                                    <div class="flex-grow-1">
                                                        <p class="mb-0 fw-medium"><?= esc($item['nama']) ?>
                                                            (x<?= esc($item['jumlah']) ?>)</p>
                                                        <p class="mb-0 small text-body-tertiary">
                                                            <?= number_to_currency($item['harga'], 'IDR', 'id_ID') ?>
                                                        </p>
                                                    </div>
                                                    <p class="mb-0 fw-semibold text-dark">
                                                        <?= number_to_currency($item['subtotal_harga'], 'IDR', 'id_ID') ?>
                                                    </p>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <hr>
                                        <div class="d-flex justify-content-between text-secondary">
                                            <span>Subtotal</span><span><?= number_to_currency($transaction['total_harga'] - $transaction['ongkir'], 'IDR', 'id_ID') ?></span>
                                        </div>
                                        <div class="d-flex justify-content-between text-secondary mt-1"><span>Ongkos
                                                Kirim</span><span><?= number_to_currency($transaction['ongkir'], 'IDR', 'id_ID') ?></span>
                                        </div>
                                        <div class="d-flex justify-content-between text-dark fw-bold fs-5 mt-3">
                                            <span>TOTAL</span><span><?= number_to_currency($transaction['total_harga'], 'IDR', 'id_ID') ?></span>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <h4 class="fs-6 fw-semibold mb-2"><i class="bi bi-truck me-2"></i>Alamat Pengiriman</h4>
                                        <p class="text-secondary small mb-0 lh-base"><?= esc($transaction['alamat']) ?></p>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <a href="<?= site_url('transaksi/cetak/' . $transaction['id']) ?>" target="_blank"
                                        class="btn btn-primary">
                                        <i class="bi bi-printer me-1"></i> Cetak Struk
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="bi bi-basket3-fill display-1 text-black-50"></i>
                    <h3 class="fw-bold h2 mt-4">Belum Ada Transaksi</h3>
                    <p class="text-secondary mt-2 mb-4 fs-5">Mulai belanja sekarang dan semua pesanan Anda akan muncul di
                        sini.</p>
                    <a href="/shop" class="btn btn-primary fw-semibold btn-lg rounded-pill px-5 py-2">Mulai Belanja</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?= $this->endSection() ?>