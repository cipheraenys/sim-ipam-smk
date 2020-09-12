<?php

namespace App\Models;

use CodeIgniter\Model;

class IpamModel extends Model
{
    protected $table            = 'ip_allocations';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useTimestamps    = true;

    protected $allowedFields = [
        'ip_address',
        'subnet_cidr',
        'device_name',
        'device_type',
        'mac_address',
        'lab_room',
        'status',
        'notes',
    ];

    protected $validationRules = [
        'ip_address'  => 'required|valid_ip[ipv4]',
        'subnet_cidr' => 'required|max_length[5]',
        'device_name' => 'required|min_length[3]|max_length[50]',
        'device_type' => 'required',
        'mac_address' => 'permit_empty|regex_match[/^([0-9A-Fa-f]{2}:){5}[0-9A-Fa-f]{2}$/]',
        'lab_room'    => 'required',
        'status'      => 'required',
    ];

    protected $validationMessages = [
        'ip_address' => [
            'required' => 'Alamat IP wajib diisi.',
            'valid_ip' => 'Format IPv4 tidak valid.',
        ],
        'device_name' => [
            'required' => 'Nama perangkat wajib diisi.',
        ],
    ];
}