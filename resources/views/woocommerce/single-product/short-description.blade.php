{{--
  Single product short description

  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/single-product/short-description.blade.php.
--}}
@php
  if (!defined('ABSPATH')) {
    exit;
  }
  global $post;
  $short_description = apply_filters('woocommerce_short_description', $post->post_excerpt);

  if (!$short_description) {
    return;
  }
@endphp
<div class="woocommerce-product-details__short-description">
  {!! $short_description !!}
</div>