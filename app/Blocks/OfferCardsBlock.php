<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class OfferCardsBlock extends Block
{
	/**
	 * The block name.
	 *
	 * @var string
	 */
	public $name = 'Kafelki oferty';

	/**
	 * The block description.
	 *
	 * @var string
	 */
	public $description = 'Blok wyświetlający kafelki oferty z ustawień';

	/**
	 * The block slug.
	 *
	 * @var string
	 */
	public $slug = 'offer-cards-block';

	/**
	 * The block category.
	 *
	 * @var string
	 */
	public $category = 'formatting';

	/**
	 * The block icon.
	 *
	 * @var string|array
	 */
	public $icon = 'grid-view';

	/**
	 * The block keywords.
	 *
	 * @var array
	 */
	public $keywords = ['offer', 'cards', 'oferta', 'kafelki'];

	/**
	 * The default block mode.
	 *
	 * @var string
	 */
	public $mode = 'edit';

	/**
	 * The supported block features.
	 *
	 * @var array
	 */
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
		'multiple' => true,
		'anchor' => true,
		'customClassName' => true,
	];

	/**
	 * Data to be passed to the block before rendering.
	 *
	 * @return array
	 */

	/**
	 * The block field group.
	 *
	 * @return array
	 */
	public function fields()
	{
		$offerCardsBlock = new FieldsBuilder('offer-cards-block');

		$offerCardsBlock
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Kafelki oferty',
				'open' => false,
				'multi_expand' => true,
			])

			->addTab('Elementy', ['placement' => 'top'])
			->addText('title')
			->addWysiwyg('content', [
				'label' => 'Treść',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => true,
			])
			->addSelect('display_type', [
				'label' => 'Typ wyświetlania',
				'choices' => [
					'grid' => 'Siatka',
					'slider' => 'Slider',
				],
				'default_value' => 'grid',
				'required' => 1,
			])
			->addSelect('columns', [
				'label' => 'Liczba kolumn (w siatce)',
				'choices' => [
					'2' => '2 kolumny',
					'3' => '3 kolumny',
					'4' => '4 kolumny',
				],
				'default_value' => '3',
				'required' => 0,
				'conditional_logic' => [
					[
						[
							'field' => 'display_type',
							'operator' => '==',
							'value' => 'grid',
						],
					],
				],
			])
			
			/*--- USTAWIENIA BLOKU ---*/

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			
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

		return $offerCardsBlock->build();
	}

	public function with()
	{
		return [
			'block_title' => get_field('block_title'),
			'display_type' => get_field('display_type'),
			'columns' => get_field('columns'),
			'offer_cards' => get_field('offer-cards', 'option'),
			'title' => get_field('title'),
			'content' => get_field('content'),
			'nomt' => get_field('nomt'),
			'lightbg' => get_field('lightbg'),
			'graybg' => get_field('graybg'),
			'whitebg' => get_field('whitebg'),
			'brandbg' => get_field('brandbg'),
		];
	}

	/**
	 * Assets to be enqueued when rendering the block.
	 *
	 * @return void
	 */
}
