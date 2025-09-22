@php
$categories = get_the_category();
@endphp

<section data-gsap-anim="section" class="blog__top">
	<div class="__wrapper c-main pt-40">
		<div class="__content text-center w-full md:w-2/3 m-auto">

			@if (!empty($categories))
			<a data-gsap-element="btn" href="{{ get_category_link($categories[0]->term_id) }}" class="__category text-yellow b-radius y-border px-10 py-3">
				{{ $categories[0]->name }}
			</a>
			@endif

			<h1 class="m-title mt-8">{{ get_the_title() }}</h1>

		</div>

		@if (has_post_thumbnail())
		<img data-gsap-element="img" class="__thumbnail b-radius mt-20" src="{{ get_the_post_thumbnail_url(null, 'full') }}" alt="{{ get_the_title() }}">
		@endif
	</div>
</section>

<section data-gsap-anim="section" id="tresc" class="__entry mt-20">
	<div data-gsap-element="txt" class="c-main">
		<div class="w-full md:w-2/3 m-auto">
			{!! the_content() !!}
		</div>
	</div>
</section>


@php
$current_id = get_the_ID();
$categories = wp_get_post_categories($current_id);
$related_args = [
'category__in' => $categories,
'post__not_in' => [$current_id],
'posts_per_page' => 3,
'ignore_sticky_posts' => 1,
];
$related_query = new WP_Query($related_args);
@endphp

@if($related_query->have_posts())
<section data-gsap-anim="section" class="related-posts bg-shade-light -smt pt-20 pb-56 -mb-56">
	<div class="c-main">
		<h3 data-gsap-element="header" class="text-2xl font-bold mb-6">Wpisy z tej kategorii</h3>
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
			@while($related_query->have_posts())
			@php($related_query->the_post())
			<div data-gsap-element="card">
				<article @php(post_class('bg-white b-radius b-shadow'))>
					<a class="card-anchor" href="{{ get_permalink() }}">
						<div>
							@if(has_post_thumbnail())
							<div class="hover-zoom-tilt">
								{!! get_the_post_thumbnail(null, 'large', [
								'class' => 'featured-image img-xs hover-zoom-tilt__img',
								'loading' => 'lazy'
								]) !!}
							</div>
							@endif
							<div class="p-6">
								<h6 class="entry-title text-h5 text-third line-clamp-2">
									{!! get_the_title() !!}
								</h6>
								<p class="underline-btn m-btn">
									Przeczytaj
								</p>
							</div>
						</div>
					</a>
				</article>
			</div>
			@endwhile
			@php(wp_reset_postdata())
		</div>
	</div>
</section>
@endif