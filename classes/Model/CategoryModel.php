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
 * Category Model
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class CategoryModel extends \Orm\Model_Nestedset
{
	/**
	 * {@inheritdoc}
	 */
	protected static $_properties = [
		'id' => [
			'label' => 'ID',
		],
		'left_id',
		'right_id',
		'image_id',
		'name' => [
			'label' => 'Name',
			'type'  => 'text',
		],
		'slug',
		'description' => [
			'label' => 'Description',
		],
		'status' => [
			'label'   => 'Status',
			'default' => 1,
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
			'type' => 'textarea',
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
	];

	/**
	 * {@inheritdoc}
	 */
	protected static $_observers = [
		'Orm\\Observer_Slug' => [
			'events'    => ['before_insert'],
			'source'    => 'name',
			'separator' => '_',
		],
	];

	/**
	 * {@inheritdoc}
	 */
	protected static $_tree = [
		'title_field' => 'name',
	];

	/**
	 * {@inheritdoc}
	 */
	protected static $_table_name = 'categories';

	/**
	 * Generates an option array for forms
	 *
	 * @param self $root
	 *
	 * @return []
	 */
	public static function generate_options($root = null)
	{
		if ($root === null)
		{
			$root = \Erp\Model_Category::query()
				->where('id', 1)
				->get_one();
		}

		$return = [];

		foreach ($root->children()->get() as $model)
		{
			if ($model->has_children())
			{
				$return[$model->name] = static::generate_options($model);
			}
			else
			{
				$return[$model->id] = $model->name;
			}
		}

		return $return;
	}
}
