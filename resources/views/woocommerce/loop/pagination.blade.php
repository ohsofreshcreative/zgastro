{{--
  Pagination - Show numbered pagination for catalog pages.

  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/loop/pagination.blade.php.
--}}
@php
  if (!defined('ABSPATH')) {
    exit;
  }
  $total   = isset($total) ? $total : wc_get_loop_prop('total_pages');
  $current = isset($current) ? $current : wc_get_loop_prop('current_page');
  $base    = isset($base) ? $base : esc_url_raw(str_replace(999999999, '%#%', remove_query_arg('add-to-cart', get_pagenum_link(999999999, false))));
  $format  = isset($format) ? $format : '';

  if ($total <= 1) {
    return;
  }
@endphp
<nav class="woocommerce-pagination">
  {!! paginate_links(apply_filters('woocommerce_pagination_args', [
    'base'      => $base,
    'format'    => $format,
    'add_args'  => false,
    'current'   => max(1, $current),
    'total'     => $total,
    'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
    'next_text' => is_rtl() ? '&larr;' : '&rarr;',
    'type'      => 'list',
    'end_size'  => 3,
    'mid_size'  => 3,
  ])) !!}
</nav>