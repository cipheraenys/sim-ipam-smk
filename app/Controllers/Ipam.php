<?php

namespace App\Controllers;

use App\Models\IpamModel;

class Ipam extends BaseController
{
    protected $ipamModel;

    public function __construct()
    {
        $this->ipamModel = new IpamModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $labFilter = $this->request->getGet('lab');
        $search    = $this->request->getGet('q');

        $query = $this->ipamModel;

        if (! empty($labFilter)) {
            $query = $query->where('lab_room', $labFilter);
        }

        if (! empty($search)) {
            $query = $query->groupStart()
                ->like('ip_address', $search)
                ->orLike('device_name', $search)
                ->orLike('mac_address', $search)
                ->groupEnd();
        }

        $data = [
            'title'       => 'Alokasi IP Address Lab',
            'allocations' => $query->orderBy('id', 'ASC')->findAll(),
            'current_lab' => $labFilter,
            'search'      => $search,
        ];

        return view('ipam/index', $data);
    }

    public function create()
    {
        $data = [
            'title'      => 'Tambah Alokasi IP Baru',
            'validation' => \Config\Services::validation(),
        ];

        return view('ipam/create', $data);
    }

    public function store()
    {
        $postData = [
            'ip_address'  => trim($this->request->getPost('ip_address')),
            'subnet_cidr' => trim($this->request->getPost('subnet_cidr')),
            'device_name' => trim($this->request->getPost('device_name')),
            'device_type' => trim($this->request->getPost('device_type')),
            'mac_address' => trim($this->request->getPost('mac_address')) ?: null,
            'lab_room'    => trim($this->request->getPost('lab_room')),
            'status'      => trim($this->request->getPost('status')),
            'notes'       => trim($this->request->getPost('notes')) ?: null,
        ];

        $existing = $this->ipamModel->where('ip_address', $postData['ip_address'])
                                    ->where('lab_room', $postData['lab_room'])
                                    ->first();

        if ($existing) {
            session()->setFlashdata('error', "IP {$postData['ip_address']} sudah dialokasikan untuk {$existing['device_name']} di {$postData['lab_room']}!");
            return redirect()->back()->withInput();
        }

        if (! $this->ipamModel->save($postData)) {
            return redirect()->back()->withInput()->with('errors', $this->ipamModel->errors());
        }

        session()->setFlashdata('success', 'Alokasi IP perangkat berhasil disimpan.');
        return redirect()->to('/ipam');
    }

    public function edit($id = null)
    {
        $allocation = $this->ipamModel->find($id);

        if (! $allocation) {
            session()->setFlashdata('error', 'Data alokasi IP tidak ditemukan.');
            return redirect()->to('/ipam');
        }

        $data = [
            'title'      => 'Edit Alokasi IP',
            'item'       => $allocation,
            'validation' => \Config\Services::validation(),
        ];

        return view('ipam/edit', $data);
    }

    public function update($id = null)
    {
        $allocation = $this->ipamModel->find($id);

        if (! $allocation) {
            session()->setFlashdata('error', 'Data alokasi IP tidak ditemukan.');
            return redirect()->to('/ipam');
        }

        $updateData = [
            'id'          => $id,
            'ip_address'  => trim($this->request->getPost('ip_address')),
            'subnet_cidr' => trim($this->request->getPost('subnet_cidr')),
            'device_name' => trim($this->request->getPost('device_name')),
            'device_type' => trim($this->request->getPost('device_type')),
            'mac_address' => trim($this->request->getPost('mac_address')) ?: null,
            'lab_room'    => trim($this->request->getPost('lab_room')),
            'status'      => trim($this->request->getPost('status')),
            'notes'       => trim($this->request->getPost('notes')) ?: null,
        ];

        $duplicate = $this->ipamModel->where('ip_address', $updateData['ip_address'])
                                     ->where('lab_room', $updateData['lab_room'])
                                     ->where('id !=', $id)
                                     ->first();

        if ($duplicate) {
            session()->setFlashdata('error', "IP {$updateData['ip_address']} sudah dipakai oleh {$duplicate['device_name']} di {$updateData['lab_room']}!");
            return redirect()->back()->withInput();
        }

        if (! $this->ipamModel->save($updateData)) {
            return redirect()->back()->withInput()->with('errors', $this->ipamModel->errors());
        }

        session()->setFlashdata('success', 'Data alokasi IP berhasil diperbarui.');
        return redirect()->to('/ipam');
    }

    public function delete($id = null)
    {
        $allocation = $this->ipamModel->find($id);

        if ($allocation) {
            $this->ipamModel->delete($id);
            session()->setFlashdata('success', "Alokasi IP {$allocation['ip_address']} ({$allocation['device_name']}) berhasil dihapus.");
        } else {
            session()->setFlashdata('error', 'Data alokasi IP tidak ditemukan.');
        }

        return redirect()->to('/ipam');
    }

    public function exportCsv()
    {
        $allocations = $this->ipamModel->orderBy('lab_room', 'ASC')->orderBy('ip_address', 'ASC')->findAll();

        $filename = 'sim_ipam_lab_smk_' . date('Ymd_His') . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);

        $output = fopen('php://output', 'w');

        fputcsv($output, ['No', 'Alamat IP', 'Subnet', 'Nama Perangkat', 'Tipe', 'MAC Address', 'Ruangan Lab', 'Status', 'Catatan']);

        $no = 1;
        foreach ($allocations as $row) {
            fputcsv($output, [
                $no++,
                $row['ip_address'],
                $row['subnet_cidr'],
                $row['device_name'],
                $row['device_type'],
                $row['mac_address'] ?? '-',
                $row['lab_room'],
                $row['status'],
                $row['notes'] ?? '-',
            ]);
        }

        fclose($output);
        exit;
    }
}