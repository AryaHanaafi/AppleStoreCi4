<?= $this->extend('layout_clear') ?>
<?= $this->section('content') ?>

<?php
// Atribut input dikembalikan seperti semula
$username = ['name' => 'username', 'id' => 'username', 'class' => 'form-control', 'placeholder' => 'Enter username', 'style' => 'background-color: rgba(255, 255, 255, 0.5); border: none;'];
$password = ['name' => 'password', 'id' => 'password', 'class' => 'form-control', 'placeholder' => 'Enter password', 'type' => 'password', 'style' => 'background-color: rgba(255, 255, 255, 0.5); border: none;'];
?>

<style>
  .glass-card-light {
    background: rgba(255, 255, 255, 0.3);
    /* Transparansi disesuaikan untuk background terang */
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 1.5rem;
    border: 1px solid rgba(255, 255, 255, 0.6);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  /* Mengembalikan warna gelap untuk teks agar terbaca */
  .glass-card-light h2 {
    color: #333;
  }

  .glass-card-light .text-muted,
  .glass-card-light .form-label {
    color: #555 !important;
  }

  .glass-card-light .small,
  .glass-card-light .small a {
    color: #666 !important;
  }

  /* Input group icon disesuaikan */
  .input-group-text {
    background-color: rgba(255, 255, 255, 0.5);
    border: none;
  }

  .input-group-text .bi {
    color: #555;
  }

  .form-control::placeholder {
    color: #888;
    opacity: 1;
  }

  .form-control:focus {
    background-color: rgba(255, 255, 255, 0.7);
    box-shadow: none;
  }
</style>

<section class="min-vh-100 d-flex align-items-center justify-content-center"
  style="background: linear-gradient(to top,rgb(255, 255, 255),rgb(196, 196, 196));">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5">

        <div class="p-5 glass-card-light">

          <div class="text-center mb-4">
            <img src="<?= base_url('NiceAdmin/assets/img/ipcircle.png') ?>" alt="Logo" width="60" class="mb-2">
            <h2 class="fw-semibold">Sign in to Apple Panel</h2>
            <p class="text-muted">Use your Apple ID to continue</p>
          </div>

          <?php if (session()->getFlashData('failed')): ?>
            <div class="alert alert-danger text-center">
              <?= session()->getFlashData('failed') ?>
            </div>
          <?php endif; ?>

          <?= form_open('login') ?>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-person"></i></span>
              <?= form_input($username) ?>
            </div>
          </div>

          <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-lock"></i></span>
              <?= form_password($password) ?>
            </div>
          </div>

          <div class="d-grid mb-3">
            <?= form_submit('submit', 'Login', ['class' => 'btn btn-dark rounded-pill py-2']) ?>
          </div>
          <?= form_close() ?>

          <div class="text-center text-muted mt-3 small">
            Belum punya akun? <a href="#" class="text-decoration-none">Daftar</a>
          </div>

        </div>

      </div>
    </div>
  </div>
</section>

<script>
  const toggleBtn = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('password');

  if (toggleBtn) {
    const toggleIcon = document.getElementById('toggleIcon');
    toggleBtn.addEventListener('click', () => {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);

      if (toggleIcon) {
        toggleIcon.classList.toggle('bi-eye');
        toggleIcon.classList.toggle('bi-eye-slash');
      }
    });
  }
</script>

<?= $this->endSection() ?>