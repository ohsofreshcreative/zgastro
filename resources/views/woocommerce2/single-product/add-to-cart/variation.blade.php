{{--
  Single variation display (POPRAWIONA WERSJA)

  This is a javascript-based template for single variations.
  The @ symbol is used to prevent Blade from processing the {{{ }}} syntax.
--}}

@php
  defined('ABSPATH') || exit;
@endphp

<script type="text/template" id="tmpl-variation-template">
  <div class="woocommerce-variation-description">@{{{ data.variation.variation_description }}}</div>
  <div class="woocommerce-variation-price">@{{{ data.variation.price_html }}}</div>
  <div class="woocommerce-variation-availability">@{{{ data.variation.availability_html }}}</div>
</script>

<script type="text/template" id="tmpl-unavailable-variation-template">
  <p role="alert">{{ esc_html__('Sorry, this product is unavailable. Please choose a different combination.', 'woocommerce') }}</p>
</script>