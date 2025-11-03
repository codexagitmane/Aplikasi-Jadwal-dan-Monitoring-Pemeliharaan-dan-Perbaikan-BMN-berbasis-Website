<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Cetak Permohonan Perbaikan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-size: 14px; }
        .signature-box { min-height: 100px; border: 1px solid #ccc; padding: 1rem; }
    </style>
</head>
<body onload="window.print()">
<div class="container my-4">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Form Permohonan Perbaikan BMN</h2>
        <p class="mb-0 text-muted">Sistem Jadwal & Monitoring BMN</p>
    </div>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th style="width: 30%">Judul Permohonan</th>
                <td><?= esc($item['title']); ?></td>
            </tr>
            <tr>
                <th>BMN</th>
                <td><?= esc($item['bmn_name']); ?></td>
            </tr>
            <tr>
                <th>Pemohon</th>
                <td><?= esc($item['requester_name']); ?> (<?= esc($item['requester_role']); ?>)</td>
            </tr>
            <tr>
                <th>Tanggal Permohonan</th>
                <td><?= date('d M Y', strtotime($item['requested_date'])); ?></td>
            </tr>
            <tr>
                <th>Prioritas</th>
                <td class="text-uppercase"><?= esc($item['priority']); ?></td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td><?= nl2br(esc($item['description'])); ?></td>
            </tr>
            <?php if (! empty($item['notes'])): ?>
            <tr>
                <th>Catatan</th>
                <td><?= nl2br(esc($item['notes'])); ?></td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="mt-5">
        <h5 class="fw-semibold">Tanda Tangan</h5>
        <div class="row g-4">
            <?php foreach ($signatures as $signature): ?>
                <div class="col-md-4">
                    <div class="signature-box">
                        <p class="mb-1 fw-semibold text-capitalize"><?= esc(str_replace('_', ' ', $signature['role'])); ?></p>
                        <p class="mb-1 text-muted"><?= esc($signature['signer_name'] ?? ''); ?></p>
                        <p class="mb-4 text-muted">Ditandatangani pada <?= date('d M Y H:i', strtotime($signature['created_at'])); ?></p>
                        <p class="mb-0 fst-italic">"<?= esc($signature['signature']); ?>"</p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</body>
</html>
