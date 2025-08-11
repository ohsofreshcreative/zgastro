<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use WP_Term;
use WP_Error;

class Categories extends Block
{
    public $name = 'Slider - Kategoie produktów';
    public $description = 'categories';
    public $slug = 'categories';
    public $category = 'formatting';
    public $icon = 'image-flip-horizontal';
    public $keywords = ['categories', 'kafelki', 'slider', 'produkty'];
    public $mode = 'edit';
    public $supports = [
        'align' => false,
        'mode' => false,
        'jsx' => true,
    ];

    public function fields()
    {
        $categories = new FieldsBuilder('categories');

        $categories
            ->setLocation('block', '==', 'acf/categories')
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Slider - Kategoie produktów',
				'open' => false,
				'multi_expand' => true,
			])
            ->addTab('Treści', ['placement' => 'top'])
            
            ->addText('subtitle', ['label' => 'Śródtytuł'])
            ->addText('title', ['label' => 'Tytuł'])
            ->addTaxonomy('selected_categories', [
                'label'         => 'Wybierz kategorie produktów',
                'taxonomy'      => 'product_cat',
                'field_type'    => 'checkbox',
                'save_terms'    => 1, 
                'load_terms'    => 1,
                'return_format' => 'object',
            ])

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

        return $categories->build();
    }

    public function with()
    {
        // Pobieramy dane. Ta część powinna już działać poprawnie po zmianie zapisu.
        $rawTerms = get_field('selected_categories');
        $rawTerms = $rawTerms ? (array) $rawTerms : [];

        return [
            'title'      => get_field('title'),
            'subtitle'   => get_field('subtitle'),
            'categories' => $this->mapProductCatToCards($rawTerms),
            'id'         => get_field('id'),
            'class'      => get_field('class'),
			'lightbg' => get_field('lightbg'),
			'nomt' => get_field('nomt'),
        ];
    }

    // Funkcja mapująca pozostaje bez zmian
    protected function mapProductCatToCards($acfTerms): array
    {
        if (empty($acfTerms) || !is_array($acfTerms)) {
            return [];
        }

        $cards = [];
        foreach ($acfTerms as $term) {
            if (!($term instanceof WP_Term)) {
                continue;
            }

            $thumbId = get_term_meta($term->term_id, 'thumbnail_id', true);
            $termLink = get_term_link($term, 'product_cat');

            if (is_wp_error($termLink)) {
                continue;
            }

            $cards[] = [
                'card_image' => $thumbId ? ['ID' => (int) $thumbId] : null,
                'card_title' => $term->name,
                'card_txt'   => $term->description ?: '',
                'button'     => [
                    'url'    => $termLink,
                    'title'  => 'Zobacz produkty',
                    'target' => '_self',
                ],
            ];
        }

        return $cards;
    }
}