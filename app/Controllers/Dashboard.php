<?php

namespace App\Controllers;

use App\Models\IpamModel;

class Dashboard extends BaseController
{
    protected $ipamModel;

    public function __construct()
    {
        $this->ipamModel = new IpamModel();
    }

    public function index()
    {
        $allocations = $this->ipamModel->findAll();

        $stats = [
            'total'      => count($allocations),
            'static'     => 0,
            'dhcp_pool'  => 0,
            'reserved'   => 0,
            'devices'    => [
                'Router'       => 0,
                'Switch'       => 0,
                'PC Client'    => 0,
                'Access Point' => 0,
                'Server'       => 0,
            ],
            'labs'       => [],
        ];

        foreach ($allocations as $item) {
            if ($item['status'] === 'Static') {
                $stats['static']++;
            } elseif ($item['status'] === 'DHCP Pool') {
                $stats['dhcp_pool']++;
            } elseif ($item['status'] === 'Reserved') {
                $stats['reserved']++;
            }

            $type = $item['device_type'];
            if (isset($stats['devices'][$type])) {
                $stats['devices'][$type]++;
            }

            $lab = $item['lab_room'];
            if (! isset($stats['labs'][$lab])) {
                $stats['labs'][$lab] = 0;
            }
            $stats['labs'][$lab]++;
        }

        $data = [
            'title'       => 'Dashboard SIM-IPAM Lab SMK',
            'stats'       => $stats,
            'recent_ips'  => $this->ipamModel->orderBy('id', 'DESC')->findAll(5),
        ];

        return view('dashboard', $data);
    }
}