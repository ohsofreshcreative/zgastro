{{--
  Checkout billing information form
  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/checkout/form-billing.blade.php.
--}}
@php defined('ABSPATH') || exit @endphp

<div class="woocommerce-billing-fields">
  @if (wc_ship_to_billing_address_only() && WC()->cart->needs_shipping())
    <h3>{{ esc_html_e('Billing &amp; Shipping', 'woocommerce') }}</h3>
  @else
    <h3>{{ esc_html_e('Billing details', 'woocommerce') }}</h3>
  @endif

  @php do_action('woocommerce_before_checkout_billing_form', $checkout) @endphp

  <div class="woocommerce-billing-fields__field-wrapper">
    @foreach ($checkout->get_checkout_fields('billing') as $key => $field)
      @php woocommerce_form_field($key, $field, $checkout->get_value($key)) @endphp
    @endforeach
  </div>

  @php do_action('woocommerce_after_checkout_billing_form', $checkout) @endphp
</div>

@if (!is_user_logged_in() && $checkout->is_registration_enabled())
  <div class="woocommerce-account-fields">
    @if (!$checkout->is_registration_required())
      <p class="form-row form-row-wide create-account">
        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
          <input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" @checked((true === $checkout->get_value('createaccount') || (true === apply_filters('woocommerce_create_account_default_checked', false)))) type="checkbox" name="createaccount" value="1" />
          <span>{{ esc_html_e('Create an account?', 'woocommerce') }}</span>
        </label>
      </p>
    @endif

    @if (!empty($checkout->get_checkout_fields('account')))
      <div class="create-account">
        @foreach ($checkout->get_checkout_fields('account') as $key => $field)
          @php woocommerce_form_field($key, $field, $checkout->get_value($key)) @endphp
        @endforeach
        <div class="clear"></div>
      </div>
    @endif
  </div>
@endif