<?php

/*
 * This file is part of the Indigo ERP Stock package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Erp\Stock\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping AS ORM;
use Money\Money;

/**
 * @ORM\Entity
 * @ORM\Table(name="erp_stock_products")
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Product
{
	use \Indigo\Doctrine\Field\Id;
	use \Indigo\Doctrine\Field\Name;
	use \Indigo\Doctrine\Field\Description;
	use \Indigo\Doctrine\Field\Status;
	use \Indigo\Doctrine\Behavior\Slug;

	/**
	 * @var Money
	 *
	 * @ORM\Column(type="money")
	 */
	private $price;

	/**
	 * @var integer
	 *
	 * @ORM\Column(type="integer")
	 */
	private $inventory;

	/**
	 * Returns the price
	 *
	 * @return Money
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * Sets the price
	 *
	 * @param Money $price
	 *
	 * @return self
	 */
	public function setPrice(Money $price)
	{
		$this->price = $price;

		return $this;
	}

	/**
	 * Returns the inventory
	 *
	 * @return integer
	 */
	public function getInventory()
	{
		return $this->inventory;
	}

	/**
	 * Sets the inventory
	 *
	 * @param integer $inventory
	 *
	 * @return self
	 */
	public function setInventory($inventory)
	{
		$this->inventory = $inventory;

		return $this;
	}
}
