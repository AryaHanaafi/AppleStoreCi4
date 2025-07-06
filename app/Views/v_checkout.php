<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bolder display-5">Selesaikan Pesanan</h1>
        <p class="text-secondary fs-5 fw-light">Hanya beberapa langkah lagi untuk mendapatkan produk impian Anda.</p>
    </div>

    <?= form_open('buy') ?>
    <div class="row g-5">
        <div class="col-lg-7">
            <?= form_hidden('username', session()->get('username')) ?>
            <?= form_input(['type' => 'hidden', 'name' => 'total_harga', 'id' => 'total_harga']) ?>
            <?= form_input(['type' => 'hidden', 'name' => 'ongkir', 'id' => 'ongkir', 'value' => '0']) ?>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h4 class="mb-4 fw-bold d-flex align-items-center"><span
                            class="badge bg-primary rounded-circle me-3 fs-6">1</span> Kontak & Alamat Pengiriman</h4>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nama" value="<?= session()->get('username'); ?>"
                            readonly>
                        <label for="nama">Nama Penerima</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="alamat" name="alamat"
                            placeholder="Masukkan alamat lengkap" required>
                        <label for="alamat">Alamat Lengkap (Jalan, No. Rumah, Kelurahan, Kecamatan)</label>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="provinsi" required>
                                    <option selected disabled value="">Pilih provinsi...</option>
                                    <?php foreach ($provinsi as $p): ?>
                                        <option value="<?= $p->province_id ?>"><?= $p->province ?></option>
                                    <?php endforeach ?>
                                </select>
                                <label for="provinsi">Provinsi</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="kabupaten" required disabled>
                                    <option selected disabled value="">Pilih provinsi dulu</option>
                                </select>
                                <label for="kabupaten">Kabupaten/Kota <span id="kabupaten-loader"
                                        class="spinner-border spinner-border-sm ms-2 d-none"
                                        role="status"></span></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="mb-4 fw-bold d-flex align-items-center"><span
                            class="badge bg-primary rounded-circle me-3 fs-6">2</span> Opsi Pengiriman</h4>
                    <div class="form-floating">
                        <select class="form-select" id="service" required disabled>
                            <option selected disabled value="">Pilih kab/kota dulu</option>
                        </select>
                        <label for="service">Layanan Pengiriman <span id="service-loader"
                                class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 shadow-sm" style="position: sticky; top: 2rem;">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">Ringkasan Pesanan</h4>

                    <ul class="list-group list-group-flush mb-3">
                        <?php foreach ($items as $item): ?>
                            <li class="list-group-item d-flex align-items-center px-0">
                                <img src="<?= base_url('img/' . $item['options']['foto']) ?>" class="rounded-2 me-3"
                                    width="60" alt="<?= $item['name'] ?>">
                                <div class="flex-grow-1">
                                    <strong class="d-block"><?= $item['name'] ?></strong>
                                    <small class="text-secondary">Qty: <?= $item['qty'] ?></small>
                                </div>
                                <span
                                    class="fw-medium"><?= number_to_currency($item['subtotal'], 'IDR', 'id_ID', 0) ?></span>
                            </li>
                        <?php endforeach ?>
                    </ul>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary">Subtotal</span>
                        <span><?= number_to_currency($total, 'IDR', 'id_ID', 0) ?></span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-secondary">Pengiriman</span>
                        <span id="ongkir_display" class="fw-medium">IDR 0</span>
                    </div>

                    <hr class="my-3">

                    <div class="d-flex justify-content-between border-top pt-3 fw-bold fs-5">
                        <span>Total Pembayaran</span>
                        <span id="total_display"><?= number_to_currency($total, 'IDR', 'id_ID', 0) ?></span>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 mt-4 rounded-3"><i
                            class="bi bi-shield-check me-2"></i> Lanjutkan Pembayaran</button>
                </div>
            </div>
        </div>
    </div>
    <?= form_close() ?>
</div>
<?= $this->endSection() ?>


<?= $this->section('script') ?>
<script>
    // Fungsionalitas inti SAMA SEPERTI KODE LAMA ANDA, 
    // hanya ditambahkan sedikit kode untuk menampilkan dan menyembunyikan spinner.
    $(document).ready(function () {
        let ongkir = 0;
        let total = <?= $total ?>;

        function updateTotal() {
            let totalHarga = total + ongkir;
            // Menggunakan format Rupiah tanpa desimal
            $('#ongkir_display').text(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(ongkir));
            $('#total_display').text(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(totalHarga));
            $('#total_harga').val(totalHarga);
            $('#ongkir').val(ongkir);
        }

        $('#provinsi').on('change', function () {
            const id = $(this).val();

            $('#kabupaten').html('<option>Pilih provinsi dulu</option>').prop('disabled', true);
            $('#service').html('<option>Pilih kab/kota dulu</option>').prop('disabled', true);

            $('#kabupaten-loader').removeClass('d-none'); // Tampilkan spinner

            $.getJSON("<?= site_url('getcity') ?>", { id_province: id }, function (data) {
                const results = data.rajaongkir.results;
                $('#kabupaten').html('<option selected disabled value="">Pilih kab/kota...</option>');
                results.forEach(city => {
                    $('#kabupaten').append(`<option value="${city.city_id}">${city.type} ${city.city_name}</option>`);
                });
            })
                .fail(function () {
                    $('#kabupaten').html('<option>Gagal memuat data</option>');
                })
                .always(function () {
                    $('#kabupaten-loader').addClass('d-none'); // Sembunyikan spinner
                    $('#kabupaten').prop('disabled', false);
                });
        });

        $('#kabupaten').on('change', function () {
            const destination = $(this).val();
            if (!destination) return;

            $('#service').html('<option>Pilih layanan...</option>').prop('disabled', true);
            $('#service-loader').removeClass('d-none'); // Tampilkan spinner

            $.getJSON("<?= site_url('getcost') ?>", {
                origin: 399, // ID Kota Semarang, sesuaikan jika perlu
                destination: destination,
                weight: 1000,
                courier: 'jne'
            }, function (data) {
                $('#service').html('<option selected disabled value="">Pilih layanan...</option>');
                const costs = data.rajaongkir.results[0].costs;
                costs.forEach(s => {
                    const price = s.cost[0].value;
                    const etd = s.cost[0].etd.replace(' HARI', '');
                    $('#service').append(`<option value="${price}">${s.service} - ${s.description} (Estimasi ${etd} hari)</option>`);
                });
            })
                .fail(function () {
                    $('#service').html('<option>Gagal memuat data</option>');
                })
                .always(function () {
                    $('#service-loader').addClass('d-none'); // Sembunyikan spinner
                    $('#service').prop('disabled', false);
                });
        });

        $('#service').on('change', function () {
            ongkir = parseInt($(this).val()) || 0;
            updateTotal();
        });

        // Panggil sekali saat halaman dimuat
        updateTotal();
    });
</script>
<?= $this->endSection() ?>