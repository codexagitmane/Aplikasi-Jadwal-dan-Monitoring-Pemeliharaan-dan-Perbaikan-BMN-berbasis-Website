<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMaintenanceSchedules extends Migration
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
                'null' => true,
            ],
            'scheduled_date' => [
                'type' => 'DATE',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 60,
            ],
            'type' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
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
        $this->forge->createTable('maintenance_schedules');
    }

    public function down()
    {
        $this->forge->dropTable('maintenance_schedules');
    }
}
