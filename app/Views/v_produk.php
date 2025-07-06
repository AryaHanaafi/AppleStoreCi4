<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashData('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mt-3">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php if (session()->getFlashData('failed')): ?>
    <div class="alert alert-danger alert-dismissible fade show mt-3">
        <?= session()->getFlashData('failed') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mt-4">
    <button class="btn btn-dark btn-sm rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="bi bi-plus-circle me-1"></i> Tambah Produk
    </button>
    <a class="btn btn-primary btn-sm rounded-pill px-4" href="<?= base_url() ?>produk/download">
        <i class="bi bi-download me-1"></i> Download Data
    </a>
</div>

<?php foreach ($kategori as $namaKategori => $produkList): ?>
    <?php if (!empty($produkList)): ?>
        <div class="mt-5">
            <h3 class="mb-3 border-bottom pb-2"><?= esc($namaKategori) ?></h3>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                <?php foreach ($produkList as $produk): ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0 rounded-4 product-card">
                            <div class="card-body d-flex flex-column text-center p-3">
                                <p class="text-muted small mb-1">APPLE INTELLIGENCE</p>
                                <h5 class="fw-bold mb-2"><?= esc($produk['nama']) ?></h5>
                                <div class="flex-grow-1 d-flex align-items-center justify-content-center">
                                    <?php if ($produk['foto'] && file_exists("img/" . $produk['foto'])): ?>
                                        <img src="<?= base_url("img/" . $produk['foto']) ?>" class="img-fluid rounded-3"
                                            style="max-height: 160px; object-fit: contain;">
                                    <?php else: ?>
                                        <img src="https://via.placeholder.com/300x200?text=No+Image" class="img-fluid rounded-3"
                                            style="max-height: 160px; object-fit: contain;">
                                    <?php endif; ?>
                                </div>
                                <p class="text-muted small mt-3 mb-1">Harga: Rp <?= number_format($produk['harga'], 0, ',', '.') ?>
                                </p>
                                <p class="text-muted small">Stok: <?= esc($produk['jumlah']) ?></p>
                                <div class="d-flex justify-content-center gap-2 mt-3">
                                    <button class="btn btn-outline-dark btn-sm rounded-pill px-3" data-bs-toggle="modal"
                                        data-bs-target="#editModal-<?= $produk['id'] ?>"><i class="bi bi-pencil"></i></button>
                                    <a href="<?= base_url('produk/delete/' . $produk['id']) ?>"
                                        class="btn btn-outline-danger btn-sm rounded-pill px-3"
                                        onclick="return confirm('Yakin hapus?')"><i class="bi bi-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal-<?= $produk['id'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="<?= base_url('produk/edit/' . $produk['id']) ?>" method="post"
                                    enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="modal-header">
                                        <h5 class="modal-title">Ubah Produk</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3"><label>Nama</label>
                                            <input type="text" name="nama" class="form-control" value="<?= $produk['nama'] ?>"
                                                required>
                                        </div>
                                        <div class="mb-3"><label>Harga</label>
                                            <input type="number" name="harga" class="form-control" value="<?= $produk['harga'] ?>"
                                                required>
                                        </div>
                                        <div class="mb-3"><label>Jumlah</label>
                                            <input type="number" name="jumlah" class="form-control" value="<?= $produk['jumlah'] ?>"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Kategori</label>
                                            <select name="kategori" class="form-select" required>
                                                <option value="">-- Pilih Kategori --</option>
                                                <option value="iPhone" <?= $produk['kategori'] === 'iPhone' ? 'selected' : '' ?>>iPhone
                                                </option>
                                                <option value="MacBook" <?= $produk['kategori'] === 'MacBook' ? 'selected' : '' ?>>
                                                    MacBook</option>
                                                <option value="iPad" <?= $produk['kategori'] === 'iPad' ? 'selected' : '' ?>>iPad
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <img src="<?= base_url("img/" . $produk['foto']) ?>" width="100">
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="check" value="1">
                                                <label class="form-check-label">Ganti Foto</label>
                                            </div>
                                            <input type="file" class="form-control mt-2" name="foto">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<!-- Modal Tambah -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= base_url('produk') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3"><label>Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3"><label>Harga</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>
                    <div class="mb-3"><label>Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" required>
                    </div>
                    <div class="mb-3"><label>Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="iPhone">iPhone</option>
                            <option value="MacBook">MacBook</option>
                            <option value="iPad">iPad</option>
                        </select>
                    </div>
                    <div class="mb-3"><label>Foto</label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CSS: Hover + Fix Layout -->
<style>
    .product-card {
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        transform-style: preserve-3d;
        will-change: transform;
    }

    .product-card:hover {
        transform: scale(1.03) rotateX(4deg);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .card-body img {
        transition: transform 0.3s;
    }

    .product-card:hover img {
        transform: scale(1.05);
    }

    .card h5 {
        font-size: 1.1rem;
    }
</style>

<?= $this->endSection() ?>