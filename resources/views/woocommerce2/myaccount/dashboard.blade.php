{{--
  My Account Dashboard

  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/myaccount/dashboard.blade.php.
--}}
@php
  defined('ABSPATH') || exit;
  $allowed_html = [
    'a' => [
      'href' => [],
    ],
  ];
@endphp
<p>
  {!!
    sprintf(
      esc_html__('Hello %1$s (not %1$s? %2$sLog out%3$s)', 'woocommerce'),
      '<strong>' . esc_html($current_user->display_name) . '</strong>',
      '<a href="' . esc_url(wc_logout_url()) . '">',
      '</a>'
    )
  !!}
</p>

<p>
  {!!
    sprintf(
      wp_kses(__('From your account dashboard you can view your %1$srecent orders%2$s, manage your %3$sshipping and billing addresses%4$s, and %5$sedit your password and account details%6$s.', 'woocommerce'), $allowed_html),
      '<a href="' . esc_url(wc_get_endpoint_url('orders')) . '">',
      '</a>',
      '<a href="' . esc_url(wc_get_endpoint_url('edit-address')) . '">',
      '</a>',
      '<a href="' . esc_url(wc_get_endpoint_url('edit-account')) . '">',
      '</a>'
    )
  !!}
</p>

@php do_action('woocommerce_account_dashboard', $current_user) @endphp