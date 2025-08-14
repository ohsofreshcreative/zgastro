@php
defined('ABSPATH') || exit;
@endphp

@php global $product; @endphp

<li {!! wc_product_class('', $product) !!}>
  <figure class="woocommerce-product-figure relative">
    @if($product && $product->is_on_sale())
      <span class="onsale">Promocja!</span>
    @endif

    <a href="{{ get_permalink() }}">
      <img src="{{ get_the_post_thumbnail_url($product->get_id(), 'large') }}"
           alt="{{ get_the_title() }}" class="img-m" />
    </a>
  </figure>

  @php
    $categories = wc_get_product_terms($product->get_id(), 'product_cat', [
      'orderby' => 'parent',
      'order'   => 'ASC',
    ]);

    $parent_cat = collect($categories)
      ->filter(fn($cat) => $cat->parent === 0 && $cat->slug !== 'wszystkie-produkty')
      ->first();
  @endphp

  @if($parent_cat)
    <div class="product-category">
      <a href="{{ get_term_link($parent_cat) }}">{{ $parent_cat->name }}</a>
    </div>
  @endif

  <h5 class="woocommerce-loop-product__title">
    <a href="{{ get_permalink() }}">{!! get_the_title() !!}</a>
  </h5>

  @php do_action('woocommerce_after_shop_loop_item_title') @endphp
</li>

