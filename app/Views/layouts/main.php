<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($pageTitle ?? 'Sistem BMN'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/main.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/app.css'); ?>" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="<?= site_url('dashboard'); ?>">Sistem BMN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="<?= site_url('dashboard'); ?>"><i class="bi bi-speedometer"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('bmn'); ?>"><i class="bi bi-box-seam"></i> Data BMN</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('maintenance'); ?>"><i class="bi bi-calendar-check"></i> Jadwal</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('repair-requests'); ?>"><i class="bi bi-wrench-adjustable"></i> Permohonan</a></li>
                <?php if (user_has_role('admin')): ?>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('users'); ?>"><i class="bi bi-people"></i> Pengguna</a></li>
                <?php endif; ?>
            </ul>
            <div class="d-flex align-items-center gap-2">
                <span class="text-white small text-uppercase fw-semibold"><?= esc(current_user()['name'] ?? ''); ?> (<?= esc(session('role')); ?>)</span>
                <a class="btn btn-outline-light btn-sm" href="<?= site_url('logout'); ?>"><i class="bi bi-box-arrow-right"></i> Keluar</a>
            </div>
        </div>
    </div>
</nav>
<div class="container-fluid py-4">
    <?php if (session()->has('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= esc(session('message')); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= esc(session('error')); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?= $this->renderSection('content'); ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/main.min.js"></script>
<script src="<?= base_url('assets/js/app.js'); ?>"></script>
<?= $this->renderSection('scripts'); ?>
</body>
</html>
