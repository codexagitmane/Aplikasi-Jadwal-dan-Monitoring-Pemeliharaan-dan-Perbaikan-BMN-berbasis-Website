<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card shadow-sm border-0 gradient-card gradient-primary text-white">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="mb-1 text-uppercase small fw-semibold">Total BMN</p>
                        <h2 class="fw-bold mb-0"><?= esc($bmnCount); ?></h2>
                    </div>
                    <i class="bi bi-box-seam fs-1"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 gradient-card gradient-success text-white">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="mb-1 text-uppercase small fw-semibold">Jadwal</p>
                        <h2 class="fw-bold mb-0"><?= esc($maintenanceCount); ?></h2>
                    </div>
                    <i class="bi bi-calendar-check fs-1"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 gradient-card gradient-warning text-white">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="mb-1 text-uppercase small fw-semibold">Permohonan</p>
                        <h2 class="fw-bold mb-0"><?= esc($repairCount); ?></h2>
                    </div>
                    <i class="bi bi-wrench-adjustable-circle fs-1"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 gradient-card gradient-info text-white">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="mb-1 text-uppercase small fw-semibold">Pengguna</p>
                        <h2 class="fw-bold mb-0"><?= esc($userCount); ?></h2>
                    </div>
                    <i class="bi bi-people fs-1"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Kalender Kegiatan</h5>
            </div>
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-0">
                <h6 class="mb-0">Permohonan Terbaru</h6>
            </div>
            <div class="list-group list-group-flush">
                <?php if (empty($latestRepairRequests)): ?>
                    <div class="list-group-item text-center text-muted">Belum ada permohonan terbaru.</div>
                <?php else: ?>
                    <?php foreach ($latestRepairRequests as $request): ?>
                        <a href="<?= site_url('repair-requests/detail/' . $request['id']); ?>" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1"><?= esc($request['title']); ?></h6>
                                <small class="text-muted"><?= date('d M Y', strtotime($request['requested_date'])); ?></small>
                            </div>
                            <small class="text-muted">Status: <?= esc(ucwords(str_replace('_', ' ', $request['status']))); ?></small>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0">
                <h6 class="mb-0">Jadwal Terdekat</h6>
            </div>
            <div class="list-group list-group-flush">
                <?php if (empty($upcomingMaintenances)): ?>
                    <div class="list-group-item text-center text-muted">Belum ada jadwal terdekat.</div>
                <?php else: ?>
                    <?php foreach ($upcomingMaintenances as $schedule): ?>
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1"><?= esc($schedule['title']); ?></h6>
                                <small class="text-muted"><?= date('d M Y', strtotime($schedule['scheduled_date'])); ?></small>
                            </div>
                            <small class="text-muted">Status: <?= esc(ucwords($schedule['status'])); ?></small>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        if (!calendarEl) {
            return;
        }
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 600,
            events: <?= json_encode($events); ?>,
            eventDisplay: 'block',
            displayEventTime: false,
        });
        calendar.render();
    });
</script>
<?= $this->endSection(); ?>
