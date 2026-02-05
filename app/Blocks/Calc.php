<?php

namespace App\Blocks;


use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use Illuminate\Support\Facades\Vite;

class Calc extends Block
{
	public $name = 'Kalkulator';
	public $description = 'calc';
	public $slug = 'calc';
	public $category = 'formatting';
	public $icon = 'format-image';
	public $keywords = ['kalkulator', 'formularz', 'obliczenia', 'interaktywny'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
		'multiple' => true,
		'anchor' => true,
		'customClassName' => true,
	];

	/**
	 * The block field group.
	 *
	 * @return array
	 */
	public function fields()
	{
		$calc = new FieldsBuilder('calc');

		$calc
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Kalkulator',
				'open' => false,
				'multi_expand' => true,
			])
			->addTab('Elementy', ['placement' => 'top'])
			->addText('shortcode', [
				'label' => 'Kod formularza',
			])

			/*--- USTAWIENIA BLOKU ---*/

			->addTab('Ustawienia bloku', ['placement' => 'top'])
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


		return $calc->build();
	}

	/**
	 * Data to be passed to the block before rendering.
	 *
	 * @return array
	 */
	public function with()
{
    return [
        'shortcode' => get_field('shortcode'),
        'flip' => get_field('flip'),
        
        // Zupy
        'soup_price' => get_field('soup_price', 'option'),
        'soup_min_portions' => get_field('soup_min_portions', 'option'),
        'soups' => get_field('soups', 'option'),
        'soup_hint' => get_field('soup_hint', 'option'),
        
        // Dania główne
        'main_dish_price' => get_field('main_dish_price', 'option'),
        'main_dish_child_price' => get_field('main_dish_child_price', 'option'),
        'main_dish_min_portions' => get_field('main_dish_min_portions', 'option'),
        'meats' => get_field('meats', 'option'),
        'sides' => get_field('sides', 'option'),
        'vegetables' => get_field('vegetables', 'option'),
        'main_dish_hint' => get_field('main_dish_hint', 'option'),
        
        // Zakąski
        'appetizer_price' => get_field('appetizer_price', 'option'),
        'appetizer_rule' => get_field('appetizer_rule', 'option'),
        'appetizers' => get_field('appetizers', 'option'),
        'appetizer_hint' => get_field('appetizer_hint', 'option'),
        
        // Desery
        'dessert_price' => get_field('dessert_price', 'option'),
        'dessert_max_choices' => get_field('dessert_max_choices', 'option'),
        'desserts' => get_field('desserts', 'option'),
        
        // Obsługa
        'waiter_service' => get_field('waiter_service', 'option'),
        'live_cooking' => get_field('live_cooking', 'option'),
        'chef_service' => get_field('chef_service', 'option'),
        'hot_buffet_price' => get_field('hot_buffet_price', 'option'),
        
        // Napoje
        'coffee_buffet_price' => get_field('coffee_buffet_price', 'option'),
        'coffee_buffet_content' => get_field('coffee_buffet_content', 'option'),
        'drinks_price' => get_field('drinks_price', 'option'),
        'drinks_content' => get_field('drinks_content', 'option'),
        
        // Komunikaty
        'min_portions_message' => get_field('min_portions_message', 'option'),
        'equipment_note' => get_field('equipment_note', 'option'),
    ];
}

    /**
     * Enqueue assets for the block.
     *
     * @return void
     */
    public function enqueue()
    {
        // Załącz skrypt JS specyficzny dla tego bloku
        Vite::withEntryPoints(['resources/js/blocks/calc.js']);
    }
}
