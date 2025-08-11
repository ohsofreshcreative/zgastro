{{--
  Product Loop Start

  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/loop/loop-start.blade.php.
--}}
@php
  if (!defined('ABSPATH')) {
    exit;
  }
@endphp
<ul class="products columns-{{ esc_attr(wc_get_loop_prop('columns')) }}">