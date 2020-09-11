<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class IpamSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            [
                'ip_address'  => '192.168.10.1',
                'subnet_cidr' => '/24',
                'device_name' => 'MIKROTIK-RB750-CORE',
                'device_type' => 'Router',
                'mac_address' => '08:55:31:A1:B2:C1',
                'lab_room'    => 'Ruang Server',
                'status'      => 'Static',
                'notes'       => 'ether1 ke ISP, ether2 trunk ke switch Lab TKJ 1',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'ip_address'  => '192.168.10.2',
                'subnet_cidr' => '/24',
                'device_name' => 'CISCO-CATALYST-2960',
                'device_type' => 'Switch',
                'mac_address' => '00:1A:A1:33:44:55',
                'lab_room'    => 'Lab TKJ 1',
                'status'      => 'Static',
                'notes'       => 'Switch distribusi meja siswa',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'ip_address'  => '192.168.10.10',
                'subnet_cidr' => '/24',
                'device_name' => 'PC-GURU-TKJ1',
                'device_type' => 'PC Client',
                'mac_address' => 'D4:5D:64:12:34:56',
                'lab_room'    => 'Lab TKJ 1',
                'status'      => 'Static',
                'notes'       => 'PC instruktur di meja depan',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'ip_address'  => '192.168.10.11',
                'subnet_cidr' => '/24',
                'device_name' => 'PC-SISWA-01',
                'device_type' => 'PC Client',
                'mac_address' => 'D4:5D:64:12:34:57',
                'lab_room'    => 'Lab TKJ 1',
                'status'      => 'DHCP Pool',
                'notes'       => 'Baris 1 meja 1',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'ip_address'  => '192.168.10.12',
                'subnet_cidr' => '/24',
                'device_name' => 'PC-SISWA-02',
                'device_type' => 'PC Client',
                'mac_address' => 'D4:5D:64:12:34:58',
                'lab_room'    => 'Lab TKJ 1',
                'status'      => 'DHCP Pool',
                'notes'       => 'Baris 1 meja 2',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'ip_address'  => '192.168.10.100',
                'subnet_cidr' => '/24',
                'device_name' => 'SRV-DEBIAN10-WEB',
                'device_type' => 'Server',
                'mac_address' => 'B8:27:EB:44:55:66',
                'lab_room'    => 'Ruang Server',
                'status'      => 'Static',
                'notes'       => 'Debian 10, Apache2 + Bind9 untuk praktikum ASJ',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'ip_address'  => '192.168.10.254',
                'subnet_cidr' => '/24',
                'device_name' => 'AP-TP-LINK-EAP110',
                'device_type' => 'Access Point',
                'mac_address' => '80:2A:A8:99:88:77',
                'lab_room'    => 'Lab TKJ 1',
                'status'      => 'Static',
                'notes'       => 'Hotspot siswa, SSID: TKJ-LAB1',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'ip_address'  => '192.168.20.1',
                'subnet_cidr' => '/24',
                'device_name' => 'MIKROTIK-LAB2-GW',
                'device_type' => 'Router',
                'mac_address' => '08:55:31:C3:D4:E5',
                'lab_room'    => 'Lab TKJ 2',
                'status'      => 'Static',
                'notes'       => 'Gateway Lab TKJ 2, VLAN 20',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'ip_address'  => '192.168.20.11',
                'subnet_cidr' => '/24',
                'device_name' => 'PC-SISWA-LAB2-01',
                'device_type' => 'PC Client',
                'mac_address' => 'D4:5D:64:56:78:9A',
                'lab_room'    => 'Lab TKJ 2',
                'status'      => 'DHCP Pool',
                'notes'       => 'Baris 1 meja 1',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'ip_address'  => '192.168.20.253',
                'subnet_cidr' => '/24',
                'device_name' => 'AP-LAB2-UTAMA',
                'device_type' => 'Access Point',
                'mac_address' => '80:2A:A8:11:22:33',
                'lab_room'    => 'Lab TKJ 2',
                'status'      => 'Reserved',
                'notes'       => 'Dipakai saat uji kompetensi keahlian',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        $this->db->table('ip_allocations')->insertBatch($data);
    }
}