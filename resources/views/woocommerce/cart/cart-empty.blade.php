{{--
  Empty Cart page
  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/cart/cart-empty.blade.php.
--}}
@php defined('ABSPATH') || exit @endphp

@php do_action('woocommerce_cart_is_empty') @endphp

@if (wc_get_page_id('shop') > 0)
  <p class="cart-empty woocommerce-info">
    {{ apply_filters('wc_empty_cart_message', __('Your cart is currently empty.', 'woocommerce')) }}
  </p>

  <p class="return-to-shop">
    <a class="button wc-backward" href="{!! esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))) !!}">
      {{ esc_html_e('Return to shop', 'woocommerce') }}
    </a>
  </p>
@endif