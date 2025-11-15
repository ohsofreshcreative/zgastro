<?php

/**
 * Theme setup.
 */

namespace App;

use Illuminate\Support\Facades\Vite;

/**
 * Inject styles into the block editor.
 *
 * @return array
 */
add_filter('block_editor_settings_all', function ($settings) {
	$style = Vite::asset('resources/css/editor.css');

	$settings['styles'][] = [
		'css' => "@import url('{$style}')",
	];

	return $settings;
});

/**
 * Inject scripts into the block editor.
 *
 * @return void
 */
add_filter('admin_head', function () {
	if (! get_current_screen()?->is_block_editor()) {
		return;
	}

	$dependencies = json_decode(Vite::content('editor.deps.json'));

	foreach ($dependencies as $dependency) {
		if (! wp_script_is($dependency)) {
			wp_enqueue_script($dependency);
		}
	}

	echo Vite::withEntryPoints([
		'resources/js/editor.js',
	])->toHtml();
});

/**
 * Use the generated theme.json file.
 *
 * @return string
 */
add_filter('theme_file_path', function ($path, $file) {
	return $file === 'theme.json'
		? public_path('build/assets/theme.json')
		: $path;
}, 10, 2);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {

	// Dodaj wsparcie dla WooCommerce
	add_theme_support('woocommerce');
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support('wc-product-gallery-slider');
	/**
	 * Disable full-site editing support.
	 *
	 * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
	 */
	remove_theme_support('block-templates');

	/**
	 * Register the navigation menus.
	 *
	 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
	 */
	register_nav_menus([
		'primary_navigation' => __('Primary Navigation', 'sage'),
	]);

	/**
	 * Disable the default block patterns.
	 *
	 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
	 */
	remove_theme_support('core-block-patterns');

	/**
	 * Enable plugins to manage the document title.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
	 */
	add_theme_support('title-tag');

	/**
	 * Enable post thumbnail support.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	/**
	 * Enable responsive embed support.
	 *
	 * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
	 */
	add_theme_support('responsive-embeds');

	/**
	 * Enable HTML5 markup support.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
	 */
	add_theme_support('html5', [
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'search-form',
		'script',
		'style',
	]);

	/**
	 * Enable selective refresh for widgets in customizer.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
	 */
	add_theme_support('customize-selective-refresh-widgets');

    /**
     * Custom WooCommerce functionality.
     */
    if (class_exists('WooCommerce')) {
        require_once \locate_template('app/woocommerce.php');
    }

}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
	$defaultConfig = [
		'before_widget' => '<section class="footer_widget widget %1$s %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h5 class="widget-title text-p-lighter mb-4 flex">',
		'after_title' => '</h5>',
	];

	register_sidebar([
		'name' => __('Primary', 'sage'),
		'id' => 'sidebar-primary',
	] + $defaultConfig);

	register_sidebar([
		'name' => __('Footer 1', 'sage'),
		'id'   => 'sidebar-footer-1',
	] + $defaultConfig);

	register_sidebar([
		'name' => __('Footer 2', 'sage'),
		'id'   => 'sidebar-footer-2',
	] + $defaultConfig);

	register_sidebar([
		'name' => __('Footer 3', 'sage'),
		'id'   => 'sidebar-footer-3',
	] + $defaultConfig);

	register_sidebar([
		'name' => __('Footer 4', 'sage'),
		'id'   => 'sidebar-footer-4',
	] + $defaultConfig);

	register_sidebar([
		'name' => __('Footer 5', 'sage'),
		'id'   => 'sidebar-footer-5',
	] + $defaultConfig);
});

/*--- PRODUCT SHORT DESC ---*/
// Przenieś krótki opis pod Add to Cart i meta
/* add_action('after_setup_theme', function () {
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10);
	add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
});
 */
/*--- ADD ATRIBUTES --*/

/* add_action('woocommerce_single_product_summary', function () {
	global $product;
	if (!$product instanceof \WC_Product) {
		return;
	}
	echo '<section class="product-attributes mt-8 pt-8">';
	echo '<h5 class="mb-4">Szczegóły</h5>';
	// To buduje $product_attributes i samo wczytuje poprawny template
	wc_display_product_attributes($product);
	echo '</section>';
}, 20);
 */

/*--- PRICE ABOVE ADD TO CART ---*/

add_filter('woocommerce_get_price_html', function ($price, $product) {
    if (!empty($price) && is_product()) {
        $price = '<span class="price-label">Cena: </span>' . $price;
    }
    return $price;
}, 10, 2);

add_filter('woocommerce_variable_price_html', function ($price, $product) {
	// zwróć pusty string => Woo nie pokaże przedziału
	return '';
}, 10, 2);

// Przenieś cenę nad przycisk Add to cart
add_action('after_setup_theme', function () {
	// Usuń domyślną pozycję ceny (10)
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

	// Wstaw cenę tuż nad przyciskiem Add to cart (priorytet 9, żeby było nad 10)
	add_action('woocommerce_before_add_to_cart_button', 'woocommerce_template_single_price', 9);
});

/*--- CHANGE ADD TO CART TO SEE DETAILS ---*/

add_action('after_setup_theme', function () {
    // usuń domyślny button "Dodaj do koszyka"
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

    // dodaj własny przycisk "Zobacz produkt"
    add_action('woocommerce_after_shop_loop_item', function () {
        global $product;
        echo '<a href="' . get_permalink($product->get_id()) . '" class="button">Zobacz produkt</a>';
    }, 10);
});

/*--- REMOVE RESULT COUNT ---*/

add_action('init', function () {
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
}, 20);

/*--- HIDE RESET VARIATIONS */

// Miniatury galerii 150x150, BEZ przycinania
add_filter('woocommerce_get_image_size_gallery_thumbnail', function ($size) {
    return [
        'width'  => 150,
        'height' => 150,
        'crop'   => 0, // ważne: bez croppa
    ];
}, 10);

// Upewnij się, że Woo używa właśnie tego rozmiaru
add_filter('woocommerce_gallery_thumbnail_size', function () {
    return 'woocommerce_gallery_thumbnail';
});



/*--- HIDE RESET VARIATIONS */

add_filter('woocommerce_reset_variations_link', '__return_empty_string');

/*--- HIDE QUANTITY ---*/

// Ukryj quantity TYLKO na stronie produktu
add_filter('woocommerce_is_sold_individually', function ($sold_individually, $product) {
	if (is_product()) {
		return true; // Brak pola ilości na stronie produktu
	}
	return $sold_individually;
}, 10, 2);


/*--- WOOCOMMERCE - HIDE TABS ---*/

add_filter('woocommerce_product_tabs', '__return_empty_array', 98);

/*--- PRODUCT FIELDS ---*/

add_action('acf/init', function () {
	if (!function_exists('acf_add_local_field_group')) {
		return;
	}

	acf_add_local_field_group([
		'key' => 'group_product_extras',
		'title' => 'Dodatkowe informacje o produkcie',
		'fields' => [
			[
				'key' => 'field_product_extras',
				'label' => 'Sekcje',
				'name' => 'product_extras', // <- repeater
				'type' => 'repeater',
				'layout' => 'table',
				'collapsed' => '',
				'button_label' => 'Dodaj sekcję',
				'sub_fields' => [
					[
						'key' => 'field_product_extras_header',
						'label' => 'Nagłówek',
						'name' => 'header',
						'type' => 'text',
						'wrapper' => ['width' => 35],
					],
					[
						'key' => 'field_product_extras_text',
						'label' => 'Tekst',
						'name' => 'text',
						'type' => 'wysiwyg',
						'tabs' => 'all', 
						'toolbar' => 'full', 
						'media_upload' => 0,  
						'delay' => 1,
						'wrapper' => ['width' => 65],
					],
				],
			],
		],
		'location' => [
			[
				[
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
				],
			],
		],
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'active' => true,
		'description' => '',
		// opcjonalnie: warunki widoczności tylko dla konkretnej kategorii
		// 'conditional_logic' => 0,
	]);
});

add_action('woocommerce_single_product_summary', function () {
	echo \Roots\view('woocommerce/single-product/acf-extras')->render();
}, 25);

/*--- AJAX CART ---*/

// AJAX fragment dla licznika koszyka
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
	ob_start(); ?>
	<span class="js-cart-count absolute -top-1 -right-1 min-w-[1.25rem] h-5 px-1 rounded-full bg-primary text-white text-xs flex items-center justify-center">
		<?= WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?>
	</span>
<?php
	$fragments['.js-cart-count'] = ob_get_clean();
	return $fragments;
});


add_action('rest_api_init', function () {
	register_rest_route('oos/v1', '/search-products', [
		'methods'  => 'GET',
		'callback' => function (\WP_REST_Request $req) {
			$q = trim((string) $req->get_param('q'));
			if (mb_strlen($q) < 3) {
				return new \WP_REST_Response(['items' => []], 200);
			}

			$args = [
				'post_type'           => 'product',
				'post_status'         => 'publish',
				's'                   => $q,
				'posts_per_page'      => 8,
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
			];

			$query  = new \WP_Query($args);
			$items  = [];

			foreach ($query->posts as $p) {
				$id      = $p->ID;
				$product = wc_get_product($id);
				if (!$product) continue;

				$items[] = [
					'id'    => $id,
					'title' => get_the_title($id),
					'url'   => get_permalink($id),
					'img'   => get_the_post_thumbnail_url($id, 'woocommerce_thumbnail') ?: wc_placeholder_img_src('woocommerce_thumbnail'),
					'price' => $product->get_price_html(),
				];
			}

			return new \WP_REST_Response(['items' => $items], 200);
		},
		'permission_callback' => '__return_true',
	]);
});

/*--- NOWOŚCI ---*/

// ===============================================
// NOWOŚCI: /nowosci  (jak Sklep, tylko nowsze X dni)
// ===============================================

// 1) Rewrites + query vars
add_action('init', function () {
	add_rewrite_tag('%novelties%', '([0-1])');
	add_rewrite_rule('^nowosci/?$', 'index.php?post_type=product&novelties=1', 'top');
	add_rewrite_rule('^nowosci/page/([0-9]+)/?$', 'index.php?post_type=product&novelties=1&paged=$matches[1]', 'top');
});

add_filter('query_vars', function ($vars) {
	$vars[] = 'novelties';
	$vars[] = 'days'; // ?days=30|60|90
	return $vars;
});

// 2) Filtrowanie produktów po dacie (domyślnie 30 dni)
add_action('woocommerce_product_query', function ($q) {
	if (!get_query_var('novelties')) {
		return;
	}
	$allowed = [30, 60, 90];
	$days = (int) get_query_var('days');
	if (!in_array($days, $allowed, true)) {
		$days = 30;
	}

	$q->set('date_query', [[
		'after'     => date_i18n('Y-m-d', strtotime("-{$days} days")),
		'column'    => 'post_date',
		'inclusive' => true,
	]]);
}, 10, 1);

// 3) Toolbar 30/60/90 — WIDOCZNY ZAWSZE (również gdy brak produktów)
add_action('woocommerce_archive_description', function () {
	if (!get_query_var('novelties')) return;

	$allowed = [30, 60, 90];
	$days = (int) get_query_var('days');
	if (!in_array($days, $allowed, true)) $days = 30;

	$base = home_url('/nowosci/');

	echo '<div class="novelties-toolbar" style="margin:1rem 0; display:flex; gap:16px; flex-wrap:wrap;">';
	foreach ($allowed as $d) {
		$url = add_query_arg('days', $d, $base);
		$active = $d === $days ? ' active' : '';
		printf(
			'<a href="%s" class="menu-btn%s">%s</a>',
			esc_url($url),
			esc_attr($active),
			esc_html(sprintf(__('Ostatnie %d dni', 'woocommerce'), $d))
		);
	}
	echo '</div>';
}, 20);

// (opcjonalnie) lekki styl aktywnego przycisku
add_action('wp_head', function () {
	if (get_query_var('novelties')) {
		echo '<style>.novelties-toolbar .button.active{font-weight:600;}</style>';
	}
});

// 4) Fallback: gdy brak produktów — pokaż najnowsze (standardowy grid Woo)
add_action('woocommerce_no_products_found', function () {
	if (!get_query_var('novelties')) return;

	echo '<div class="woocommerce-info" style="margin-bottom:1rem;">'
		. esc_html__('Brak nowości w wybranym okresie — zobacz najnowsze produkty:', 'woocommerce')
		. '</div>';

	// standardowy shortcode WooCommerce (grid jak w Sklepie)
	echo do_shortcode('[products orderby="date" order="DESC" limit="12" columns="4"]');
}, 5);

// 5) (opcjonalnie) zmiana tytułu strony
add_filter('woocommerce_page_title', function ($title) {
	if (get_query_var('novelties')) {
		$days = (int) get_query_var('days');
		if (!in_array($days, [30, 60, 90], true)) $days = 30;
		return sprintf(__('Nowości – ostatnie %d dni', 'your-textdomain'), $days);
	}
	return $title;
});

/*--- SALE ---*/

// 1) Rewrites + query var
add_action('init', function () {
	add_rewrite_tag('%onsale%', '([0-1])');
	add_rewrite_rule('^wyprzedaz/?$', 'index.php?post_type=product&onsale=1', 'top');
	add_rewrite_rule('^wyprzedaz/page/([0-9]+)/?$', 'index.php?post_type=product&onsale=1&paged=$matches[1]', 'top');
});

add_filter('query_vars', function ($vars) {
	$vars[] = 'onsale';
	return $vars;
});

// 2) Zawężenie wyników do produktów na promocji
add_action('woocommerce_product_query', function ($q) {
	if (!get_query_var('onsale')) {
		return;
	}

	// WooCommerce helper – zwraca ID produktów będących „on sale”
	$ids = wc_get_product_ids_on_sale(); // może zwracać puste

	// Jeśli nic nie ma na promocji – ustaw tak, by loop był pusty (a my pokażemy fallback w hooku niżej)
	if (empty($ids)) {
		$q->set('post__in', [0]);
		return;
	}

	// Ogranicz zapytanie do tych ID; reszta (sortowanie, paginacja) zostaje jak w Sklepie
	$q->set('post__in', $ids);
	// UWAGA: jeśli masz już jakieś post__in w $q (rzadkie), połącz je:
	// $existing = (array) $q->get('post__in'); $q->set('post__in', array_values(array_intersect($existing ?: $ids, $ids)));
}, 10, 1);

// 3) (opcjonalnie) zmiana tytułu strony
add_filter('woocommerce_page_title', function ($title) {
	if (get_query_var('onsale')) {
		return __('Wyprzedaż', 'your-textdomain');
	}
	return $title;
});

// 4) (opcjonalnie) breadcrumb „Wyprzedaż” zamiast „Sklep”
add_filter('woocommerce_get_breadcrumb', function ($crumbs) {
	if (!get_query_var('onsale')) {
		return $crumbs;
	}
	// Podmień ostatni okruszek na „Wyprzedaż”
	if (!empty($crumbs)) {
		$crumbs[count($crumbs) - 1] = [__('Wyprzedaż', 'your-textdomain'), home_url('/wyprzedaz/')];
	}
	return $crumbs;
});

// 5) Fallback: gdy brak produktów na wyprzedaży – pokaż najnowsze (standardowy grid Woo)
add_action('woocommerce_no_products_found', function () {
	if (!get_query_var('onsale')) {
		return;
	}

	echo '<div class="woocommerce-info" style="margin-bottom:1rem;">'
		. esc_html__('Aktualnie brak produktów na wyprzedaży — zobacz najnowsze produkty:', 'woocommerce')
		. '</div>';

	// Grid WooCommerce – wygląda jak na Sklepie
	echo do_shortcode('[products orderby="date" order="DESC" limit="12" columns="4"]');
}, 5);

// Usuń kategorie i tagi z meta produktu na stronie produktu
add_action('template_redirect', function () {
	if (is_product()) {
		remove_action('woocommerce_product_meta_end', 'woocommerce_template_single_meta');
		add_action('woocommerce_product_meta_end', function () {
			global $product;

			if (wc_product_sku_enabled() && ($sku = $product->get_sku())) {
				echo '<span class="sku_wrapper">';
				echo '<strong>Kod produktu:</strong> ';
				echo '<span class="sku" itemprop="sku">' . esc_html($sku) . '</span>';
				echo '</span>';
			}
		});
	}
});

/*--- SKU EDIT ---*/

// Single product: pokaż w meta TYLKO SKU z etykietą "Kod produktu:"
add_action('wp', function () {
	if (! is_product()) {
		return;
	}

	// Usuń domyślne meta (SKU + kategorie + tagi)
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

	// Wstaw własne meta w tym samym miejscu (prio 40)
	add_action('woocommerce_single_product_summary', function () {
		global $product;
		if (! $product instanceof \WC_Product) {
			return;
		}

		// Czy SKU jest włączone i dostępne?
		if (wc_product_sku_enabled()) {
			$sku = $product->get_sku();

			// Jeśli SKU jest puste, nic nie pokazujemy
			if (! $sku) {
				return;
			}

			echo '<div class="product_meta">';
			echo '  <span class="sku_wrapper">';
			echo '    <strong>' . esc_html__('Kod produktu:', 'your-textdomain') . '</strong> ';
			echo '    <span class="sku" itemprop="sku">' . esc_html($sku) . '</span>';
			echo '  </span>';
			echo '</div>';
		}
	}, 40);
});


add_action('template_redirect', function () {
    // Sprawdzamy, czy jesteśmy na stronie produktu i czy ma ona ustawione pole "coming_soon".
    if (is_product() && get_post_meta(get_the_ID(), 'coming_soon', true)) {
        
        // Zamiast wstrzykiwać HTML, renderujemy nasz dedykowany widok Blade.
        // Funkcja \Roots\view() jest kluczowa w Sage.
        echo \Roots\view('coming-soon');
        
        // Zatrzymujemy dalsze wykonywanie skryptu, aby WordPress/WooCommerce
        // nie próbował załadować standardowego szablonu produktu.
        exit;
    }
});

/*--- WOOCOMMERCE SHIPPING CLASS POSTCODE RESTRICTION ---*/

add_filter('woocommerce_package_rates', function ($rates, $package) {
    $shipping_class_slug = 'dostawa-lokalna';

    $restricted_item_in_cart = false;
    foreach ($package['contents'] as $item) {
        if ($item['data']->get_shipping_class() === $shipping_class_slug) {
            $restricted_item_in_cart = true;
            break;
        }
    }

    if (!$restricted_item_in_cart) {
        return $rates;
    }

    $postcode = $package['destination']['postcode'];
    $normalized_postcode = preg_replace('/[^\d-]/', '', $postcode);

    $is_allowed = false;
    if (!empty($normalized_postcode)) {
        $allowed_patterns = [
            '/^0[0-4]-\d{3}$/',
            '/^05-0[7-9]\d$/',
            '/^05-2\d{2}$/',
            '/^05-4\d{2}$/',
            '/^05-5\d{2}$/',
            '/^05-8\d{2}$/',
        ];

        $allowed_individual_codes = [
            '05-100', '05-300',
        ];

        foreach ($allowed_patterns as $pattern) {
            if (preg_match($pattern, $normalized_postcode)) {
                $is_allowed = true;
                break;
            }
        }

        if (!$is_allowed && in_array($normalized_postcode, $allowed_individual_codes)) {
            $is_allowed = true;
        }
    }

    if (!$is_allowed) {
        return [];
    }

    return $rates;
}, 100, 2);

add_action('woocommerce_after_calculate_totals', function ($cart) {
    if (is_admin() && !defined('DOING_AJAX')) {
        return;
    }

    // Wyświetlaj powiadomienie tylko na stronie koszyka i zamówienia
    if (!is_cart() && !is_checkout()) {
        return;
    }

    // Sprawdź, czy dla pierwszego pakietu są dostępne metody wysyłki
    $shipping_packages = WC()->shipping->get_packages();
    $rates = $shipping_packages[0]['rates'] ?? [];

    // Jeśli są dostępne metody wysyłki, nie robimy nic
    if (!empty($rates)) {
        return;
    }

    $shipping_class_slug = 'dostawa-lokalna';
    $restricted_products = [];

    // Zbierz produkty z ograniczoną klasą wysyłki
    foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
        if ($cart_item['data']->get_shipping_class() === $shipping_class_slug) {
            $restricted_products[$cart_item_key] = $cart_item['data'];
        }
    }

    // Jeśli znaleziono produkty z ograniczeniami i nie ma dla nich metod dostawy
    if (!empty($restricted_products)) {
        $message = '<p class="mb-2">Niestety, dla wskazanej lokalizacji nie oferujemy dostawy dla następujących produktów:</p>';
        $message .= '<ul class="list-disc pl-5 mb-4">';

        foreach ($restricted_products as $cart_item_key => $product) {
            $product_name = $product->get_name();
            $remove_url = wc_get_cart_remove_url($cart_item_key);
            $message .= sprintf(
                '<li class="font-semibold">%s <a href="%s" class="remove_from_cart_button text-third" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times; Usuń</a></li>',
                esc_html($product_name),
                esc_url($remove_url),
                esc_attr(sprintf('Usuń %s z koszyka', $product_name)),
                esc_attr($product->get_id()),
                esc_attr($cart_item_key),
                esc_attr($product->get_sku())
            );
        }

        $message .= '</ul>';
        $message .= '<p>Aby kontynuować, usuń te produkty z koszyka lub zmień adres dostawy.</p>';

        // Dodaj powiadomienie, jeśli jeszcze nie istnieje
        if (!wc_has_notice($message, 'error')) {
            wc_add_notice($message, 'error');
        }
    }
}, 9999);

/*--- REMOVE PAGINATION ---*/

remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);

/**
 * Rejestruje endpoint AJAX do ładowania produktów.
 */
add_action('wp_ajax_load_more_products', 'App\load_more_products_ajax_handler');
add_action('wp_ajax_nopriv_load_more_products', 'App\load_more_products_ajax_handler');

/**
 * Handler AJAX do ładowania kolejnej strony produktów.
 */
function load_more_products_ajax_handler() {
    if (!isset($_POST['query']) || !isset($_POST['page'])) {
        wp_send_json_error('Brakujące parametry.');
    }

    $query_vars = json_decode(stripslashes($_POST['query']), true);
    $query_vars['paged'] = intval($_POST['page']);
    $query_vars['post_status'] = 'publish';

    $products = new \WP_Query($query_vars);

    if ($products->have_posts()) {
        ob_start();
        while ($products->have_posts()) {
            $products->the_post();
            wc_get_template_part('content', 'product');
        }
        $html = ob_get_clean();
        wp_send_json_success(['html' => $html]);
    } else {
        wp_send_json_error('Brak kolejnych produktów.');
    }

    wp_die();
}


add_action('wp_head', function () {
    if (!is_shop() && !is_product_category() && !is_product_tag()) {
        return;
    }

    global $wp_query;

    $data = [
        'ajax_url' => admin_url('admin-ajax.php'),
        'query_vars' => json_encode($wp_query->query_vars),
    ];

    // Tworzymy obiekt window.sage bezpośrednio w tagu <script>
    $script = 'window.sage = ' . json_encode($data) . ';';

    echo '<script type="text/javascript">' . $script . '</script>';
}, 20);