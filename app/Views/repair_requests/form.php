<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="mb-4">
    <h1 class="h4 mb-0"><?= esc($pageTitle); ?></h1>
    <p class="text-muted">Lengkapi detail permohonan perbaikan BMN.</p>
</div>
<div class="card shadow-sm border-0">
    <div class="card-body">
        <?= form_open(isset($item) ? 'repair-requests/edit/' . $item['id'] : 'repair-requests/create'); ?>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">BMN</label>
                <select name="bmn_id" class="form-select <?= isset($validation) && $validation->hasError('bmn_id') ? 'is-invalid' : ''; ?>" required>
                    <option value="">Pilih BMN</option>
                    <?php foreach ($bmnItems as $bmn): ?>
                        <option value="<?= $bmn['id']; ?>" <?= old('bmn_id', $item['bmn_id'] ?? '') == $bmn['id'] ? 'selected' : ''; ?>><?= esc($bmn['name']); ?> (<?= esc($bmn['code']); ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Judul Permohonan</label>
                <input type="text" name="title" class="form-control <?= isset($validation) && $validation->hasError('title') ? 'is-invalid' : ''; ?>" value="<?= old('title', $item['title'] ?? ''); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Pemohon</label>
                <select name="requested_by" class="form-select" required>
                    <option value="">Pilih Pemohon</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user['id']; ?>" <?= old('requested_by', $item['requested_by'] ?? '') == $user['id'] ? 'selected' : ''; ?>><?= esc($user['name']); ?> (<?= esc($user['role']); ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tanggal Permohonan</label>
                <input type="date" name="requested_date" class="form-control" value="<?= old('requested_date', $item['requested_date'] ?? ''); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Prioritas</label>
                <select name="priority" class="form-select" required>
                    <option value="rendah" <?= old('priority', $item['priority'] ?? '') === 'rendah' ? 'selected' : ''; ?>>Rendah</option>
                    <option value="sedang" <?= old('priority', $item['priority'] ?? '') === 'sedang' ? 'selected' : ''; ?>>Sedang</option>
                    <option value="tinggi" <?= old('priority', $item['priority'] ?? '') === 'tinggi' ? 'selected' : ''; ?>>Tinggi</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Status</label>
                <input type="text" name="status" class="form-control" value="<?= old('status', $item['status'] ?? 'Menunggu Persetujuan'); ?>" required>
            </div>
            <div class="col-12">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="4" required><?= old('description', $item['description'] ?? ''); ?></textarea>
            </div>
            <div class="col-12">
                <label class="form-label">Catatan</label>
                <textarea name="notes" class="form-control" rows="3"><?= old('notes', $item['notes'] ?? ''); ?></textarea>
            </div>
        </div>
        <div class="mt-4 d-flex justify-content-between">
            <a href="<?= site_url('repair-requests'); ?>" class="btn btn-light">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        <?= form_close(); ?>
    </div>
</div>
<?= $this->endSection(); ?>
