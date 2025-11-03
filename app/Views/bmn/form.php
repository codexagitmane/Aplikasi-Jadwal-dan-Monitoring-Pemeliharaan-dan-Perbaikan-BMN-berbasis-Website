<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="mb-4">
    <h1 class="h4 mb-0"><?= esc($pageTitle); ?></h1>
    <p class="text-muted">Lengkapi informasi BMN dengan detail yang akurat.</p>
</div>
<div class="card shadow-sm border-0">
    <div class="card-body">
        <?= form_open_multipart(isset($item) ? 'bmn/edit/' . $item['id'] : 'bmn/create'); ?>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nama BMN</label>
                <input type="text" name="name" class="form-control <?= isset($validation) && $validation->hasError('name') ? 'is-invalid' : ''; ?>" value="<?= old('name', $item['name'] ?? ''); ?>" required>
                <?php if (isset($validation) && $validation->hasError('name')): ?>
                    <div class="invalid-feedback"><?= esc($validation->getError('name')); ?></div>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <label class="form-label">Kode BMN</label>
                <input type="text" name="code" class="form-control <?= isset($validation) && $validation->hasError('code') ? 'is-invalid' : ''; ?>" value="<?= old('code', $item['code'] ?? ''); ?>" required>
                <?php if (isset($validation) && $validation->hasError('code')): ?>
                    <div class="invalid-feedback"><?= esc($validation->getError('code')); ?></div>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <label class="form-label">Kategori</label>
                <input type="text" name="category" class="form-control <?= isset($validation) && $validation->hasError('category') ? 'is-invalid' : ''; ?>" value="<?= old('category', $item['category'] ?? ''); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Lokasi</label>
                <input type="text" name="location" class="form-control <?= isset($validation) && $validation->hasError('location') ? 'is-invalid' : ''; ?>" value="<?= old('location', $item['location'] ?? ''); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Kondisi</label>
                <input type="text" name="condition" class="form-control <?= isset($validation) && $validation->hasError('condition') ? 'is-invalid' : ''; ?>" value="<?= old('condition', $item['condition'] ?? ''); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Foto</label>
                <input type="file" name="image" class="form-control <?= isset($validation) && $validation->hasError('image') ? 'is-invalid' : ''; ?>">
                <?php if (isset($validation) && $validation->hasError('image')): ?>
                    <div class="invalid-feedback"><?= esc($validation->getError('image')); ?></div>
                <?php endif; ?>
            </div>
            <div class="col-12">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3"><?= old('description', $item['description'] ?? ''); ?></textarea>
            </div>
        </div>
        <div class="mt-4 d-flex justify-content-between">
            <a href="<?= site_url('bmn'); ?>" class="btn btn-light">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        <?= form_close(); ?>
    </div>
</div>
<?= $this->endSection(); ?>
