{{--
  Checkout login form
  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/checkout/form-login.blade.php.
--}}
@php
  defined('ABSPATH') || exit;
  if (is_user_logged_in() || 'no' === get_option('woocommerce_enable_checkout_login_reminder')) {
    return;
  }
@endphp
<div class="woocommerce-form-login-toggle">
  @php wc_print_notice(apply_filters('woocommerce_checkout_login_message', __('Returning customer?', 'woocommerce')) . ' <a href="#" class="showlogin">' . __('Click here to login', 'woocommerce') . '</a>', 'notice') @endphp
</div>

@php
  woocommerce_login_form(
    [
      'message'  => __('If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing section.', 'woocommerce'),
      'redirect' => wc_get_checkout_url(),
      'hidden'   => true,
    ]
  );
@endphp