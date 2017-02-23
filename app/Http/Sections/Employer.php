<?php

namespace App\Http\Sections;

use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Display\DisplayInterface;
use SleepingOwl\Admin\Contracts\Form\FormInterface;
use SleepingOwl\Admin\Section;

/**
 * Class Employer
 *
 * @property \App\Employer $model
 *
 * @see http://sleepingowladmin.ru/docs/model_configuration_section
 */
class Employer extends Section
{
	/**
	 * @see http://sleepingowladmin.ru/docs/model_configuration#ограничение-прав-доступа
	 *
	 * @var bool
	 */
	protected $checkAccess = false;

	/**
	 * @var string
	 */
	protected $title = 'Соискатели';

	/**
	 * @var string
	 */
	protected $alias;

	/**
	 * @return DisplayInterface
	 */
	public function onDisplay()
	{
		$display = AdminDisplay::datatables()->with('user')
		                       ->setHtmlAttribute('class', 'table-primary');
		$display->setColumns(
			\AdminColumn::text('employer_id', '#')->setWidth('10px'),
			\AdminColumn::text('user.name', 'ФИО')->setWidth('100px'),
			\AdminColumn::text('user.email', 'Email')->setWidth('100px'),
			\AdminColumn::text('user.balance', 'Баланс')->setWidth('50px')
	    );

		return $display;
	}

	/**
	 * @param int $id
	 *
	 * @return FormInterface
	 */
	public function onEdit($id)
	{
		return AdminForm::panel()->addBody(
			[
				AdminFormElement::text('user.name', 'ФИО')->setReadOnly(true),
				AdminFormElement::date('birthday', 'День рождения'),
				AdminFormElement::file('summary', 'Резюме')->setUploadPath(
					function (\Illuminate\Http\UploadedFile $file) {
						return 'uploads/summary';
					}
				)
			]
		);
	}

	/**
	 * @return FormInterface
	 */
	public function onCreate()
	{
		return $this->onEdit(null);
	}

	/**
	 * @return void
	 */
	public function onDelete($id)
	{
		// todo: remove if unused
	}

	/**
	 * @return void
	 */
	public function onRestore($id)
	{
		// todo: remove if unused
	}
}