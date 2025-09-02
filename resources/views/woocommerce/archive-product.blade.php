
@extends('layouts.app')

@section('content')
  @php
    do_action('get_header', 'shop');
    do_action('woocommerce_before_main_content');
  @endphp

  <header class="woocommerce-products-header">
    @if (apply_filters('woocommerce_show_page_title', true))
      <h1 class="woocommerce-products-header__title page-title">{!! woocommerce_page_title(false) !!}</h1>
    @endif

  </header>
@php
  // TO MIEJSCE JEST KLUCZOWE — bez tego toolbar nie ma gdzie się wstrzyknąć
  do_action('woocommerce_archive_description');
@endphp
  @if (woocommerce_product_loop())
    @php
      do_action('woocommerce_before_shop_loop');
      woocommerce_product_loop_start();
    @endphp

    @if (wc_get_loop_prop('total'))
      @while (have_posts())
        @php
          the_post();
          do_action('woocommerce_shop_loop');
          wc_get_template_part('content', 'product');
        @endphp
      @endwhile
    @endif

    @php
      woocommerce_product_loop_end();
      do_action('woocommerce_after_shop_loop');
    @endphp
  @else
    @php
      do_action('woocommerce_no_products_found')
    @endphp
  @endif

<!--- DESCRIPTION --->
@php
  $term = get_queried_object();
@endphp

@if ($term instanceof WP_Term && $term->taxonomy === 'product_cat')
  @php
    $term_id = $term->term_id;


    $acf_header = get_field('header', 'term_' . $term_id);
    if (!$acf_header) {
      $acf_header = get_field('header', 'product_cat_' . $term_id);
    }

    $term_desc = term_description($term_id, 'product_cat');
  @endphp

  <section class="shop-term-intro">
    @if (!empty($acf_header))
      <h4 class="shop-term-heading">{{ $acf_header }}</h4>
    @endif

    @if (!empty($term_desc))
      <div class="shop-term-description">{!! $term_desc !!}</div>
    @endif
  </section>
  
@endif

<!--- DESCRIPTION END --->

  @php
    do_action('woocommerce_after_main_content');
    do_action('get_sidebar', 'shop');
    do_action('get_footer', 'shop');
  @endphp
@endsection