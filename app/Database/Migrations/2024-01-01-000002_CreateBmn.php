<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBmn extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => 80,
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'location' => [
                'type'       => 'VARCHAR',
                'constraint' => 120,
            ],
            'condition' => [
                'type'       => 'VARCHAR',
                'constraint' => 80,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
        $this->forge->createTable('bmn');
    }

    public function down()
    {
        $this->forge->dropTable('bmn');
    }
}
