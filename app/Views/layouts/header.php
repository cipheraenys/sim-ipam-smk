<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'SIM-IPAM Lab SMK') ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-0">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('/') ?>">
            <i class="fas fa-network-wired"></i> SIM-IPAM TKJ
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?= url_is('/') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= site_url('/') ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li class="nav-item <?= url_is('ipam*') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= site_url('ipam') ?>"><i class="fas fa-list"></i> Data Alokasi IP</a>
                </li>
                <li class="nav-item <?= url_is('calculator*') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= site_url('calculator') ?>"><i class="fas fa-calculator"></i> Kalkulator Subnet</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">