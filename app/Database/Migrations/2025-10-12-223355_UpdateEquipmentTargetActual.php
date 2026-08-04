<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateEquipmentTargetActual extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tb_equipment', [
            'target_equipment' => [
                'type' => 'float',
                'null' => true,
                'after' => 'duration_equipment',
            ],
            'actual_equipment' => [
                'type' => 'float',
                'null' => true,
                'after' => 'target_equipment',
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tb_equipment', ['target_equipment', 'actual_equipment']);
    }
}
