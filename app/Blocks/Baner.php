<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Baner extends Block
{
	public $name = 'Obraz';
	public $description = 'baner';
	public $slug = 'baner';
	public $category = 'formatting';
	public $icon = 'format-image';
	public $keywords = ['obraz', 'zdjecie'];
	public $mode = 'edit'; 
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
		'anchor' => true,
		'customClassName' => true,
	];

	public function fields()
	{
		$baner = new FieldsBuilder('baner');

		$baner
			->setLocation('block', '==', 'acf/baner') // ważne!
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Obraz',
				'open' => false,
				'multi_expand' => true,
			])
			/*--- GROUP ---*/
			->addTab('Elementy', ['placement' => 'top'])
			->addGroup('g_baner', ['label' => ''])
			->addImage('baner', [
				'label' => 'Obraz',
				'return_format' => 'array', // lub 'url', lub 'id'
				'preview_size' => 'medium',
			])
			->addLink('link', [
				'label' => 'Przycisk',
				'return_format' => 'array',
			])
			->endGroup()

			/*--- USTAWIENIA BLOKU ---*/

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return $baner;
	}

	public function with()
	{
		return [
			'g_baner' => get_field('g_baner'),
			'flip' => get_field('flip'),
		];
	}
}
