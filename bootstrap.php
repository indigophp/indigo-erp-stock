<?php

\Autoloader::add_namespaces(array(
	'Erp'  => __DIR__.DS.'classes'.DS,
), true);

$menu = \Menu_Admin::instance('indigo');
$menu->add(array(
	array(
		'name' => gettext('ERP'),
		'icon' => 'glyphicon glyphicon-file',
		'sort' => 15,
		'children' => array(
			array(
				'name' => gettext('Products'),
				'url' => \Uri::admin(false).'erp/stock/product',
			),
			array(
				'name' => gettext('Manufacturers'),
				'url' => \Uri::admin(false).'erp/stock/manufacturer',
			),
		),
	),
));
