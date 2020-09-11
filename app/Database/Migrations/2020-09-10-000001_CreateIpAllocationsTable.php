<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateIpAllocationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
            ],
            'subnet_cidr' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'default'    => '/24',
            ],
            'device_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'device_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
            ],
            'mac_address' => [
                'type'       => 'VARCHAR',
                'constraint' => '17',
                'null'       => true,
            ],
            'lab_room' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '15',
                'default'    => 'Static',
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('ip_address');
        $this->forge->addKey('lab_room');
        $this->forge->createTable('ip_allocations');
    }

    public function down()
    {
        $this->forge->dropTable('ip_allocations');
    }
}