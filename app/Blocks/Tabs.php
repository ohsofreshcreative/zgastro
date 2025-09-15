<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Tabs extends Block
{
	public $name = 'Zakładki';
	public $description = 'tabs';
	public $slug = 'tabs';
	public $category = 'formatting';
	public $icon = 'welcome-widgets-menus';
	public $keywords = ['tabs', 'kafelki'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
	];

	public function fields()
	{
		$tabs = new FieldsBuilder('tabs');

		$tabs
			->setLocation('block', '==', 'acf/tabs') // ważne!
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Zakładki',
				'open' => false,
				'multi_expand' => true,
			])
			/*--- FIELDS ---*/
			->addTab('Treści', ['placement' => 'top'])
			->addGroup('g_tabs', ['label' => ''])
			->addText('title', ['label' => 'Tytuł'])
			->addText('txt', ['label' => 'Opis'])
			->endGroup()

			->addTab('Kafelki', ['placement' => 'top'])
			->addRepeater('r_tabs', [
				'label' => 'Zakładki',
				'layout' => 'table', // 'row', 'block', albo 'table'
				'min' => 1,
				'max' => 4,
				'button_label' => 'Dodaj kafelek'
			])
			->addText('tab', [
				'label' => 'Etykieta zakładki (lewy panel)',
				'required' => 1,
			])
			->addText('title', [
				'label' => 'Nagłówek treści (prawy panel)',
			])
			->addWysiwyg('txt', [
				'label' => 'Opis (WYSIWYG)',
				'tabs' => 'all',
				'media_upload' => 1,
				'delay' => 0,
			])
			->addImage('image', [
				'label' => 'Obraz treści (opcjonalnie)',
				'return_format' => 'array',
				'preview_size' => 'medium',
			])
			->endRepeater()

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

		return $tabs;
	}

	public function with()
	{
		return [
			'g_tabs' => get_field('g_tabs'),
			'r_tabs' => get_field('r_tabs'),
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
