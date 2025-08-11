{{--
  Checkout coupon form
  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/checkout/form-coupon.blade.php.
--}}
@php
  defined('ABSPATH') || exit;
  if (!wc_coupons_enabled()) {
    return;
  }
@endphp
<div class="woocommerce-form-coupon-toggle">
  @php wc_print_notice(apply_filters('woocommerce_checkout_coupon_message', __('Have a coupon?', 'woocommerce') . ' <a href="#" class="showcoupon">' . __('Click here to enter your code', 'woocommerce') . '</a>'), 'notice') @endphp
</div>

<form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">
  <p>{{ esc_html_e('If you have a coupon code, please apply it below.', 'woocommerce') }}</p>
  <p class="form-row form-row-first">
    <input type="text" name="coupon_code" class="input-text" placeholder="{{ esc_attr_e('Coupon code', 'woocommerce') }}" id="coupon_code" value="" />
  </p>
  <p class="form-row form-row-last">
    <button type="submit" class="button" name="apply_coupon" value="{{ esc_attr_e('Apply coupon', 'woocommerce') }}">{{ esc_html_e('Apply coupon', 'woocommerce') }}</button>
  </p>
  <div class="clear"></div>
</form>