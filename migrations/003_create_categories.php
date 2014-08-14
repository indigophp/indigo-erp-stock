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

class Create_categories
{
	public function up()
	{
		\DBUtil::create_table('categories', [
			'id'          => ['constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true],
			'left_id'     => ['constraint' => 11, 'type' => 'int'],
			'right_id'    => ['constraint' => 11, 'type' => 'int'],
			'image_id'    => ['constraint' => 11, 'type' => 'int', 'null' => true],
			'name'        => ['constraint' => 255, 'type' => 'varchar'],
			'slug'        => ['constraint' => 255, 'type' => 'varchar'],
			'description' => ['type' => 'text', 'null' => true],
			'status'      => ['constraint' => 1, 'type' => 'tinyint', 'default' => 1],
			'created_at'  => ['constraint' => 11, 'type' => 'int', 'null' => true],
			'updated_at'  => ['constraint' => 11, 'type' => 'int', 'null' => true],
		], ['id']);

		\DBUtil::create_index('categories', 'left_id');
		\DBUtil::create_index('categories', 'right_id');
	}

	public function down()
	{
		\DBUtil::drop_table('categories');
	}
}