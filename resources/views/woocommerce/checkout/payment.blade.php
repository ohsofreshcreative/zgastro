{{--
  Checkout Payment Section
  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/checkout/payment.blade.php.
--}}
@php
  defined('ABSPATH') || exit;
  if (!is_ajax()) {
    do_action('woocommerce_review_order_before_payment');
  }
@endphp
<div id="payment" class="woocommerce-checkout-payment">
  @if (WC()->cart->needs_payment())
    <ul class="wc_payment_methods payment_methods methods">
      @if (!empty($available_gateways))
        @foreach ($available_gateways as $gateway)
          @php wc_get_template('checkout/payment-method.blade.php', ['gateway' => $gateway]) @endphp
        @endforeach
      @else
        <li class="woocommerce-notice woocommerce-notice--info woocommerce-info">{{ apply_filters('woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__('Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce') : esc_html__('Please fill in your details above to see available payment methods.', 'woocommerce')) }}</li>
      @endif
    </ul>
  @endif
  <div class="form-row place-order">
    <noscript>
      {{ esc_html_e('Since your browser does not support JavaScript, or it is disabled, please ensure you click the', 'woocommerce') }}
      <em>{{ esc_html_e('Update Totals', 'woocommerce') }}</em>
      {{ esc_html_e('button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce') }}
      <br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="{{ esc_attr_e('Update totals', 'woocommerce') }}">{{ esc_html_e('Update totals', 'woocommerce') }}</button>
    </noscript>

    @php wc_get_template('checkout/terms.blade.php'); @endphp
    @php do_action('woocommerce_checkout_before_order_review'); @endphp
    {!! apply_filters('woocommerce_order_button_html', '<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr($order_button_text) . '" data-value="' . esc_attr($order_button_text) . '">' . esc_html($order_button_text) . '</button>') !!}
    @php do_action('woocommerce_checkout_after_order_review'); @endphp
    @php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); @endphp
  </div>
</div>
@php
  if (!is_ajax()) {
    do_action('woocommerce_review_order_after_payment');
  }
@endphp