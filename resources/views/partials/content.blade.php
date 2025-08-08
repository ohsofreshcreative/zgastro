<article @php(post_class())>
	<header>
		@if(has_post_thumbnail())
		<a class="" href="{{ get_permalink() }}">
			{!! get_the_post_thumbnail(null, 'large', ['class' => 'featured-image img-xs']) !!}
		</a>
		@endif

		<h6 class="entry-title text-h5 mt-6">
			<a href="{{ get_permalink() }}">
				 {!! get_the_title() !!}
			</a>
		</h6>

		<!--  @include('partials.entry-meta') -->
	</header>

	<a class="underline-btn m-btn" href="{{ get_permalink() }}">
		Przeczytaj
	</a>

	<!--   <div class="entry-summary">
    @php(the_excerpt())
  </div> -->
</article>