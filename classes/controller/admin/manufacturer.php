<?php

/*
 * This file is part of the Indigo Erp Stock module.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Erp\Stock;

/**
 * Manufacturer Admin Controller
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Controller_Admin_Manufacturer extends \Admin\Controller_Skeleton
{
	/**
	 * {@inheritdoc}
	 */
	protected $module = 'erp_stock_manufacturer';

	/**
	 * {@inheritdoc}
	 */
	protected $model = 'Model\\ManufacturerModel';

	/**
	 * {@inheritdoc}
	 */
	protected $name = [
		'manufacturer',
		'manufacturers',
	];

	/**
	 * {@inheritdoc}
	 */
	public function has_access($access)
	{
		return parent::has_access('erp.manufacturer[' . $access . ']');
	}
}
