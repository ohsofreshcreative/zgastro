{{--
  The template for displaying product content within loops

  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/content-product.blade.php.
--}}

@php
  global $product;

  // Ensure visibility.
  if (empty($product) || !$product->is_visible()) {
      return;
  }
@endphp

<li {!! wc_product_class('', $product) !!}>
  @php
    do_action('woocommerce_before_shop_loop_item');
    do_action('woocommerce_before_shop_loop_item_title');
  @endphp

  <a href="{{ $product->get_permalink() }}">
    {!! $product->get_image() !!}
    <h2 class="woocommerce-loop-product__title">{{ $product->get_name() }}</h2>
  </a>

  @php
    do_action('woocommerce_after_shop_loop_item_title');
  @endphp

  <span class="price">{!! $product->get_price_html() !!}</span>

  @php
    do_action('woocommerce_after_shop_loop_item');
  @endphp
</li>