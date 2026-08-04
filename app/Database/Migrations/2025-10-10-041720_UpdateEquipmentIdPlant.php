<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateEquipmentIdPlant extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tb_equipment', [
            'id_plant' => [
                'type' => 'INT',
                'null' => false,
                'after' => 'id_equipment',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tb_equipment', ['id_plant']);
    }
}
