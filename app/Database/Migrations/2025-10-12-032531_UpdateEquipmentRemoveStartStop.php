<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateEquipmentRemoveStartStop extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('tb_equipment', ['start_equipment', 'stop_equipment']);
    }

    public function down()
    {
        $this->forge->addColumn('tb_equipment', [
            'start_equipment' => [
                'type' => 'TIME',
                'null' => false,
            ],
            'stop_equipment' => [
                'type' => 'TIME',
                'null' => false,
            ],
        ]);
    }
}
