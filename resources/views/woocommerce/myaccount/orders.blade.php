{{--
  Orders

  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/myaccount/orders.blade.php.
--}}
@php defined('ABSPATH') || exit @endphp

@php do_action('woocommerce_before_account_orders', $has_orders) @endphp

@if ($has_orders)
  <table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
    <thead>
      <tr>
        @foreach (wc_get_account_orders_columns() as $column_id => $column_name)
          <th class="woocommerce-orders-table__header woocommerce-orders-table__header-{{ esc_attr($column_id) }}"><span class="nobr">{{ esc_html($column_name) }}</span></th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @foreach ($customer_orders->orders as $customer_order)
        @php $order = wc_get_order($customer_order) @endphp
        <tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-{{ esc_attr($order->get_status()) }} order">
          @foreach (wc_get_account_orders_columns() as $column_id => $column_name)
            <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-{{ esc_attr($column_id) }}" data-title="{{ esc_attr($column_name) }}">
              @if (has_action('woocommerce_my_account_my_orders_column_' . $column_id))
                @php do_action('woocommerce_my_account_my_orders_column_' . $column_id, $order) @endphp
              @elseif ('order-number' === $column_id)
                <a href="{{ esc_url($order->get_view_order_url()) }}">
                  {{ esc_html(_x('#', 'hash before order number', 'woocommerce') . $order->get_order_number()) }}
                </a>
              @elseif ('order-date' === $column_id)
                <time datetime="{{ esc_attr($order->get_date_created()->date('c')) }}">{{ esc_html(wc_format_datetime($order->get_date_created())) }}</time>
              @elseif ('order-status' === $column_id)
                {{ esc_html(wc_get_order_status_name($order->get_status())) }}
              @elseif ('order-total' === $column_id)
                {!! wp_kses_post(sprintf(_n('%1$s for %2$s item', '%1$s for %2$s items', $order->get_item_count(), 'woocommerce'), $order->get_formatted_order_total(), $order->get_item_count())) !!}
              @elseif ('order-actions' === $column_id)
                @php
                  $actions = wc_get_account_orders_actions($order);
                  if (!empty($actions)) {
                    foreach ($actions as $key => $action) {
                      echo '<a href="' . esc_url($action['url']) . '" class="woocommerce-button button ' . sanitize_html_class($key) . '">' . esc_html($action['name']) . '</a>';
                    }
                  }
                @endphp
              @endif
            </td>
          @endforeach
        </tr>
      @endforeach
    </tbody>
  </table>

  @php do_action('woocommerce_before_account_orders_pagination') @endphp

  @if (1 < $customer_orders->max_num_pages)
    <div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
      @if (1 !== $current_page)
        <a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="{{ esc_url(wc_get_endpoint_url('orders', $current_page - 1)) }}">{{ esc_html_e('Previous', 'woocommerce') }}</a>
      @endif

      @if (intval($customer_orders->max_num_pages) !== $current_page)
        <a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="{{ esc_url(wc_get_endpoint_url('orders', $current_page + 1)) }}">{{ esc_html_e('Next', 'woocommerce') }}</a>
      @endif
    </div>
  @endif
@else
  <div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
    <a class="woocommerce-Button button" href="{{ esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))) }}">{{ esc_html_e('Browse products', 'woocommerce') }}</a>
    {{ esc_html_e('No order has been made yet.', 'woocommerce') }}
  </div>
@endif

@php do_action('woocommerce_after_account_orders', $has_orders) @endphp