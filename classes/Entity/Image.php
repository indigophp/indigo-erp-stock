<?php

/*
 * This file is part of the Indigo ERP Stock module.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Erp\Stock\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="erp_images")
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Image
{
	use \Indigo\Doctrine\Field\Id;
	use \Indigo\Doctrine\Behavior\Timestamp\DateTime;

    /**
     * @ORM\ManyToOne(targetEntity="Erp\Stock\Entity\Product", inversedBy="images")
     */
    private $product;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="path", type="string")
	 */
	private $path;

	public function __construct()
	{
		$this->initCreatedAt();
	}

	/**
	 * Returns the path
	 *
	 * @return string
	 */
	public function getPath()
	{
	    return $this->path;
	}

	/**
	 * Sets the path
	 *
	 * @param string $path
	 *
	 * @return self
	 */
	public function setPath($path)
	{
	    $this->path = $path;

	    return $this;
	}

	public function setProduct(Product $product)
	{
		$this->product = $product;

		return $this;
	}
}
