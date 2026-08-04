<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateSiloCodePLant extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tb_stock_silo', [
            'code_plant' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'after' => 'id_stock_silo',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tb_stock_silo', ['code_plant']);
    }
}
