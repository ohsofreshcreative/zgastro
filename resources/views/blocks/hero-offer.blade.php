@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
@endphp

@php
$backgroundImage = !empty($g_herooffer['image']['url']) ? "linear-gradient(270deg, rgba(0, 0, 0, 0.25) 0%, rgba(0, 0, 0, 0.90) 100%), url({$g_herooffer['image']['url']})" : '';
@endphp

<!-- hero-offer -->

<section data-gsap-anim="section" class="hero-offer relative overflow-hidden {{ $sectionClass }}" style="background-image: {{ $backgroundImage }}; background-size: cover; background-position: center;">

	<div class="__wrapper c-main {{ !empty($g_herooffer['image']) ? 'py-50' : '' }}">

		<div class="w-full sm:w-2/3">
			<h1 data-gsap-element="header" class="text-white">{{ $g_herooffer['title'] }}</h1>
			<div data-gsap-element="content" class="text-white mt-2 __content">
				{!! $g_herooffer['content'] !!}
			</div>

			@if (!empty($g_herooffer['cta']))
			<div class="inline-buttons m-btn">
				<a data-gsap-element="button" class="main-btn left-btn" href="{{ $g_herooffer['cta']['url'] }}" target="{{ $g_herooffer['cta']['target'] }}">{{ $g_herooffer['cta']['title'] }}</a>

				@if (!empty($g_herooffer['cta2']))
				<a data-gsap-element="button" class="stroke-btn" href="{{ $g_herooffer['cta2']['url'] }}" target="{{ $g_herooffer['cta2']['target'] }}">{{ $g_herooffer['cta2']['title'] }}</a>
				@endif
			</div>
			@endif
		</div>

		@if(get_field('gfx_top'))
		<div class="absolute top-0 left-0 -ml-1 pointer-events-none">
			<svg class="animated-svg" xmlns="http://www.w3.org/2000/svg" width="271" height="265" viewBox="0 0 271 265">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M0.485036 0.184698H270.5L62.2153 62.5939L0.485036 265V0.184698Z" fill="#E30613" />
			</svg>
		</div>
		@endif

		@if(get_field('gfx_bottom'))
		<div class="absolute -bottom-40 md:bottom-0 -right-28 md:right-0 pointer-events-none">
			<svg class="animated-svg" xmlns="http://www.w3.org/2000/svg" width="1026" height="802" viewBox="0 0 1026 802" fill="none">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M1026.1 801.61H0.499762L860.349 543.971L1026.1 0.500002L1026.1 801.61Z" fill="#E30613" />
			</svg>
		</div>
		@endif
</section>