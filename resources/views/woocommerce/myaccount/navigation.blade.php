{{--
  My Account navigation

  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/myaccount/navigation.blade.php.
--}}
@php
  defined('ABSPATH') || exit;
  do_action('woocommerce_before_account_navigation');
@endphp

<nav class="woocommerce-MyAccount-navigation">
  <ul>
    @foreach (wc_get_account_menu_items() as $endpoint => $label)
      <li class="{{ wc_get_account_menu_item_classes($endpoint) }}">
        <a href="{!! esc_url(wc_get_account_endpoint_url($endpoint)) !!}">{{ esc_html($label) }}</a>
      </li>
    @endforeach
  </ul>
</nav>

@php do_action('woocommerce_after_account_navigation') @endphp