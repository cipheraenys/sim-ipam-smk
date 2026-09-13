# SIM-IPAM Lab SMK

![CI](https://github.com/cipheraenys/sim-ipam-smk/actions/workflows/ci.yml/badge.svg)
![PHP](https://img.shields.io/badge/php-7.4-777BB4?logo=php&logoColor=white)
![CodeIgniter](https://img.shields.io/badge/codeigniter-4.0.5-EF4238?logo=codeigniter&logoColor=white)
![License](https://img.shields.io/github/license/cipheraenys/sim-ipam-smk)
![Version](https://img.shields.io/github/v/tag/cipheraenys/sim-ipam-smk?label=version)

A simple IP Address Management (IPAM) web app for tracking IPv4 allocations
across computer-lab rooms: dashboard statistics, full CRUD with duplicate
prevention, per-room filtering, a subnetting calculator, and CSV export.

> Written in September 2020 and restored from a local
> backup and republished in September 2026. The application code keeps its
> original shape. Repository tooling was added during the restoration.

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