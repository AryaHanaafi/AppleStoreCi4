<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="apple-home-container">

    <section
        class="iphone-hero-section position-relative vh-100 d-flex align-items-center justify-content-center text-center overflow-hidden text-white">
        <div class="hero-content-overlay position-relative" style="z-index: 2;">
            <div class="container">
                <h2 class="iphone-hero-title animate-on-scroll">Pelengkap Sempurna.</h2>
                <p class="iphone-hero-subtitle animate-on-scroll" style="transition-delay: 100ms;">Jelajahi ekosistem
                    Apple yang luar biasa.</p>
                <div class="mt-4 animate-on-scroll" style="transition-delay: 200ms;">
                    <a href="#collections" class="apple-button primary">Lihat Koleksi</a>
                </div>
            </div>
        </div>
        <div class="hero-background-image position-absolute top-0 start-0 w-100 h-100" style="z-index: 1;">
            <video autoplay loop muted playsinline id="hero-parallax-video">
                <source
                    src="https://www.apple.com/105/media/us/iphone/family/2025/e7ff365a-cb59-4ce9-9cdf-4cb965455b69/anim/welcome/xlarge.mp4"
                    type="video/mp4">
                Browser Anda tidak mendukung tag video.
            </video>
        </div>
    </section>

    <section class="synergy-section animate-on-scroll py-5">
        <div class="container">
            <h2 class="synergy-section-title">Semakin Hebat Bersama.</h2>
            <div class="synergy-showcase p-4 rounded-4">
                <div class="row">
                    <div class="col-lg-5 col-md-12">
                        <div class="synergy-menu pt-4">
                            <div class="synergy-tab active" data-target="#watch-synergy-content">
                                <div class="synergy-tab-header">
                                    <strong>iPhone & Ipad</strong>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </div>
                                <div class="synergy-tab-body">
                                    <p>Kombinasi iPhone dan iPad menciptakan ekosistem portabel yang tak tertandingi
                                        untuk produktivitas dan kreativitas tanpa batas. Keduanya dirancang untuk
                                        bekerja bersama secara mulus, memungkinkan Anda memulai sebuah ide di satu
                                        perangkat dan menyempurnakannya di perangkat lain.</p>
                                </div>
                            </div>
                            <div class="synergy-tab" data-target="#airpods-synergy-content">
                                <div class="synergy-tab-header">
                                    <strong>iPad & MacBook</strong>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-chevron-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </div>
                                <div class="synergy-tab-body">
                                    <p>Tentu, ini draf deskripsinya.

                                        Deskripsi iPhone & iPad
                                        Kombinasi iPhone dan iPad menciptakan ekosistem portabel yang tak tertandingi
                                        untuk produktivitas dan kreativitas tanpa batas. Keduanya dirancang untuk
                                        bekerja bersama secara mulus, memungkinkan Anda memulai sebuah ide di satu
                                        perangkat dan menyempurnakannya di perangkat lain.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <div class="synergy-content-container">
                            <div class="synergy-content active" id="watch-synergy-content">
                                <img src="https://www.apple.com/assets-www/en_WW/ipad/image_accordion/xlarge/ipad_iphone_e51610d57.jpg"
                                    alt="Apple Watch dan iPhone">
                            </div>
                            <div class="synergy-content" id="airpods-synergy-content">
                                <img src="https://www.apple.com/assets-www/en_WW/ipad/image_accordion/xlarge/ipad_mac_1374e255c.jpg"
                                    alt="AirPods dan iPhone">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="collections">
        <?php foreach ($produk_by_kategori as $kategori => $items): ?>
            <section class="main-collection py-5 bg-white border-top">
                <div class="container">
                    <div class="text-center mb-5">
                        <h2 class="display-5 fw-bold text-dark animate-on-scroll"><?= esc($kategori) ?></h2>
                    </div>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
                        <?php foreach ($items as $index => $item): ?>
                            <div class="col d-flex animate-on-scroll" style="transition-delay: <?= $index * 100 ?>ms;">
                                <div class="product-card-apple w-100 position-relative">
                                    <div class="image-container-apple">
                                        <img src="<?= base_url('img/' . $item['foto']) ?>" alt="<?= esc($item['nama']) ?>"
                                            class="product-image-apple">
                                    </div>
                                    <div class="card-body-apple">
                                        <h5 class="card-title-apple"><?= esc($item['nama']) ?></h5>
                                        <p class="card-price-apple text-muted mb-2">
                                            <?= number_to_currency($item['harga'], 'IDR') ?>
                                        </p>
                                    </div>
                                    <div class="button-container-apple">
                                        <button class="btn btn-secondary rounded-pill btn-sm px-4 btn-buy"
                                            data-id="<?= $item['id'] ?>" data-nama="<?= esc($item['nama']) ?>"
                                            data-harga="<?= $item['harga'] ?>" data-foto="<?= $item['foto'] ?>">
                                            Beli
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </section>
        <?php endforeach ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const parallaxVideo = document.getElementById('hero-parallax-video');
        window.addEventListener('scroll', () => {
            const scrollPosition = window.pageYOffset;
            if (parallaxVideo) {
                parallaxVideo.style.transform = `translateY(${scrollPosition * 0.3}px)`;
            }
        });

        const tabs = document.querySelectorAll('.synergy-tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                if (tab.classList.contains('active')) return;
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                document.querySelectorAll('.synergy-content').forEach(content => {
                    content.classList.remove('active');
                });
                const targetContent = document.querySelector(tab.dataset.target);
                if (targetContent) targetContent.classList.add('active');
            });
        });

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
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Ditambahkan!',
                                html: `<b>${data.nama}</b> telah masuk ke keranjang.`,
                                showConfirmButton: false,
                                timer: 2500,
                                timerProgressBar: true,
                                toast: true,
                                position: 'top-end',
                                background: '#f8f9fa',
                                color: '#1d1d1f',
                                footer: `<a href="<?= base_url('keranjang') ?>" class="btn btn-dark rounded-pill px-4">Lihat Keranjang</a>`
                            });
                            const counter = document.getElementById('cart-counter');
                            if (counter) counter.textContent = data.total_items;
                        } else {
                            Swal.fire('Gagal', data.message || 'Terjadi kesalahan.', 'error');
                        }
                    })
                    .catch(() => Swal.fire('Gagal', 'Tidak dapat terhubung ke server.', 'error'));
            });
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });
        const elementsToAnimate = document.querySelectorAll('.animate-on-scroll');
        elementsToAnimate.forEach(el => observer.observe(el));
    });
</script>

<?= $this->endSection() ?>