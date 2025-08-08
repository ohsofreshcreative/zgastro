<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class HeroCases extends Block
{
	public $name = 'Sekcja Hero - Realizacje';
	public $description = 'hero-cases';
	public $slug = 'hero-cases';
	public $category = 'formatting';
	public $icon = 'align-full-width';
	public $keywords = ['tresc', 'zdjecie'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
	];

	public function fields()
	{
		$hero_cases = new FieldsBuilder('hero-cases');

		$hero_cases
			->setLocation('block', '==', 'acf/hero-cases') // ważne!
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Hero - Realizacje',
				'open' => false,
				'multi_expand' => true,
			])
			->addTab('Treść', ['placement' => 'top']) 
			->addGroup('g_herocases', ['label' => 'Hero - Pojedyncza oferta'])
			->addImage('image', [
				'label' => 'Obraz',
				'return_format' => 'array', // lub 'url', lub 'id'
				'preview_size' => 'medium',
			])
			->addText('title', ['label' => 'Tytuł'])

			->endGroup()

			->addTab('Ustawienia bloku', ['placement' => 'top']) 

			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return $hero_cases;
	}

	public function with()
	{
		return [
			'g_herocases' => get_field('g_herocases'),
			'flip' => get_field('flip'),
		];
	}
}
