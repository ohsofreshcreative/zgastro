@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
@endphp

@php
$backgroundImage = !empty($g_herosecond['image']['url']) ? "linear-gradient(180deg, rgba(250, 250, 250, 0.00) 0%, #FAFAFA 100%), url({$g_herosecond['image']['url']})" : '';
@endphp

<!--- hero-second -->

<section data-gsap-anim="section" class="hero-second relative {{ $sectionClass }}" style="background-image: {{ $backgroundImage }}; background-size: cover; background-position: center;">

	<div class="__wrapper c-main relative z-2 grid grid-cols-1 md:grid-cols-2 gap-8 {{ !empty($g_herosecond['image']) ? 'pt-80 pb-10' : '' }}">
		<div class="">
			<h2 data-gsap-element="header" class="m-title">{{ $g_herosecond['title'] }}</h2>

			<div data-gsap-element="content" class="">
				{!! $g_herosecond['content'] !!}
			</div>

			@if (!empty($g_herosecond['cta']))
			<a data-gsap-element="button" class="main-btn m-btn" href="{{ $g_herosecond['cta']['url'] }}" target="{{ $g_herosecond['cta']['target'] }}">{{ $g_herosecond['cta']['title'] }}</a>
			@endif

		</div>

		<a href="#more" class="self-end justify-self-end"><img class="" src="/wp-content/uploads/2025/06/bottom.svg" /></a>

	</div>

	<svg class="__shape absolute -top-56 right-0 z-1" xmlns="http://www.w3.org/2000/svg" width="562" height="1048" viewBox="0 0 562 1048" fill="none">
		<path fill-rule="evenodd" clip-rule="evenodd" d="M562 0L-6.30224e-06 525.028L562 1048L267.518 527.084L562 0Z" fill="#E30613" />
	</svg>

	@if(get_field('gfx_top'))
	<div class="absolute top-0 left-0 -ml-1">
		<svg class="animated-svg" xmlns="http://www.w3.org/2000/svg" width="271" height="265" viewBox="0 0 271 265">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M0.485036 0.184698H270.5L62.2153 62.5939L0.485036 265V0.184698Z" fill="#E30613" />
		</svg>
	</div>
	@endif

	@if(get_field('gfx_bottom'))
	<div class="absolute bottom-0 right-0">
		<svg class="animated-svg" xmlns="http://www.w3.org/2000/svg" width="1026" height="802" viewBox="0 0 1026 802" fill="none">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M1026.1 801.61H0.499762L860.349 543.971L1026.1 0.500002L1026.1 801.61Z" fill="#E30613" />
		</svg>
	</div>
	@endif
</section>