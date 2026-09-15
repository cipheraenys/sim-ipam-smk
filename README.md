# SIM-IPAM Lab SMK

![CI](https://github.com/cipheraenys/sim-ipam-smk/actions/workflows/ci.yml/badge.svg)
![PHP](https://img.shields.io/badge/php-7.4-777BB4?logo=php&logoColor=white)
![CodeIgniter](https://img.shields.io/badge/codeigniter-4.0.5-EF4238?logo=codeigniter&logoColor=white)
![License](https://img.shields.io/github/license/cipheraenys/sim-ipam-smk)
![Version](https://img.shields.io/github/v/tag/cipheraenys/sim-ipam-smk?label=version)

A simple IP Address Management (IPAM) web app for tracking IPv4 allocations
across computer-lab rooms: dashboard statistics, full CRUD with duplicate
prevention, per-room filtering, a subnetting calculator, and CSV export.

> Written in September 2020, restored from a local backup, and republished in
> September 2026. The application code keeps its original shape. Repository
> tooling was added during the restoration.

## Table of contents

- [Features](#features)
- [Tech stack](#tech-stack)
- [Requirements](#requirements)
- [Getting started](#getting-started)
- [Project structure](#project-structure)
- [License](#license)

---

## Features

- Dashboard statistics: total registered IPs, breakdown per device type,
  distribution per lab room
- Full IP allocation CRUD with form validation: IPv4 format, duplicate IP
  prevention within the same lab, MAC address format
- Filter by lab room and search by IP address, device name, or MAC address
- IPv4 subnetting calculator: subnet mask, wildcard mask, network address,
  broadcast, valid host range, total hosts
- Export all allocations to a CSV file
- Delete confirmation with SweetAlert2

## Tech stack

| Component | Version |
| --- | --- |
| CodeIgniter | 4.0.5 |
| PHP | 7.4 (intl and mbstring extensions) |
| MySQL / MariaDB | MariaDB 10.4 shipped with XAMPP |
| Bootstrap | 4.5.2 via CDN |
| FontAwesome | 5.14.0 via CDN |
| SweetAlert2 | v10 via CDN |

## Requirements

- PHP 7.4 or newer with the `intl` and `mbstring` extensions
- MySQL 5.7+ / MariaDB 10.3+
- Composer

## Getting started

1. Clone this repository and install dependencies:

   ```bash
   composer install
   ```

2. Create a `.env` file in the project root and adjust the database
   configuration:

   ```ini
   CI_ENVIRONMENT = development

   database.default.hostname = 127.0.0.1
   database.default.database = sim_ipam_smk
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi
   database.default.port     = 3306
   ```

3. Create the database:

   ```sql
   CREATE DATABASE sim_ipam_smk CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

4. Run the migration and the seeder (the seeder ships 10 sample lab devices):

   ```bash
   php spark migrate
   php spark db:seed IpamSeeder
   ```

5. Start the development server:

   ```bash
   php spark serve
   ```

   The app is available at `http://localhost:8080`.

## Project structure

```
app/
├── Config/Routes.php          # route definitions
├── Controllers/
│   ├── Dashboard.php          # statistics for the landing page
│   ├── Ipam.php               # CRUD, filtering, CSV export
│   └── Calculator.php         # subnetting calculator
├── Database/
│   ├── Migrations/            # ip_allocations table
│   └── Seeds/IpamSeeder.php   # 10 sample lab devices
├── Helpers/network_helper.php # IPv4 math (64-bit safe)
├── Models/IpamModel.php       # model + validation rules
└── Views/                     # Bootstrap 4 pages
```

## License

[MIT](LICENSE)
