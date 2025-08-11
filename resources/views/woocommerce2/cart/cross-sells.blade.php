{{--
  Cross-sells
  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/cart/cross-sells.blade.php.
--}}
@php defined('ABSPATH') || exit @endphp

@if ($cross_sells)
  <div class="cross-sells">
    <h2>{{ esc_html_e('You may be interested in&hellip;', 'woocommerce') }}</h2>

    {!! woocommerce_product_loop_start() !!}
      @foreach ($cross_sells as $cross_sell)
        @php
          $post_object = get_post($cross_sell->get_id());
          setup_postdata($GLOBALS['post'] =& $post_object);
          wc_get_template_part('content', 'product');
        @endphp
      @endforeach
    {!! woocommerce_product_loop_end() !!}
  </div>
@endif

@php wp_reset_postdata() @endphp