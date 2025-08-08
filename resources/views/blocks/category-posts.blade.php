<div class="block-category-posts -smt {{ $flip ? 'flip' : '' }} layout-{{ $layout }}">
	<div class="c-main">
		<div class="flex justify-between items-center mb-10">
			<h2 class="block-title">{{ $posts_settings['title'] }}</h2>

			@if($category_id)
			<div class="view-all-container text-center">
				<a class="main-btn" href="{{ get_category_link($category_id) }}" class="btn btn-primary view-all-posts">
					Zobacz wszystkie wpisy
				</a>
			</div>
			@endif
		</div>

		@if(!empty($posts))
		<div class="posts-container grid grid-cols-1 md:grid-cols-3 gap-8">
			@foreach($posts as $post)
			<div class="post-item">
				@if($show_image && has_post_thumbnail($post->ID))
				<div class="post-image img-xs m-img">
					<a href="{{ get_permalink($post->ID) }}">
						{!! get_the_post_thumbnail($post->ID, 'medium') !!}
					</a>
				</div>
				@endif

				<div class="post-content">
					<h5 class="post-title">
						<a href="{{ get_permalink($post->ID) }}">
							{{ get_the_title($post->ID) }}
						</a>
					</h5>

					@if($show_excerpt)
					<div class="post-excerpt">
						{{ get_the_excerpt($post->ID) }}
					</div>
					@endif

					<a href="{{ get_permalink($post->ID) }}" class="underline-btn block primary m-btn">Przeczytaj</a>
				</div>
			</div>
			@endforeach
		</div>
		@else
		<div class="no-posts">
			Brak postów w wybranej kategorii.
		</div>
		@endif
	</div>
</div>