<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'desc' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'costPrice' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'sellPrice' => [
                'type' => 'FLOAT',
                'constraint' => '10,2',
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                 'null' => true
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
