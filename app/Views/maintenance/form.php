<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="mb-4">
    <h1 class="h4 mb-0"><?= esc($pageTitle); ?></h1>
    <p class="text-muted">Susun jadwal pemeliharaan dan perbaikan secara rapi.</p>
</div>
<div class="card shadow-sm border-0">
    <div class="card-body">
        <?= form_open(isset($item) ? 'maintenance/edit/' . $item['id'] : 'maintenance/create'); ?>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">BMN</label>
                <select name="bmn_id" class="form-select <?= isset($validation) && $validation->hasError('bmn_id') ? 'is-invalid' : ''; ?>" required>
                    <option value="">Pilih BMN</option>
                    <?php foreach ($bmnItems as $bmn): ?>
                        <option value="<?= $bmn['id']; ?>" <?= old('bmn_id', $item['bmn_id'] ?? '') == $bmn['id'] ? 'selected' : ''; ?>><?= esc($bmn['name']); ?> - <?= esc($bmn['code']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Judul Kegiatan</label>
                <input type="text" name="title" class="form-control <?= isset($validation) && $validation->hasError('title') ? 'is-invalid' : ''; ?>" value="<?= old('title', $item['title'] ?? ''); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tanggal Pelaksanaan</label>
                <input type="date" name="scheduled_date" class="form-control <?= isset($validation) && $validation->hasError('scheduled_date') ? 'is-invalid' : ''; ?>" value="<?= old('scheduled_date', $item['scheduled_date'] ?? ''); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Jenis</label>
                <select name="type" class="form-select" required>
                    <option value="maintenance" <?= old('type', $item['type'] ?? '') === 'maintenance' ? 'selected' : ''; ?>>Pemeliharaan</option>
                    <option value="repair" <?= old('type', $item['type'] ?? '') === 'repair' ? 'selected' : ''; ?>>Perbaikan</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Status</label>
                <input type="text" name="status" class="form-control" value="<?= old('status', $item['status'] ?? 'Terjadwal'); ?>" required>
            </div>
            <div class="col-12">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3"><?= old('description', $item['description'] ?? ''); ?></textarea>
            </div>
        </div>
        <div class="mt-4 d-flex justify-content-between">
            <a href="<?= site_url('maintenance'); ?>" class="btn btn-light">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        <?= form_close(); ?>
    </div>
</div>
<?= $this->endSection(); ?>
