<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <?php foreach ($produk_by_kategori as $kategori => $items): ?>
        <h2 class="section-title mb-4"><?= esc($kategori) ?></h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php foreach ($items as $item): ?>
                <div class="col d-flex">
                    <div class="card product-card shadow-sm w-100">
                        <div class="image-container">
                            <img src="<?= base_url('img/' . $item['foto']) ?>" alt="<?= esc($item['nama']) ?>"
                                class="product-image">
                        </div>
                        <div class="card-body d-flex flex-column text-center">
                            <h5 class="card-title mb-1 fw-semibold"><?= esc($item['nama']) ?></h5>
                            <p class="text-muted mb-1"><?= number_to_currency($item['harga'], 'IDR') ?></p>
                            <span class="badge bg-light text-dark rounded-pill small mb-3"><?= esc($item['kategori']) ?></span>
                            <button class="btn btn-dark rounded-pill mt-auto px-4 py-2 btn-buy" data-id="<?= $item['id'] ?>"
                                data-nama="<?= esc($item['nama']) ?>" data-harga="<?= $item['harga'] ?>"
                                data-foto="<?= $item['foto'] ?>">
                                <i class="bi bi-cart-plus me-1"></i> Beli
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    <?php endforeach ?>
</div>

<!-- SweetAlert + AJAX -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.btn-buy').forEach(button => {
        button.addEventListener('click', function () {
            const data = {
                id: this.dataset.id,
                nama: this.dataset.nama,
                harga: this.dataset.harga,
                foto: this.dataset.foto
            };

            fetch("<?= base_url('keranjang') ?>", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams(data)
            })
                .then(res => res.json())
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        html: `<b>${data.nama}</b> telah ditambahkan ke keranjang.<br><br>
           <a href="<?= base_url('keranjang') ?>" class="btn btn-sm btn-dark rounded-pill px-4">Lihat Keranjang</a>`,
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: () => {
                            const b = Swal.getHtmlContainer().querySelector('a');
                            b.addEventListener('click', () => Swal.close());
                        }
                    });

                    const counter = document.getElementById('cart-counter');
                    if (counter) counter.textContent = data.total_items;
                })
                .catch(() => Swal.fire('Gagal', 'Coba lagi nanti.', 'error'));
        });
    });
</script>

<!-- CSS Premium -->
<style>
    .section-title {
        font-size: 1.75rem;
        font-weight: 600;
        text-align: center;
        border-bottom: 1px solid #eee;
        padding-bottom: .5rem;
    }

    .product-card {
        border-radius: 18px;
        overflow: hidden;
        transition: transform 0.35s ease, box-shadow 0.35s ease;
        display: flex;
        flex-direction: column;
        background: #fff;
    }

    .product-card:hover {
        transform: translateY(-6px) scale(1.01);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.06);
    }

    .image-container {
        height: 240px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }

    .product-image {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .card-title {
        font-size: 1rem;
        font-weight: 600;
    }

    .btn-buy {
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.2s ease-in-out;
    }

    .btn-buy:hover {
        background-color: #000;
    }

    @media (max-width: 576px) {
        .image-container {
            height: 200px;
        }
    }
</style>

<?= $this->endSection() ?>