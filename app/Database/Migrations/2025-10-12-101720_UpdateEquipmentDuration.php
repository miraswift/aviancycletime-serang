<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateEquipmentDuration extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tb_equipment', [
            'duration_equipment' => [
                'type' => 'TIME',
                'null' => true,
                'after' => 'time_equipment',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->addColumn('tb_equipment', ['duration_equipment']);
    }
}
