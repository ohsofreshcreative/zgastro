<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Promo extends Block
{
	public $name = 'Slider - Promocje';
	public $description = 'promo';
	public $slug = 'promo';
	public $category = 'formatting';
	public $icon = 'image-flip-horizontal';
	public $keywords = ['promo', 'kafelki'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
	];

	public function fields()
	{
		$promo = new FieldsBuilder('promo');

		$promo
			->setLocation('block', '==', 'acf/promo') // ważne!
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Slider - Promocje',
				'open' => false,
				'multi_expand' => true,
			])
			/*--- FIELDS ---*/
			->addTab('Treści', ['placement' => 'top'])
			->addGroup('g_promo', ['label' => ''])

            ->addText('subtitle', ['label' => 'Śródtytuł'])
            ->addText('title', ['label' => 'Tytuł'])

			->addRepeater('repeater', [
				'label' => 'Slider - Promocje',
				'layout' => 'table', // 'row', 'block', albo 'table'
				'min' => 1,
				'max' => 10,
				'button_label' => 'Dodaj kafelek'
			])
			->addImage('card_image', [
				'label' => 'Obraz',
				'return_format' => 'array', // lub 'url', lub 'id'
				'preview_size' => 'medium',
			])
			->addText('card_title', [
				'label' => 'Nagłówek',
			])
			->addText('card_subtitle', [
				'label' => 'Dodatkowy tekst',
			])
			->addLink('button', [
				'label' => 'Przycisk',
				'return_format' => 'array',
			])
			->endRepeater()

			->endGroup()

			/*--- USTAWIENIA BLOKU ---*/

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addText('id', [
				'label' => 'ID',
			])
			->addText('class', [
				'label' => 'Dodatkowe klasy CSS',
			])
			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('wide', [
				'label' => 'Szeroka kolumna',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('nomt', [
				'label' => 'Usunięcie marginesu górnego',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('gap', [
				'label' => 'Większy odstęp',
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
			->addTrueFalse('graybg', [
				'label' => 'Szare tło',
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
			->addTrueFalse('brandbg', [
				'label' => 'Tło marki',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return $promo;
	}

	public function with()
	{
		return [
			'g_promo' => get_field('g_promo'),
			'promo' => get_field('g_promo')['repeater'] ?? [],
			'id' => get_field('id'),
			'class' => get_field('class'),
			'flip' => get_field('flip'),
			'wide' => get_field('wide'),
			'nomt' => get_field('nomt'),
			'gap' => get_field('gap'),
			'lightbg' => get_field('lightbg'),
			'graybg' => get_field('graybg'),
			'whitebg' => get_field('whitebg'),
			'brandbg' => get_field('brandbg'),
		];
	}
}
