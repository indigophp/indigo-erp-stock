<?php

namespace Fuel\Migrations;

class Create_products
{
	public function up()
	{
		\DBUtil::create_table('products', [
			'id'              => ['constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true],
			'temporal_start'  => ['constraint' => 11, 'type' => 'int'],
			'temporal_end'    => ['constraint' => 11, 'type' => 'int'],
			'category_id'     => ['constraint' => 11, 'type' => 'int', 'unsigned' => true, 'null' => true],
			'manufacturer_id' => ['constraint' => 11, 'type' => 'int', 'unsigned' => true],
			'tax_class_id'    => ['constraint' => 11, 'type' => 'int', 'unsigned' => true, 'null' => true],
			'type_id'         => ['constraint' => 11, 'type' => 'int', 'unsigned' => true, 'null' => true],
			'name'            => ['constraint' => 255, 'type' => 'varchar'],
			'slug'            => ['constraint' => 255, 'type' => 'varchar'],
			'description'     => ['type' => 'text'],
			'price'           => ['constraint' => 11, 'type' => 'int'],
			'stock'           => ['constraint' => 11, 'type' => 'int'],
			'stock_status_id' => ['constraint' => 11, 'type' => 'int', 'null' => true],
			'status'          => ['constraint' => 1, 'type' => 'tinyint'],

		], ['id', 'temporal_start', 'temporal_end']);
	}

	public function down()
	{
		\DBUtil::drop_table('products');
	}
}