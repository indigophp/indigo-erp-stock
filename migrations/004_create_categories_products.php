<?php

namespace Fuel\Migrations;

class Create_categories_products
{
	public function up()
	{
		\DBUtil::create_table('categories_products', [
			'category_id' => ['constraint' => 11, 'type' => 'int'],
			'product_id'  => ['constraint' => 11, 'type' => 'int'],
		], ['category_id', 'product_id']);
	}

	public function down()
	{
		\DBUtil::drop_table('categories_products');
	}
}