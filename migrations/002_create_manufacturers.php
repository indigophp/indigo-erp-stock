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

class Create_manufacturers
{
	public function up()
	{
		\DBUtil::create_table('manufacturers', [
			'id'          => ['constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true],
			'name'        => ['constraint' => 255, 'type' => 'varchar'],
			'slug'        => ['constraint' => 255, 'type' => 'varchar'],
			'description' => ['type' => 'text'],
			'url'         => ['constraint' => 2083, 'type' => 'varchar', 'null' => true],
			'status'      => ['constraint' => 1, 'type' => 'tinyint', 'default' => 1],
			'created_at'  => ['constraint' => 11, 'type' => 'int', 'null' => true],
			'updated_at'  => ['constraint' => 11, 'type' => 'int', 'null' => true],

		], ['id']);
	}

	public function down()
	{
		\DBUtil::drop_table('manufacturers');
	}
}