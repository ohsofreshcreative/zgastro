<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ProductGrid extends Block
{
	public $name = 'Produkty dla Ciebie';
	public $description = 'product-grid';
	public $slug = 'product-grid';
	public $category = 'woocommerce';
	public $icon = 'grid-view';
	public $keywords = ['produkty', 'kategorie', 'siatka', 'grid', 'woocommerce'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
		'anchor' => true,
	];

	public function fields(): array
	{
		$productGrid = new FieldsBuilder('product_grid');

		$productGrid
			->setLocation('block', '==', 'acf/' . $this->slug)
			->addText('block-title', [
				'label' => 'Tytuł (widoczny tylko w panelu)',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Produkty dla Ciebie',
				'open' => false,
				'multi_expand' => true,
			])
			->addTab('Treści', ['placement' => 'top'])
            ->addText('subtitle', ['label' => 'Śródtytuł'])
            ->addText('title', ['label' => 'Tytuł'])
			->addTaxonomy('selected_categories', [
				'label' => 'Wybierz kategorie do wyświetlenia',
				'instructions' => 'Zaznacz kategorie, które chcesz pokazać w tej sekcji. Kolejność na stronie będzie odpowiadać kolejności na tej liście.',
				'taxonomy' => 'product_cat',
				'field_type' => 'checkbox',
				'add_term' => 0,
				'load_terms' => 0,
				'return_format' => 'id',
			])
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

		return $productGrid->build();
	}

	public function with(): array
	{
		$selected_ids = get_field('selected_categories');

		return [
			'categories_data' => $this->getCategoriesWithProducts($selected_ids ?: []),
			'subtitle' => get_field('subtitle'),
			'title' => get_field('title'),
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

	protected function getCategoriesWithProducts(array $selected_ids = []): array
	{
		if (empty($selected_ids)) {
			return [];
		}

		$data = [];

		foreach ($selected_ids as $term_id) {
			$category = get_term($term_id, 'product_cat');

			if (!$category || is_wp_error($category)) {
				continue;
			}

			$args = [
				'post_type'      => 'product',
				'posts_per_page' => 3,
				'orderby'        => 'rand',
				'tax_query'      => [
					[
						'taxonomy' => 'product_cat',
						'field'    => 'term_id',
						'terms'    => $category->term_id,
					],
				],
			];

			$products_query = new \WP_Query($args);

			$products = [];
			if ($products_query->have_posts()) {
				while ($products_query->have_posts()) {
					$products_query->the_post();
					$product_id = get_the_ID();
					$product_obj = wc_get_product($product_id);
					if ($product_obj) {
						$products[] = [
							'title' => get_the_title(),
							'permalink' => get_the_permalink(),
							'image' => get_the_post_thumbnail($product_id, 'woocommerce_thumbnail'),
							'price' => $product_obj->get_price_html(),
						];
					}
				}
			}
			wp_reset_postdata();

			$data[] = [
				'id'        => $category->term_id,
				'name'      => $category->name,
				'slug'      => $category->slug,
				'link'      => get_term_link($category),
				'products'  => $products,
			];
		}

		return $data;
	}
}