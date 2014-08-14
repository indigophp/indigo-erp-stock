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
class Controller_Admin_Product extends \Admin\Controller_Skeleton
{
	/**
	 * {@inheritdoc}
	 */
	protected $module = 'erp_stock_product';

	/**
	 * {@inheritdoc}
	 */
	protected $model = 'Model\\ProductModel';

	/**
	 * {@inheritdoc}
	 */
	protected $name = [
		'product',
		'products',
	];

	/**
	 * {@inheritdoc}
	 */
	public function has_access($access)
	{
		return parent::has_access('erp.product[' . $access . ']');
	}

	public function action_create()
	{
		$form = $this->form();

		if (\Input::method() == 'POST')
		{
			$post = \Input::post();

			$validator = $this->validation();
			$result = $validator->run($post);

			if ($result->isValid())
			{
				$model = $this->forge();
				$data = \Arr::filter_keys($post, $result->getValidated());

				$categories = $data['category_id'];
				unset($data['category_id']);

				$model->categories = [];

				foreach ($categories as $category)
				{
					$model->categories[] = Model_Category::find($category);
				}

				$model->set($data)->save();

				$context = array(
					'template' => 'success',
					'from'     => '%item%',
					'to'       => $this->get_name(),
				);

				\Logger::instance('alert')->info(gettext('%item% successfully created.'), $context);

				return $this->redirect($this->url . '/view/' . $model->id);
			}
			else
			{
				$form->repopulate();

				$context = array(
					'errors' => $result->getErrors(),
				);

				\Logger::instance('alert')->error(gettext('There were some errors.'), $context);
			}
		}

		$this->set_title(ucfirst(strtr(gettext('New %item%'), ['%item%' => $this->get_name()])));

		$this->template->content = $this->view('admin/skeleton/create');
		$this->template->content->set('form', $form, false);
		isset($errors) and $this->template->content->set('errors', $errors, false);
	}

	public function action_edit($id = null)
	{
		$model = $this->find($id);
		$form = $this->form();

		if (\Input::method() == 'POST')
		{
			$post = \Input::post();

			$validator = $this->validation();
			$result = $validator->run($post);

			if ($result->isValid())
			{
				$data = \Arr::filter_keys($post, $result->getValidated());

				$categories = $data['category_id'];
				unset($data['category_id']);

				$model->categories = [];

				foreach ($categories as $category)
				{
					$model->categories[] = Model_Category::find($category);
				}

				$model->set($data)->save();

				$context = array(
					'template' => 'success',
					'from'     => '%item%',
					'to'       => $this->get_name(),
				);

				\Logger::instance('alert')->info(gettext('%item% successfully created.'), $context);

				return $this->redirect($this->url);
			}
			else
			{
				$form->repopulate();

				$context = array(
					'errors' => $result->getErrors(),
				);

				\Logger::instance('alert')->error(gettext('There were some errors.'), $context);
			}
		}
		else
		{
			$data = $model->to_array();
			$data['category_id'] = array_keys($model->categories);

			$form->populate($data);
		}

		$this->set_title(strtr(gettext('Edit %item%'), ['%item%' => $this->get_name()]));

		$this->template->content = $this->view('admin/skeleton/edit');
		$this->template->content->set('model', $model, false);
		$this->template->content->set('form', $form, false);
		isset($errors) and $this->template->content->set('errors', $errors, false);
	}
}
