@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
@endphp

@php
$backgroundImage = !empty($hero['image']['url']) ? "linear-gradient(270deg, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0.90) 100%), url({$hero['image']['url']})" : '';
@endphp

<!-- hero --->

<section data-gsap-anim="section" class="hero relative {{ $sectionClass }}" style="background-image: {{ $backgroundImage }}; background-size: cover; background-position: center;">

	<div class="__wrapper c-main relative z-1 {{ !empty($hero['image']) ? 'py-50' : '' }}">

		<h2 data-gsap-element="header" class="text-white w-full sm:w-2/3">{{ $hero['title'] }}</h2>

		<div data-gsap-element="content" class="text-white mt-2 __content">
			{!! $hero['content'] !!}
		</div>

		@if (!empty($hero['cta']))
		<a data-gsap-element="button" class="main-btn m-btn" href="{{ $hero['cta']['url'] }}" target="{{ $hero['cta']['target'] }}">{{ $hero['cta']['title'] }}</a>
		@endif

	</div>

	@if(get_field('gfx_top'))
	<div class="absolute top-0 left-0 -ml-1">
		<svg class="animated-svg" xmlns="http://www.w3.org/2000/svg" width="271" height="265" viewBox="0 0 271 265">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M0.485036 0.184698H270.5L62.2153 62.5939L0.485036 265V0.184698Z" fill="#E30613" />
		</svg>
	</div>
	@endif

	@if(get_field('gfx_bottom'))
	<div class="absolute -bottom-16 md:bottom-0 -right-28 md:right-0">
		<svg class="animated-svg" xmlns="http://www.w3.org/2000/svg" width="1026" height="802" viewBox="0 0 1026 802" fill="none">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M1026.1 801.61H0.499762L860.349 543.971L1026.1 0.500002L1026.1 801.61Z" fill="#E30613" />
		</svg>
	</div>
	@endif
</section> 