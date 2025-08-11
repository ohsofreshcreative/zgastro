{{--
  Checkout terms and conditions area.
  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/checkout/terms.blade.php.
--}}
@php defined('ABSPATH') || exit @endphp

@if (apply_filters('woocommerce_checkout_show_terms', true) && function_exists('wc_terms_and_conditions_checkbox_enabled'))
  @php do_action('woocommerce_checkout_before_terms_and_conditions') @endphp
  <div class="woocommerce-terms-and-conditions-wrapper">
    @php wc_terms_and_conditions_checkbox_template() @endphp
    <div class="woocommerce-terms-and-conditions" style="display: none; max-height: 200px; overflow: auto;">
      @php
        $terms_page_id = wc_get_page_id('terms');
        if ($terms_page_id > 0 && apply_filters('woocommerce_checkout_show_terms_page_content', true)) {
          $terms = get_post($terms_page_id);
          echo '<div class="wc-terms-and-conditions-content">' . wp_kses_post(apply_filters('the_content', $terms->post_content)) . '</div>';
        }
      @endphp
    </div>
  </div>
  @php do_action('woocommerce_checkout_after_terms_and_conditions') @endphp
@endif