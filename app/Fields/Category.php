<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Category extends Field
{
	public function fields()
	{
		$category = new FieldsBuilder('category_fields');

		$category
			->setLocation('taxonomy', '==', 'category')
			->addText('title', [
				'label' => 'Nagłówek',
				'required' => 0,
			])
			->addTextarea('txt', [
				'label' => 'Opis',
				'rows' => 4,
				'new_lines' => 'br',
			])
			->addImage('image', [
				'label' => 'Obraz kategorii',
				'return_format' => 'array',
			]);

		return $category;
	}
}
