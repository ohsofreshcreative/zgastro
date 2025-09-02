<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class CategoryPosts extends Block
{
    public $name = 'Najnowsze wpisy';
    public $description = 'category-posts';
    public $slug = 'category-posts';
    public $category = 'formatting';
    public $icon = 'admin-post';
    public $keywords = ['posts', 'category', 'wpisy', 'kategoria'];
    public $mode = 'edit';
    public $supports = [
        'align' => false,
        'mode' => false,
        'jsx' => true,
    ];

    public function fields()
    {
        $categoryPosts = new FieldsBuilder('category-posts');

        $categoryPosts
            ->setLocation('block', '==', 'acf/category-posts') // ważne!
            ->addText('block-title', [
                'label' => 'Tytuł bloku',
                'required' => 0,
            ])
            ->addAccordion('accordion1', [
                'label' => 'Najnowsze wpisy',
                'open' => true,
                'multi_expand' => true,
            ])
            /*--- FIELDS ---*/
            ->addTab('Treści', ['placement' => 'top'])
            ->addGroup('posts_settings', ['label' => ''])
            
			->addText('title', ['label' => 'Tytuł'])
			->addText('txt', ['label' => 'Śródtytuł'])
            ->addTaxonomy('category', [
                'label' => 'Wybierz kategorię',
                'taxonomy' => 'category',
                'field_type' => 'select',
                'allow_null' => 0,
                'add_term' => 0,
                'save_terms' => 0,
                'load_terms' => 0,
                'return_format' => 'id',
                'multiple' => 0,
                'required' => 1,
            ])
            
            ->addNumber('posts_count', [
                'label' => 'Liczba postów do wyświetlenia',
                'default_value' => 3,
                'min' => 1,
                'max' => 12,
                'required' => 1,
            ])
            
            ->addTrueFalse('show_image', [
                'label' => 'Pokaż obrazek',
                'default_value' => 1,
                'ui' => 1,
                'ui_on_text' => 'Tak',
                'ui_off_text' => 'Nie',
            ])
            
            ->addTrueFalse('show_excerpt', [
                'label' => 'Pokaż fragment treści',
                'default_value' => 1,
                'ui' => 1,
                'ui_on_text' => 'Tak',
                'ui_off_text' => 'Nie',
            ])
            
            ->endGroup()

            /*--- USTAWIENIA BLOKU ---*/

            ->addTab('Ustawienia bloku', ['placement' => 'top'])
            ->addSelect('layout', [
                'label' => 'Układ',
                'choices' => [
                    'grid' => 'Siatka',
                    'list' => 'Lista',
                ],
                'default_value' => 'grid',
                'ui' => 1,
            ])
            ->addTrueFalse('flip', [
                'label' => 'Odwrotna kolejność',
                'ui' => 1,
                'ui_on_text' => 'Tak',
                'ui_off_text' => 'Nie',
            ]);

        return $categoryPosts;
    }

    public function with()
    {
        $posts_settings = get_field('posts_settings');
        $category_id = $posts_settings['category'] ?? 0;
        $posts_count = $posts_settings['show_count'] ?? 3;
        $show_image = $posts_settings['show_image'] ?? true;
        $show_excerpt = $posts_settings['show_excerpt'] ?? true;
        
        // Get posts from the selected category
        $args = [
            'post_type' => 'post',
            'posts_per_page' => $posts_count,
            'cat' => $category_id,
            'post_status' => 'publish',
        ];
        
        $query = new \WP_Query($args);
        $posts = $query->posts;
        
        return [
			'posts_settings' => get_field('posts_settings'),
            'category_id' => $category_id,
            'posts' => $posts,
            'show_image' => $show_image,
            'show_excerpt' => $show_excerpt,
            'layout' => get_field('layout'),
            'flip' => get_field('flip'),
        ];
    }
}