<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRepairRequests extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'bmn_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'priority' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'requested_date' => [
                'type' => 'DATE',
            ],
            'requested_by' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 60,
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
        $this->forge->addForeignKey('bmn_id', 'bmn', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('requested_by', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('repair_requests');
    }

    public function down()
    {
        $this->forge->dropTable('repair_requests');
    }
}
