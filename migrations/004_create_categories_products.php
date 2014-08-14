<?php

/*
 * This file is part of the Indigo Erp Stock module.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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