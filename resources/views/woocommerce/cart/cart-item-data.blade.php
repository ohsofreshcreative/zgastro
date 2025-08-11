{{--
  Cart item data (e.g. variations).
  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/cart/cart-item-data.blade.php.
--}}
@php defined('ABSPATH') || exit @endphp

<dl class="variation">
  @foreach ($item_data as $data)
    <dt class="{{ sanitize_html_class('variation-' . $data['key']) }}">{{ wp_kses_post($data['key']) }}:</dt>
    <dd class="{{ sanitize_html_class('variation-' . $data['key']) }}">{!! wp_kses_post(wpautop($data['display'])) !!}</dd>
  @endforeach
</dl>