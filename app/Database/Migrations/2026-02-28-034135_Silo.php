<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Silo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_stock_silo' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'code_stock_silo' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'supplier_stock_silo' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'val_stock_silo' => [
                'type' => 'DOUBLE',
                'null' => false,
                'default' => 0,
            ],
            'status_stock_silo' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
            ],
            'date_stock_silo' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'time_stock_silo' => [
                'type' => 'TIME',
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
        $this->forge->addPrimaryKey('id_stock_silo');
        $this->forge->createTable('tb_stock_silo');
    }

    public function down()
    {
        $this->forge->dropTable('tb_stock_silo');
    }
}
