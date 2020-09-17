<?= view('layouts/header') ?>

<h3 class="mb-4"><i class="fas fa-tachometer-alt"></i> <?= esc($title) ?></h3>

<div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title">Total IP Terdaftar</h6>
                    <h2 class="mb-0"><?= $stats['total'] ?></h2>
                </div>
                <i class="fas fa-project-diagram fa-3x"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card text-white bg-success mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title">IP Static</h6>
                    <h2 class="mb-0"><?= $stats['static'] ?></h2>
                </div>
                <i class="fas fa-thumbtack fa-3x"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card text-white bg-info mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title">DHCP Pool</h6>
                    <h2 class="mb-0"><?= $stats['dhcp_pool'] ?></h2>
                </div>
                <i class="fas fa-random fa-3x"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title">Reserved</h6>
                    <h2 class="mb-0"><?= $stats['reserved'] ?></h2>
                </div>
                <i class="fas fa-lock fa-3x"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header bg-white"><i class="fas fa-hdd"></i> Jumlah Perangkat per Tipe</div>
            <ul class="list-group list-group-flush">
                <?php foreach ($stats['devices'] as $tipe => $jumlah): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= esc($tipe) ?>
                    <span class="badge badge-dark badge-pill"><?= $jumlah ?></span>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header bg-white"><i class="fas fa-door-open"></i> Sebaran per Ruangan Lab</div>
            <ul class="list-group list-group-flush">
                <?php if (empty($stats['labs'])): ?>
                <li class="list-group-item text-muted">Belum ada data lab.</li>
                <?php else: ?>
                <?php foreach ($stats['labs'] as $lab => $jumlah): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="<?= site_url('ipam?lab=' . urlencode($lab)) ?>"><?= esc($lab) ?></a>
                    <span class="badge badge-secondary badge-pill"><?= $jumlah ?></span>
                </li>
                <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white"><i class="fas fa-history"></i> 5 Data Alokasi Terbaru</div>
    <table class="table table-striped table-hover mb-0">
        <thead class="thead-dark">
            <tr>
                <th>Alamat IP</th>
                <th>Subnet</th>
                <th>Nama Perangkat</th>
                <th>Ruangan Lab</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($recent_ips)): ?>
            <tr><td colspan="5" class="text-center text-muted">Belum ada data.</td></tr>
            <?php else: ?>
            <?php foreach ($recent_ips as $item): ?>
            <tr>
                <td><strong><?= esc($item['ip_address']) ?></strong></td>
                <td><?= esc($item['subnet_cidr']) ?></td>
                <td><?= esc($item['device_name']) ?></td>
                <td><?= esc($item['lab_room']) ?></td>
                <td><span class="badge badge-light"><?= esc($item['status']) ?></span></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= view('layouts/footer') ?>