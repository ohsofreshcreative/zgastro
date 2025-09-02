<div class="block-category-posts -smt {{ $flip ? 'flip' : '' }} layout-{{ $layout }}">
	<div class="c-main">
		<div class="w-full lg:w-1/2 m-auto">
			<h2 class="text-center">{{ $posts_settings['title'] }}</h2>
			<p class="text-center text-lg">{{ $posts_settings['txt'] }}</pack>
				<!-- @if($category_id)
			<div class="view-all-container text-center">
				<a class="main-btn" href="{{ get_category_link($category_id) }}" class="btn btn-primary view-all-posts">
					Zobacz wszystkie wpisy
				</a>
			</div>
			@endif -->
		</div>

		@if(!empty($posts))
		<div class="posts-container grid grid-cols-1 md:grid-cols-3 gap-8 mt-10">
			@foreach($posts as $post)
			<div class="post-item bg-white b-radius">
				@if($show_image && has_post_thumbnail($post->ID))
				<div class="post-image img-xs">
					<a class="" href="{{ get_permalink($post->ID) }}">
						{!! get_the_post_thumbnail($post->ID, 'largeB', ['class' => 'rounded-t-2xl']) !!}
					</a>
				</div>
				@endif

				<div class="post-content p-6 pb-8">
					<h5 class="post-title text-body">
						<a class="line-clamp-2" href="{{ get_permalink($post->ID) }}">
							{{ get_the_title($post->ID) }}
						</a>
					</h5>

					<a href="{{ get_permalink($post->ID) }}" class="underline-btn block primary pt-4">Przeczytaj</a>
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