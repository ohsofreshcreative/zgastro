<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Accordion extends Block

{


	public $name = 'Rozwijane panele';
	public $description = 'accordion';
	public $slug = 'accordion';
	public $category = 'formatting';
	public $icon = 'feedback';
	public $keywords = ['accordion'];
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
		$accordion = new FieldsBuilder('accordion');

		$accordion
			->setLocation('block', '==', 'acf/accordion') // ważne!
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])

			->addAccordion('accordion1', [
				'label' => 'Rozwijane panele',
				'open' => false,
				'multi_expand' => true,
			])

			/*--- TAB #1 ---*/
			->addTab('Treść', ['placement' => 'top'])
			->addGroup('g_accordion', ['label' => ''])
			->addText('title', ['label' => 'Tytuł'])

			->addImage('image', [
				'label' => 'Obraz',
				'return_format' => 'array', // lub 'url', lub 'id'
				'preview_size' => 'medium',
			])

			->addText('subtitle', ['label' => 'Sródtytuł'])

			->addWysiwyg('content', [
				'label' => 'Treść',
				'tabs' => 'all', // 'visual', 'text', 'all'
				'toolbar' => 'full', // 'basic', 'full'
				'media_upload' => true,
			])
			->endGroup()

			/*--- TAB #2 ---*/
			->addTab('Elementy', ['placement' => 'top'])
			->addRepeater('repeater', [
				'label' => 'accordion',
				'layout' => 'table', // 'row', 'block', albo 'table'
				'min' => 1,
				'button_label' => 'Dodaj pytanie'
			])
			->addText('title', [
				'label' => 'Pytanie',
			])
			->addWysiwyg('txt', [
				'label' => 'Odpowiedź',
				'tabs' => 'all', // 'visual', 'text', 'all'
				'toolbar' => 'full', // 'basic', 'full'
				'media_upload' => true,
			])
			->endRepeater()

			/*--- USTAWIENIA BLOKU ---*/
		
			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])

			->addTrueFalse('darkbg', [
				'label' => 'Ciemne tło',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])

			->addTrueFalse('bgimage', [
				'label' => 'Grafika w tle',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return $accordion;
	}

	public function with()
	{
		return [
			'g_accordion' => get_field('g_accordion'),
			'repeater' => get_field('repeater'),
			'flip' => get_field('flip'),
			'darkbg' => get_field('darkbg'),
			'bgimage' => get_field('bgimage'),
		];
	}
}