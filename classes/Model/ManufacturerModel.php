<?php

/*
 * This file is part of the Indigo Erp Stock module.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Erp\Stock\Model;

/**
 * Manufacturer Model
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class ManufacturerModel extends \Orm\Model
{
	use \Indigo\Skeleton\Model;

	/**
	 * {@inheritdoc}
	 */
	protected static $_properties = [
		'id' => [
			'label' => 'ID',
		],
		'name' => [
			'label' => 'Name',
			'type'  => 'text',
		],
		'slug',
		'description' => [
			'label' => 'Description',
		],
		'url' => [
			'label' => 'URL',
		],
		'status' => [
			'label' => 'Status',
			'options' => [
				'Disabled',
				'Enabled',
			],
		],
		'created_at',
		'updated_at',
	];

	/**
	 * {@inheritdoc}
	 */
	protected static $_list_properties = [
		'id' => [
			'label' => '#',
		],
		'name',
		'status' => [
			'type' => 'select',
		],
	];

	/**
	 * {@inheritdoc}
	 */
	protected static $_form_properties = [
		'name' => [
			'validation' => ['required'],
		],
		'description' => [
			'type'       => 'textarea',
		],
		'url' => [
			'type' => 'text',
		],
		'status' => [
			'type'     => 'checkbox',
			'template' => 'switch',
			'default'  => 1,
			'validation' => [
				'value' => [0, 1],
			],
		],
	];

	/**
	 * {@inheritdoc}
	 */
	protected static $_view_properties = [
		'name',
		'description',
		'url',
		'status',
	];

	/**
	 * {@inheritdoc}
	 */
	protected static $_observers = [
		'Orm\Observer_CreatedAt' => [
			'events'          => ['before_insert'],
			'mysql_timestamp' => false,
		],
		'Orm\Observer_UpdatedAt' => [
			'events'          => ['before_update'],
			'mysql_timestamp' => false,
		],
		'Orm\\Observer_Slug' => [
			'events' => ['before_insert'],
			'source' => 'name',
		],
	];

	/**
	 * {@inheritdoc}
	 */
	protected static $_table_name = 'manufacturers';

	public static function get_manufacturers()
	{
		$manufacturers = static::query()
			->where('status', 1)
			->get();

		return \Arr::pluck($manufacturers, 'name', 'id');
	}
}
