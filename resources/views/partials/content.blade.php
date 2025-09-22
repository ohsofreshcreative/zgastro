<article data-gsap-element="card" @php(post_class('bg-white b-radius b-shadow'))>
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