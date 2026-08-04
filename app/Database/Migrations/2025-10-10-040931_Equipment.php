<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Equipment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_equipment' => [
                'type' => 'INT',
                'null' => false,
                'auto_increment' => true,
            ],
            'type_equipment' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'no_spk' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => false,
            ],
            'no_batch' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => false,
            ],
            'code_formula' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => false,
            ],
            'name_equipment' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => false,
            ],
            'start_equipment' => [
                'type' => 'TIME',
                'null' => false,
            ],
            'stop_equipment' => [
                'type' => 'TIME',
                'null' => false,
            ],
            'line_equipment' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id_equipment');
        $this->forge->createTable('tb_equipment');
    }

    public function down()
    {
        $this->forge->dropTable('tb_equipment');
    }
}
