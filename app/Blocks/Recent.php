<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use WP_Query;
use WC_Product;

class Recent extends Block
{
    public $name = 'Slider - Najnowsze produkty';
    public $description = 'recent';
    public $slug = 'recent'; // ZMIANA: recent-products -> recent
    public $category = 'formatting';
    public $icon = 'products';
    public $keywords = ['produkty', 'najnowsze', 'slider', 'recent'];
    public $mode = 'edit';
    public $supports = [
        'align' => false,
        'mode' => false,
        'jsx' => true,
    ];

    public function fields()
    {
        $recent = new FieldsBuilder('recent'); // ZMIANA: recent_products -> recent

        $recent
            ->setLocation('block', '==', 'acf/recent') // ZMIANA: acf/recent-products -> acf/recent
           ->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
            ->addAccordion('accordion_content', [
                'label' => 'Slider - Najnowsze produkty',
                'open' => true,
                'multi_expand' => false,
            ])
			->addTab('Treści', ['placement' => 'top'])
            ->addText('subtitle', ['label' => 'Śródtytuł'])
            ->addText('title', ['label' => 'Tytuł'])

			->addTab('Ustawienia bloku', ['placement' => 'top'])
            
            ->addText('id', [
                'label' => 'ID sekcji',
            ])
            ->addText('class', [
                'label' => 'Dodatkowe klasy CSS',
            ])
            ->addTrueFalse('lightbg', [
                'label' => 'Jasne tło',
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

        return $recent->build();
    }

    public function with()
    {
        return [
            'title'      => get_field('title'),
            'subtitle'   => get_field('subtitle'),
            'products'   => $this->getRecentProductsData(),
            'id'         => get_field('id'),
            'class'      => get_field('class'),
            'lightbg'    => get_field('lightbg'),
            'nomt'       => get_field('nomt'),
        ];
    }

    protected function getRecentProductsData(): array
    {
        $args = [
            'post_type'      => 'product',
            'posts_per_page' => 12,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'post_status'    => 'publish',
            'tax_query'      => [
                [
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'exclude-from-catalog',
                    'operator' => 'NOT IN',
                ],
            ],
        ];

        $query = new WP_Query($args);

        if (!$query->have_posts()) {
            return [];
        }

        return $this->mapProductsToCards($query->posts);
    }

    protected function mapProductsToCards(array $posts): array
    {
        $cards = [];
        foreach ($posts as $post) {
            /** @var WC_Product $product */
            $product = wc_get_product($post);

            if (!$product) {
                continue;
            }

            $cards[] = [
                'card_image' => $product->get_image_id() ? ['ID' => $product->get_image_id()] : null,
                'card_title' => $product->get_name(),
                'card_txt'   => $product->get_price_html(),
                'button'     => [
                    'url'    => $product->get_permalink(),
                    'title'  => 'Zobacz produkt',
                    'target' => '_self',
                ],
            ];
        }
        wp_reset_postdata();

        return $cards;
    }
}