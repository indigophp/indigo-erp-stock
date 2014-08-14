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
 * Product Model
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class ProductModel extends \Orm\Model_Temporal
{
	use \Indigo\Skeleton\Model;

	protected static $_many_many = [
		'categories' => [
			'model_to' => 'Model\\CategoryModel',
		],
	];

	/**
	 * {@inheritdoc}
	 */
	protected static $_properties = [
		'id' => [
			'label' => 'ID',
		],
		'temporal_start',
		'temporal_end',
		'category_id' => [
			'label' => 'Category',
			'type' => 'select',
		],
		'manufacturer_id' => [
			'label' => 'Manufacturer',
			'type' => 'select',
		],
		'tax_class_id',
		'type_id',
		'name' => [
			'label' => 'Name',
			'type'  => 'text',
		],
		'slug',
		'description' => [
			'label' => 'Description',
		],
		'price' => [
			'label' => 'Price',
			'type' => 'text',
		],
		'stock' => [
			'label' => 'Stock',
			'type' => 'text',
		],
		'stock_status_id' => [
			'label' => 'Out of stock status',
		],
		'status' => [
			'label' => 'Status',
			'options' => [
				'Disabled',
				'Enabled',
			],
		],
	];

	/**
	 * {@inheritdoc}
	 */
	protected static $_list_properties = [
		'id' => [
			'label' => '#',
		],
		'name',
		'price' => [
			'type' => 'hidden',
		],
		'stock' => [
			'type' => 'hidden',
			'sort' => false,
		],
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
		'category_id' => [
			'attributes' => [
				'multiple' => 'multiple',
				'data-selected-text-format' => 'count',
			],
			'validation' => [
				'required',
			],
		],
		'manufacturer_id' => [
			'validation' => [
				'required',
				'value' => [],
			],
		],
		'description' => [
			'type' => 'textarea',
			'template' => 'ckeditor',
		],
		'price' => [
			'validation' => [
				'required',
				'type' => 'numeric',
			],
		],
		'stock' => [
			'default' => 1,
			// 'validation' => [
			// 	'required',
			// 	'type' => 'numeric',
			// ],
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
		'id',
		'name',
		'price',
		'stock',
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
	protected static $_temporal = array(
		'mysql_timestamp' => false,
	);

	/**
	 * {@inheritdoc}
	 */
	protected static $_primary_key = array('id', 'temporal_start', 'temporal_end');

	/**
	 * {@inheritdoc}
	 */
	protected static $_table_name = 'products';

	public static function _init()
	{
		$manufacturers = \Model\ManufacturerModel::get_manufacturers();
		static::$_properties['manufacturer_id']['options'] = $manufacturers;
		static::$_properties['manufacturer_id']['validation']['value'] = array_keys($manufacturers);

		$categories = \Model\CategoryModel::generate_options();
		static::$_properties['category_id']['options'] = $categories;
		// static::$_properties['category_id']['validation']['value'] = array_keys($manufacturers);
	}
}
