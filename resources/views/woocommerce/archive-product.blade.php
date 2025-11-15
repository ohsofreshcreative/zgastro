@extends('layouts.app')

@section('content')
  @php
    do_action('get_header', 'shop');
    do_action('woocommerce_before_main_content');
  @endphp

  <header data-gsap-anim="section" class="woocommerce-products-header">
    @if (apply_filters('woocommerce_show_page_title', true))
      <h1 data-gsap-element="header" class="woocommerce-products-header__title page-title mt-10 mb-6">{!! woocommerce_page_title(false) !!}</h1>
    @endif
  </header>

  <section data-gsap-anim="section">
    <div class="container mx-auto">
      @php
        // TO MIEJSCE JEST KLUCZOWE — bez tego toolbar nie ma gdzie się wstrzyknąć
        do_action('woocommerce_archive_description');
      @endphp

      @if (woocommerce_product_loop())
        @php
          do_action('woocommerce_before_shop_loop');
          
          // Dodajemy atrybuty do kontenera produktów dla naszego skryptu
          $load_more_attrs = $GLOBALS['wp_query']->max_num_pages > 1 
            ? 'data-load-more-container data-max-pages="' . $GLOBALS['wp_query']->max_num_pages . '" data-current-page="1"' 
            : '';
            
          woocommerce_product_loop_start(false);
          // Dodajemy klasy siatki Tailwind CSS
          echo '<ul class="products grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6 ' . esc_attr( wc_get_loop_prop( 'columns' ) ) . '" ' . $load_more_attrs . '>';
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
          echo '</ul>';
          woocommerce_product_loop_end();
          do_action('woocommerce_after_shop_loop');
        @endphp

        @if ($GLOBALS['wp_query']->max_num_pages > 1)
          <div class="flex justify-center mt-8">
            <button data-load-more-button class="btn btn-primary second-btn">
              <span data-load-more-text>Pokaż więcej</span>
              <span data-load-more-spinner class="hidden">Ładowanie...</span>
            </button>
          </div>
        @endif
      @else
        @php
          do_action('woocommerce_no_products_found');
        @endphp
      @endif
    </div>
  </section>

  <!--- DESCRIPTION --->
  @php
    $term = get_queried_object();
  @endphp

  @if ($term instanceof WP_Term && $term->taxonomy === 'product_cat')
    @php
      $term_id = $term->term_id;
      $acf_header = get_field('header', 'term_' . $term_id) ?: get_field('header', 'product_cat_' . $term_id);
      $term_desc = term_description($term_id, 'product_cat');
    @endphp

    @if (!empty($acf_header) || !empty($term_desc))
      <section class="shop-term-intro">
        @if (!empty($acf_header))
          <h4 class="shop-term-heading">{{ $acf_header }}</h4>
        @endif

        @if (!empty($term_desc))
          <div class="shop-term-description">{!! $term_desc !!}</div>
        @endif
      </section>
    @endif
  @endif
  <!--- DESCRIPTION END --->

  @php
    do_action('woocommerce_after_main_content');
    do_action('get_sidebar', 'shop');
    do_action('get_footer', 'shop');
  @endphp
@endsection