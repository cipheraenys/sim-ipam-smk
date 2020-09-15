<?php

namespace App\Controllers;

class Calculator extends BaseController
{
    public function __construct()
    {
        helper(['network', 'form']);
    }

    public function index()
    {
        $data = [
            'title'  => 'Kalkulator Subnetting IPv4',
            'result' => null,
            'ip'     => '192.168.10.0',
            'cidr'   => 24,
        ];

        return view('calculator/index', $data);
    }

    public function calculate()
    {
        $ip   = trim($this->request->getPost('ip_address'));
        $cidr = (int) $this->request->getPost('subnet_cidr');

        $result = calculate_subnet($ip, $cidr);

        $data = [
            'title'  => 'Kalkulator Subnetting IPv4',
            'result' => $result,
            'ip'     => $ip,
            'cidr'   => $cidr,
            'error'  => $result ? null : 'Alamat IPv4 atau prefix CIDR tidak valid (rentang CIDR yang didukung: /8 s.d /30).',
        ];

        return view('calculator/index', $data);
    }
}