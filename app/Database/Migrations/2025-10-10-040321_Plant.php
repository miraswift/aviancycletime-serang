<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Plant extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_plant' => [
                'type' => 'INT',
                'null' => false,
                'auto_increment' => true,
            ],
            'code_plant' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => false,
            ],
            'name_plant' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
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
        $this->forge->addPrimaryKey('id_plant');
        $this->forge->createTable('tb_plant');
    }

    public function down()
    {
        $this->forge->dropTable('tb_plant');
    }
}
