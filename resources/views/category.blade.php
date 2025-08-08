@extends('layouts.app')

@section('content')
@php
$term = get_queried_object();
$title = $term ? get_field('title', 'category_' . $term->term_id) : null;
$txt = $term ? get_field('txt', 'category_' . $term->term_id) : null;
$image = $term ? get_field('image', 'category_' . $term->term_id) : null;
$hero = [
    'title' => $title ?: ($term->name ?? ''),
    'txt' => $txt ?: ($term->name ?? ''), // Use same logic as title
    'image' => $image['url'] ?? '',
];


	// Fetch all categories
	$categories = get_categories();

	// Get the current category URL
	$current_category_url = $term ? get_category_link($term->term_id) : home_url(); // Fallback to home URL if not a category archive


@endphp

<section data-gsap-anim="section" class="{{ $sectionClass }}">
	<div class="__wrapper c-main pt-40">

		<div class="grid grid-cols-1 md:grid-cols-2 gap-10 b-border-b pb-16 mb-18">
			<h2 data-gsap-element="header" class="__before">{{ $hero['title'] }}</h2>
			@if(!empty($hero['txt']))
			<div data-gsap-element="content" class="mt-2 __content">
				{!! $hero['txt'] !!}
			</div>
			@endif
		</div>
	</div>
</section>

<div class="c-main flex gap-4">
    <a class="stroke-btn" href="/category/wszystkie-wpisy/">Wszystkie wpisy</a>
    @foreach($categories as $category)
		@if($category->name !== 'Wszystkie wpisy')
        	<a class="stroke-btn" href="{{ get_category_link($category->term_id) }}" class="button {{ $term && $term->term_id === $category->term_id ? 'active' : '' }}">{{ $category->name }}</a>
		@endif
    @endforeach
</div>

@if (have_posts())
<div class="c-main pb-25 !mt-10 posts grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
	@while (have_posts()) @php(the_post())
	@includeFirst(['partials.content', 'partials.content'])
	@endwhile
</div>
{!! get_the_posts_navigation() !!}
@else
<p>Brak wpisów w tej kategorii.</p>
@endif
@endsection