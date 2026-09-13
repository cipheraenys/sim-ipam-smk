# Changelog

All notable changes to this project are documented in this file. The format
follows Keep a Changelog, and versions follow semantic versioning.

## [1.0.0] - 2020-09-22

### Added

- IP allocation CRUD with IPv4 validation, duplicate prevention per lab room,
  and MAC address format checks
- Dashboard statistics per allocation status, device type, and lab room
- Lab-room filter and text search across IP, device name, and MAC address
- IPv4 subnetting calculator (netmask, wildcard, network, broadcast, host
  range, total hosts)
- CSV export of all allocations
- Seed data with 10 sample lab devices across two subnets

## [Unreleased]

### Changed

- September 2026 restoration: repository tooling added around the untouched
  application code (CI workflow, EditorConfig, Dependabot for GitHub Actions,
  refreshed README and community files). Application behavior is unchanged.
- Removed the shipped `env` template from the repository; create `.env`
  manually following the README. The template contained only upstream defaults
  and no secrets.
