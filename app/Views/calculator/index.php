<?= view('layouts/header') ?>

<h3 class="mb-4"><i class="fas fa-calculator"></i> <?= esc($title) ?></h3>

<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-white"><i class="fas fa-input-text"></i> Input</div>
            <div class="card-body">
                <?php if (! empty($error)): ?>
                <div class="alert alert-danger py-2"><?= esc($error) ?></div>
                <?php endif; ?>
                <form method="post" action="<?= site_url('calculator/calculate') ?>">
                    <div class="form-group">
                        <label>Alamat IPv4</label>
                        <input type="text" name="ip_address" value="<?= esc($ip) ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Prefiks CIDR</label>
                        <select name="subnet_cidr" class="form-control">
                            <?php for ($i = 8; $i <= 30; $i++): ?>
                            <option value="<?= $i ?>" <?= $cidr == $i ? 'selected' : '' ?>>/<?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-equals"></i> Hitung Subnet
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-white"><i class="fas fa-project-diagram"></i> Hasil Perhitungan</div>
            <div class="card-body">
                <?php if (empty($result)): ?>
                <p class="text-muted text-center py-4">Masukkan alamat IP lalu klik Hitung Subnet.</p>
                <?php else: ?>
                <h5 class="text-center"><span class="badge badge-dark"><?= esc($result['ip'] . '/' . $result['prefix']) ?></span></h5>
                <table class="table table-striped">
                    <tr><th>Subnet Mask</th><td><code><?= esc($result['netmask']) ?></code></td></tr>
                    <tr><th>Wildcard Mask</th><td><code><?= esc($result['wildcard']) ?></code></td></tr>
                    <tr><th>Network Address</th><td><code><?= esc($result['network']) ?></code></td></tr>
                    <tr><th>Broadcast Address</th><td><code><?= esc($result['broadcast']) ?></code></td></tr>
                    <tr><th>Rentang Host Valid</th>
                        <td><code><?= esc($result['first_host'] . ' - ' . $result['last_host']) ?></code></td></tr>
                    <tr><th>Jumlah Host</th><td><strong><?= number_format($result['total_hosts'], 0, ',', '.') ?></strong> host</td></tr>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= view('layouts/footer') ?>