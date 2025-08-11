{{--
  Cart Errors
  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/checkout/cart-errors.blade.php.
--}}
@php
  defined('ABSPATH') || exit;
  if (empty($errors)) {
    return;
  }
@endphp

@php wc_print_notice(implode('<br>', $errors), 'error') @endphp