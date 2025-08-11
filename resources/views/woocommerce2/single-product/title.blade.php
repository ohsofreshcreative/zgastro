{{--
  Single Product title

  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/single-product/title.blade.php.
--}}
@php
  if (!defined('ABSPATH')) {
    exit;
  }
@endphp
{!! the_title('<h1 class="product_title entry-title">', '</h1>', false) !!}