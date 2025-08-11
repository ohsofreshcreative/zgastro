{{--
  Simple product add to cart

  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/single-product/add-to-cart/simple.blade.php.
--}}
@php
  if (!defined('ABSPATH')) {
    exit;
  }
  global $product;

  if (!$product->is_purchasable()) {
    return;
  }
@endphp

{!! $product->is_in_stock() ? '' : '<p class="stock out-of-stock">' . esc_html__('This product is currently out of stock and unavailable.', 'woocommerce') . '</p>' !!}

@if ($product->is_in_stock())
  @php do_action('woocommerce_before_add_to_cart_form') @endphp

  <form class="cart" action="{!! esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())) !!}" method="post" enctype='multipart/form-data'>
    @php do_action('woocommerce_before_add_to_cart_button') @endphp

    @php
      woocommerce_quantity_input([
        'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
        'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
        'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
      ]);
      do_action('woocommerce_after_add_to_cart_quantity');
    @endphp

    <button type="submit" name="add-to-cart" value="{{ $product->get_id() }}" class="single_add_to_cart_button button alt">
      {{ $product->single_add_to_cart_text() }}
    </button>

    @php do_action('woocommerce_after_add_to_cart_button') @endphp
  </form>

  @php do_action('woocommerce_after_add_to_cart_form') @endphp
@endif