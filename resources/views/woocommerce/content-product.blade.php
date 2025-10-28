@php
defined('ABSPATH') || exit;
@endphp

@php global $product; @endphp

<li class="bg-white b-radius relative !p-10">

		@if($product && $product->is_on_sale())
		<span class="onsale">Promocja!</span>
		@endif
	<figure class="woocommerce-product-figure relative">
		<a href="{{ get_permalink() }}">
			<img src="{{ get_the_post_thumbnail_url($product->get_id(), '') }}"
				alt="{{ get_the_title() }}" class="img-xs max-h-52 !object-contain" />
		</a>
	</figure>

	<div class="flex flex-col">
		<h5 class="woocommerce-loop-product__title !min-h-16">
			<a class="block" href="{{ get_permalink() }}">{!! get_the_title() !!}</a>
		</h5>
		@php do_action('woocommerce_after_shop_loop_item_title') @endphp
		<div class="mt-6">
			@php do_action('woocommerce_after_shop_loop_item') @endphp
		</div>
	</div>
</li>