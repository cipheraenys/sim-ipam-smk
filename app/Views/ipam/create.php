<?= view('layouts/header') ?>

<?php
$errors = session()->getFlashdata('errors');
?>

<h3 class="mb-4"><i class="fas fa-plus"></i> <?= esc($title) ?></h3>

<?php if (! empty($errors)): ?>
<div class="alert alert-danger">
    <ul class="mb-0">
        <?php foreach ($errors as $err): ?>
        <li><?= esc($err) ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <form method="post" action="<?= site_url('ipam/store') ?>">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Alamat IP <span class="text-danger">*</span></label>
                    <input type="text" name="ip_address" value="<?= esc(old('ip_address')) ?>"
                           class="form-control" placeholder="192.168.10.1" required>
                </div>
                <div class="form-group col-md-2">
                    <label>Prefix CIDR <span class="text-danger">*</span></label>
                    <select name="subnet_cidr" class="form-control">
                        <?php foreach (['/8', '/16', '/20', '/24', '/25', '/26', '/27', '/28', '/29', '/30'] as $p): ?>
                        <option value="<?= $p ?>" <?= old('subnet_cidr', '/24') === $p ? 'selected' : '' ?>><?= $p ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Nama Perangkat <span class="text-danger">*</span></label>
                    <input type="text" name="device_name" value="<?= esc(old('device_name')) ?>"
                           class="form-control" placeholder="PC-SISWA-03" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Tipe Perangkat <span class="text-danger">*</span></label>
                    <select name="device_type" class="form-control">
                        <?php foreach (['Router', 'Switch', 'PC Client', 'Access Point', 'Server'] as $t): ?>
                        <option value="<?= $t ?>" <?= old('device_type') === $t ? 'selected' : '' ?>><?= $t ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Ruangan Lab <span class="text-danger">*</span></label>
                    <select name="lab_room" class="form-control">
                        <?php foreach (['Lab TKJ 1', 'Lab TKJ 2', 'Ruang Server', 'Lab Fiber'] as $l): ?>
                        <option value="<?= $l ?>" <?= old('lab_room') === $l ? 'selected' : '' ?>><?= $l ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Status Alokasi <span class="text-danger">*</span></label>
                    <select name="status" class="form-control">
                        <?php foreach (['Static', 'DHCP Pool', 'Reserved'] as $s): ?>
                        <option value="<?= $s ?>" <?= old('status') === $s ? 'selected' : '' ?>><?= $s ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>MAC Address</label>
                    <input type="text" name="mac_address" value="<?= esc(old('mac_address')) ?>"
                           class="form-control" placeholder="08:00:27:1A:2B:3C">
                    <small class="text-muted">Format XX:XX:XX:XX:XX:XX, boleh kosong.</small>
                </div>
                <div class="form-group col-md-8">
                    <label>Catatan</label>
                    <textarea name="notes" class="form-control" rows="2"
                              placeholder="cth: kabel meja baris 2, port ether3 switch"><?= esc(old('notes')) ?></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
            <a href="<?= site_url('ipam') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </form>
    </div>
</div>

<?= view('layouts/footer') ?>