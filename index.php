<?php
// Baca data dari profile.json
$jsonPath = __DIR__ . '/profile.json';
$data = [];
if (is_readable($jsonPath)) {
    $raw = file_get_contents($jsonPath);
    $data = json_decode($raw, true) ?: [];
}

// Helper escape
function e($s) {
    return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8');
}

// Defaults
$avatar = $data['avatar'] ?? 'https://placehold.co/240x240?text=Avatar';
$name = $data['name'] ?? 'Nama Anda';
$role = $data['role'] ?? 'Peran';
$title = $data['title'] ?? '';
$bio = $data['bio'] ?? '';
$resumeUrl = $data['resumeUrl'] ?? '#';
$contacts = $data['contacts'] ?? [];
$skills = $data['skills'] ?? [];
$experiences = $data['experiences'] ?? [];
$projects = $data['projects'] ?? [];
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Profil Fazli Ibni fikhar ramadhan - <?= e($name) ?></title>

  <!-- Bootstrap CSS (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body { padding-top: 70px; background: #f6f8fa; }
    .avatar { width: 160px; height:160px; object-fit:cover; border-radius:50%; }
    .card-profile { border-radius: 12px; }
    .skill-badge { margin:3px 4px 3px 0; }
  </style>
</head>
<body>
  <!-- NAVBAR BOOTSTRAP -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom fixed-top">
    <div class="container">
      <a class="navbar-brand text-primary fw-bold" href="#home"><?= e($name) ?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navCollapse" aria-controls="navCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navCollapse">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
          <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
          <li class="nav-item"><a class="nav-link" href="#experience">Experience</a></li>
          <li class="nav-item"><a class="nav-link" href="#projects">Projects</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
          <li class="nav-item ms-2">
            <a class="btn btn-primary btn-sm" href="<?= e($resumeUrl) ?>" target="_blank" rel="noopener">Unduh Resume</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container" id="home">
    <div class="row g-4">
      <!-- SIDEBAR -->
      <aside class="col-lg-4">
        <div class="card card-profile shadow-sm p-3">
          <div class="d-flex flex-column align-items-center text-center">
            <img src="<?= e($avatar) ?>" alt="Avatar" class="avatar mb-3">
            <h4 class="mb-0"><?= e($name) ?></h4>
            <small class="text-muted"><?= e($role) ?></small>
            <p class="mt-3"><?= e($title) ?></p>
          </div>

          <hr>

          <h6 class="mb-2">Profil</h6>
          <ul class="list-group list-group-flush mb-2">
            <?php if (count($contacts) === 0): ?>
              <li class="list-group-item">Tidak ada kontak</li>
            <?php else: ?>
              <?php foreach ($contacts as $c): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <span class="text-muted small"><?= e($c['type'] ?? '') ?></span>
                  <span class="text-end"><a href="<?= e($c['value'] ?? '#') ?>" target="_blank" rel="noopener"><?= e($c['value'] ?? '') ?></a></span>
                </li>
              <?php endforeach; ?>
            <?php endif; ?>
          </ul>

          <h6 class="mb-2 mt-3">Skills</h6>
          <div>
            <?php foreach ($skills as $s): ?>
              <span class="badge bg-light text-dark skill-badge"><?= e($s) ?></span>
            <?php endforeach; ?>
          </div>
        </div>
      </aside>

      <!-- CONTENT -->
      <section class="col-lg-8">
        <div class="card shadow-sm card-profile p-4 mb-4" id="about">
          <h3>Profil</h3>
          <p class="text-muted"><?= e($bio) ?></p>
          <a class="btn btn-outline-primary btn-sm" href="<?= e($resumeUrl) ?>" target="_blank" rel="noopener">Lihat Resume</a>
        </div>

        <div id="experience" class="mb-4">
          <h4>Pengalaman</h4>
          <?php if (count($experiences) === 0): ?>
            <p class="text-muted">Belum ada pengalaman tercantum.</p>
          <?php else: ?>
            <?php foreach ($experiences as $e): ?>
              <div class="card mb-3">
                <div class="card-body">
                  <div class="d-flex justify-content-between">
                    <h5 class="card-title mb-1"><?= e($e['position'] ?? '') ?></h5>
                    <small class="text-muted"><?= e($e['period'] ?? '') ?></small>
                  </div>
                  <h6 class="text-muted mb-2"><?= e($e['company'] ?? '') ?></h6>
                  <p class="card-text"><?= e($e['description'] ?? '') ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

        <div id="projects" class="mb-4">
          <h4>Proyek</h4>
          <?php if (count($projects) === 0): ?>
            <p class="text-muted">Belum ada proyek tercantum.</p>
          <?php else: ?>
            <div class="row">
              <?php foreach ($projects as $p): ?>
                <div class="col-md-6">
                  <div class="card mb-3">
                    <div class="card-body">
                      <h5 class="card-title"><a class="text-decoration-none" href="<?= e($p['url'] ?? '#') ?>" target="_blank" rel="noopener"><?= e($p['name'] ?? '') ?></a></h5>
                      <p class="text-muted small"><?= e($p['tech'] ?? '') ?></p>
                      <p class="card-text"><?= e($p['description'] ?? '') ?></p>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>

        <div id="contact" class="card p-3">
          <h5>Hubungi Saya</h5>
          <p class="text-muted">Gunakan kontak yang tertera di sidebar atau kirim email langsung.</p>
        </div>
      </section>
    </div>
  </main>
  
  <!-- Bootstrap JS (bundle includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>