@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
@endphp

<!--- hero-second -->

<section data-gsap-anim="section" class="hero-cases relative {{ $sectionClass }}">

	<div class="__wrapper c-main relative z-2">
		<img data-gsap-element="image" class="object-contain __img pt-14" src="{{ $g_herocases['image']['url'] }}" alt="{{ $g_herocases['image']['alt'] ?? '' }}">
		<h1 data-gsap-element="header" class="m-title w-3/4 md:w-full pt-24">{{ $g_herocases['title'] }}</h1>

		@if (has_post_thumbnail())
		<img data-gsap-element="image" class="mt-20" src="{{ get_the_post_thumbnail_url(null, 'full') }}" alt="{{ get_the_title() }}">
		@endif

	</div>

	<svg data-gsap-element="shape" class="__shape absolute -top-56 right-0 z-1" xmlns="http://www.w3.org/2000/svg" width="562" height="1048" viewBox="0 0 562 1048" fill="none">
		<path fill-rule="evenodd" clip-rule="evenodd" d="M562 0L-6.30224e-06 525.028L562 1048L267.518 527.084L562 0Z" fill="#E30613" />
	</svg>
</section>