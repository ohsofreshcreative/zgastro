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
		'before_title' => '<h5 class="widget-title primary mb-4 flex">',
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


/*-- CAREER MODAL ---*/

add_action('wp_footer', function () {
	$cf7_shortcode = '[contact-form-7 id="e0f7075" title="Wyślij CV"]';

	echo '
    <!-- Modal Overlay -->
    <div id="side-modal-overlay" class="fixed inset-0 bg-black bg-opacity-20 z-50 hidden transition-opacity duration-300 ease-in-out"></div>

    <!-- Side Modal -->
    <div id="side-modal" class="fixed top-0 right-0 h-full w-full max-w-lg bg-white shadow-lg z-50 transform translate-x-full transition-transform duration-300 ease-in-out">
        <div class="p-8 h-full overflow-y-auto">
            <button id="modal-close-btn" class="absolute top-4 right-4 text-gray-600 hover:text-gray-900 text-2xl">&times;</button>
			<h5 class="m-title">Aplikuj na to stanowisko</h5>
            <div>Wypełnij formularz i dołącz swoje CV – odezwiemy się, aby omówić szczegóły i odpowiedzieć na Twoje pytania.</div>
            <!-- CF7 Form Container -->
            <div class="modal-content mt-8">
                ' . do_shortcode($cf7_shortcode) . '
            </div>
        </div>
    </div>
    ';
});

