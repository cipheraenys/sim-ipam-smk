<?= view('layouts/header') ?>

<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success alert-dismissible fade show">
    <?= esc(session()->getFlashdata('success')) ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
<div class="alert alert-danger alert-dismissible fade show">
    <?= esc(session()->getFlashdata('error')) ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
<?php endif; ?>

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-list"></i> <?= esc($title) ?></h5>
        <div>
            <a href="<?= site_url('ipam/export') ?>" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-file-csv"></i> Export CSV
            </a>
            <a href="<?= site_url('ipam/create') ?>" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i> Tambah Alokasi
            </a>
        </div>
    </div>
    <div class="card-body py-3">
        <form method="get" action="<?= site_url('ipam') ?>" class="form-inline">
            <select name="lab" class="custom-select custom-select-sm mr-2" onchange="this.form.submit()">
                <option value="">Semua Ruangan Lab</option>
                <?php
                $labs = ['Lab TKJ 1', 'Lab TKJ 2', 'Ruang Server', 'Lab Fiber'];
                foreach ($labs as $lab): ?>
                <option value="<?= esc($lab) ?>" <?= $current_lab === $lab ? 'selected' : '' ?>><?= esc($lab) ?></option>
                <?php endforeach; ?>
            </select>
            <input type="text" name="q" value="<?= esc($search) ?>" class="form-control form-control-sm mr-2"
                   placeholder="Cari IP / nama perangkat / MAC..." style="min-width: 260px;">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Cari</button>
        </form>
    </div>
    <table class="table table-striped table-hover table-bordered mb-0">
        <thead class="thead-dark">
            <tr>
                <th class="text-center">No</th>
                <th>Alamat IP</th>
                <th>Subnet</th>
                <th>Nama Perangkat</th>
                <th>Tipe</th>
                <th>MAC Address</th>
                <th>Ruangan Lab</th>
                <th>Status</th>
                <th>Catatan</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($allocations)): ?>
            <tr><td colspan="10" class="text-center text-muted py-4">Tidak ada data alokasi IP.</td></tr>
            <?php else: ?>
            <?php
            $badges = [
                'Static'    => 'badge-primary',
                'DHCP Pool' => 'badge-info',
                'Reserved'  => 'badge-warning',
            ];
            $icons = [
                'Router'       => 'fa-route',
                'Switch'       => 'fa-ethernet',
                'PC Client'    => 'fa-desktop',
                'Access Point' => 'fa-wifi',
                'Server'       => 'fa-server',
            ];
            ?>
            <?php foreach ($allocations as $no => $item): ?>
            <tr>
                <td class="text-center"><?= $no + 1 ?></td>
                <td><strong><?= esc($item['ip_address']) ?></strong></td>
                <td><?= esc($item['subnet_cidr']) ?></td>
                <td><?= esc($item['device_name']) ?></td>
                <td><i class="fas <?= $icons[$item['device_type']] ?? 'fa-hdd' ?>"></i> <?= esc($item['device_type']) ?></td>
                <td><code><?= esc($item['mac_address'] ?? '-') ?></code></td>
                <td><?= esc($item['lab_room']) ?></td>
                <td><span class="badge <?= $badges[$item['status']] ?? 'badge-secondary' ?>"><?= esc($item['status']) ?></span></td>
                <td><small><?= esc($item['notes'] ?? '-') ?></small></td>
                <td class="text-center text-nowrap">
                    <a href="<?= site_url('ipam/edit/' . $item['id']) ?>" class="btn btn-warning btn-sm" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="<?= site_url('ipam/delete/' . $item['id']) ?>" class="btn btn-danger btn-sm btn-delete" title="Hapus">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= view('layouts/footer') ?>