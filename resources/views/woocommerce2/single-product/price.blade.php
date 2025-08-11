{{--
  Single Product Price

  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/single-product/price.blade.php.
--}}
@php
  if (!defined('ABSPATH')) {
    exit;
  }
  global $product;
@endphp
<p class="price">{!! $product->get_price_html() !!}</p>