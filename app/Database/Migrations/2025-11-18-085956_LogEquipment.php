<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LogEquipment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_log_equipment' => [
                'type' => 'INT',
                'null' => false,
                'auto_increment' => true,
            ],
            'id_plant' => [
                'type' => 'INT',
                'null' => false,
                'default' => 0,
            ],
            'type_log_equipment' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
                'default' => '-',
            ],
            'no_spk' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => false,
                'default' => '-',
            ],
            'no_batch' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => false,
                'default' => '-',
            ],
            'code_formula' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => false,
                'default' => '-',
            ],
            'name_log_equipment' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => false,
                'default' => '-',
            ],
            'line_log_equipment' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
                'default' => '-',
            ],
            'status_log_equipment' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
                'default' => '-',
            ],
            'date_log_equipment' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'time_log_equipment' => [
                'type' => 'TIME',
                'null' => false,
            ],
            'target_log_equipment' => [
                'type' => 'float',
                'null' => true,
                'default' => 0,
            ],
            'actual_log_equipment' => [
                'type' => 'float',
                'null' => true,
                'default' => 0,
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
        $this->forge->addPrimaryKey('id_log_equipment');
        $this->forge->createTable('tb_log_equipment');
    }

    public function down()
    {
        $this->forge->dropTable('tb_log_equipment');
    }
}
