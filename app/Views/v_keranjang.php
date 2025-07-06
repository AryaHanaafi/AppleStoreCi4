<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bolder display-5 mb-0">Keranjang Anda</h1>
        <?php if (!empty($items)): ?>
            <h2 class="h5 text-secondary fw-normal mb-0"><?= count($items) ?> Produk</h2>
        <?php endif; ?>
    </div>

    <?php if (session()->getFlashData('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashData('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (!empty($items)): ?>
        <?php echo form_open('keranjang/edit') ?>
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4"
                                    style="border-top-left-radius: 0.5rem; border-bottom-left-radius: 0.5rem;">PRODUK</th>
                                <th scope="col" class="text-center">KUANTITAS</th>
                                <th scope="col" class="text-end">SUBTOTAL</th>
                                <th scope="col" class="text-end pe-4"
                                    style="border-top-right-radius: 0.5rem; border-bottom-right-radius: 0.5rem;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#"><img src="<?= base_url('img/' . $item['options']['foto']) ?>"
                                                    class="img-fluid rounded-3" style="width: 90px;"
                                                    alt="<?= $item['name'] ?>"></a>
                                            <div class="ms-3">
                                                <p class="fw-bold mb-1 fs-5"><?= $item['name'] ?></p>
                                                <p class="text-secondary small mb-0">
                                                    <?= number_to_currency($item['price'], 'IDR', 'id_ID', 0) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center"
                                            style="width: 130px; margin: auto;">
                                            <button type="button" class="btn btn-link px-2"
                                                onclick="changeQty('qty<?= $i ?>', -1, this)">
                                                <i class="bi bi-dash-lg text-dark"></i>
                                            </button>
                                            <input type="number" min="1" name="qty<?= $i ?>" id="qty<?= $i ?>"
                                                value="<?= $item['qty'] ?>"
                                                class="form-control form-control-sm text-center fw-medium">
                                            <button type="button" class="btn btn-link px-2"
                                                onclick="changeQty('qty<?= $i ?>', 1, this)">
                                                <i class="bi bi-plus-lg text-dark"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <p class="mb-0 fw-bold fs-5">
                                            <?= number_to_currency($item['subtotal'], 'IDR', 'id_ID', 0) ?>
                                        </p>
                                    </td>
                                    <td class="text-end">
                                        <a href="<?= base_url('keranjang/delete/' . $item['rowid']) ?>"
                                            class="btn btn-link text-danger" title="Hapus produk">
                                            <i class="bi bi-x-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between pt-3">
                    <a href="<?= base_url('/') ?>" class="btn btn-outline-dark"><i class="bi bi-arrow-left me-2"></i>Lanjut
                        Belanja</a>
                    <button type="submit" class="btn btn-dark"><i class="bi bi-arrow-repeat me-2"></i>Perbarui
                        Keranjang</button>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm" style="position: sticky; top: 2rem;">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4">Ringkasan Belanja</h4>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-secondary">Subtotal (<?= $i - 1 ?> produk)</span>
                            <span class="fw-medium"><?= number_to_currency($total, 'IDR', 'id_ID', 0) ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-secondary">Biaya Pengiriman</span>
                            <span class="fw-medium">Akan dihitung</span>
                        </div>
                        <hr class="my-3">
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold fs-5">Total</span>
                            <span class="fw-bolder fs-5"><?= number_to_currency($total, 'IDR', 'id_ID', 0) ?></span>
                        </div>
                        <a href="<?= base_url('checkout') ?>" class="btn btn-primary btn-lg w-100 rounded-3">
                            Lanjut ke Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close() ?>
    <?php else: ?>
        <div class="text-center py-5">
            <i class="bi bi-cart-x" style="font-size: 6rem; color: #6c757d;"></i>
            <h3 class="fw-bold h2 mt-4">Keranjang Anda Kosong</h3>
            <p class="text-secondary mt-2 mb-4 fs-5">Sepertinya Anda belum menambahkan produk apapun.</p>
            <a href="<?= base_url('/') ?>" class="btn btn-primary fw-semibold btn-lg rounded-pill px-5 py-2">Mulai
                Belanja</a>
        </div>
    <?php endif; ?>
</div>

<script>
    function changeQty(inputId, delta, button) {
        const input = document.getElementById(inputId);
        const currentQty = parseInt(input.value, 10);
        const newQty = Math.max(1, currentQty + delta);
        input.value = newQty;

    }
</script>

<?= $this->endSection() ?>