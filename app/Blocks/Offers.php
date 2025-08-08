<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Offers extends Block
{
	public $name = 'Oferta - Treść oraz zdjęcie';
	public $description = 'offers';
	public $slug = 'offers';
	public $category = 'formatting';
	public $icon = 'align-pull-left';
	public $keywords = ['tresc', 'zdjecie'];
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
		$offers = new FieldsBuilder('offers');

		$offers
			->setLocation('block', '==', 'acf/offers')
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Oferta',
				'open' => false,
				'multi_expand' => true,
			])
			->addTab('Elementy', ['placement' => 'top'])
			->addGroup('g_offers', ['label' => ''])

			->addImage('image', [
				'label' => 'Obraz',
				'return_format' => 'array',
				'preview_size' => 'medium',
			])
			->addText('title', ['label' => 'Tytuł'])
			->addWysiwyg('content', [
				'label' => 'Treść',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => true,
			])

			->addTrueFalse('use_tiles', [
				'label' => 'Pokaż kafelki zamiast przycisku',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])

			// Przycisk tylko gdy "use_tiles" jest na NIE
			->addLink('button', [
				'label' => 'Przycisk',
				'return_format' => 'array',
			])
			->conditional('use_tiles', '==', 0)

			// Grupa z subtitle + repeater gdy "use_tiles" jest na TAK
			
			->addGroup('tiles_group', ['label' => ''])
			->conditional('use_tiles', '==', 1)
			->addAccordion('accordion2', [
				'label' => 'Kafelki',
				'open' => false,
				'multi_expand' => true,
			])
			->addText('subtitle', ['label' => 'Tytuł'])
			->addRepeater('repeater', [
				'label' => 'Kafelki',
				'layout' => 'table',
				'min' => 1,
				'max' => 10,
				'button_label' => 'Dodaj kafelek',
			])
			->addImage('image', [
				'label' => 'Obraz',
				'return_format' => 'array',
				'preview_size' => 'medium',
			])
			->addText('title', ['label' => 'Nagłówek'])
			->addLink('button', [
				'label' => 'Odnośnik',
				'return_format' => 'array',
			])
			->endRepeater()
			->endGroup()

			->endGroup() // g_offers

			// --- Ustawienia bloku ---
			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('lightbg', [
				'label' => 'Jasne tło',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('whitebg', [
				'label' => 'Białe tło',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('nomt', [
				'label' => 'Usunięcie marginesu górnego',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return $offers;
	}

	public function with()
	{
		return [
			'g_offers' => get_field('g_offers'),
			'flip' => get_field('flip'),
			'lightbg' => get_field('lightbg'),
			'whitebg' => get_field('whitebg'),
			'nomt' => get_field('nomt'),
		];
	}
}
