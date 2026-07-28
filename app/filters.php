<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});



add_filter('gettext', function ($translated_text, $text, $domain) {
    if ($domain === 'woocommerce' && $text === 'Calculate shipping') {
        return 'Zmień miejsce dostawy';
    }
    return $translated_text;
}, 20, 3);


/**
 * Change number of products displayed per page.
 */
add_filter('loop_shop_per_page', function ($cols) {
    return 18;
}, 20);

/**
 * Czyści HTML.
 */
function clean_html($value)
{
    if (! is_string($value) || trim($value) === '') {
        return $value;
    }

    $allowedHtml = [
        'p' => [],
        'br' => [],
        'strong' => [],
        'b' => [],
        'em' => [],
        'i' => [],
        'u' => [],
        's' => [],
        'blockquote' => [],
        'ul' => [],
        'ol' => [],
        'li' => [],
        'h2' => [],
        'h3' => [],
        'h4' => [],
        'h5' => [],
        'a' => [
            'href'   => true,
            'title'  => true,
            'target' => true,
            'rel'    => true,
        ],
    ];

    return wp_kses($value, $allowedHtml);
}

/**
 * ACF WYSIWYG
 */
add_filter('acf/update_value/type=wysiwyg', function ($value) {
    return clean_html($value);
});

/**
 * WooCommerce - długi i krótki opis produktu.
 */
add_filter('wp_insert_post_data', function ($data) {

    if (($data['post_type'] ?? '') !== 'product') {
        return $data;
    }

    $data['post_content'] = clean_html($data['post_content'] ?? '');
    $data['post_excerpt'] = clean_html($data['post_excerpt'] ?? '');

    return $data;

}, 10, 2);