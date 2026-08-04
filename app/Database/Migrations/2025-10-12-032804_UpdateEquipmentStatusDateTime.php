<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateEquipmentStatusDateTime extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tb_equipment', [
            'status_equipment' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
                'after' => 'name_equipment',
            ],
            'date_equipment' => [
                'type' => 'DATE',
                'null' => false,
                'after' => 'line_equipment',
            ],
            'time_equipment' => [
                'type' => 'TIME',
                'null' => false,
                'after' => 'date_equipment'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tb_equipment', ['status_equipment', 'date_equipment', 'time_equipment']);
    }
}
