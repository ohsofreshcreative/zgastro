@php
  defined('ABSPATH') || exit;
@endphp

<div id="product-{{ get_the_ID() }}" class="c-main">

  <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    
    {{-- Lewa kolumna - galeria produktu --}}
    <div class="product-gallery">
      @php
        /**
         * WooCommerce hook
         * @hooked woocommerce_show_product_images - 20
         */
        do_action('woocommerce_before_single_product_summary');
      @endphp
    </div>

    {{-- Prawa kolumna - tytuł, cena, opis, przycisk Add to Cart --}}
    <div class="product-summary space-y-6">
      @php
        /**
         * WooCommerce hook
         * Domyślnie:
         * - woocommerce_template_single_title (5)
         * - woocommerce_template_single_rating (10)
         * - woocommerce_template_single_price (10)
         * - woocommerce_template_single_excerpt (20)
         * - woocommerce_template_single_add_to_cart (30) <-- my podmieniamy tym co w app/setup.php
         * - woocommerce_template_single_meta (40)
         * - woocommerce_template_single_sharing (50)
         */
        do_action('woocommerce_single_product_summary');
      @endphp
    </div>

  </div>

  {{-- Opis, recenzje, dodatkowe sekcje --}}
  <div class="mt-12">
    @php
      /**
       * WooCommerce hook
       * @hooked woocommerce_output_product_data_tabs - 10
       * @hooked woocommerce_upsell_display - 15
       * @hooked woocommerce_output_related_products - 20
       */
      do_action('woocommerce_after_single_product_summary');
    @endphp
  </div>

</div>
