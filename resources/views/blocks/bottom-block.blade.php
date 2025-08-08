@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $graybg ? ' section-gray' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $brandbg ? ' section-brand' : '';
@endphp

@php
$backgroundImage = !empty($bottom['image']['url']) ? "linear-gradient(90deg, #BD0510 50%, rgba(189, 5, 16, 0.10) 80.29%), url({$bottom['image']['url']})" : '';
@endphp

<!-- bottom-block -->

<section data-gsap-anim="section"  class="cta-bottom relative overflow-hidden grid grid-cols-1 lg:grid-cols-2 -smt bg-dark {{ $sectionClass }}" style="background-image: {{ $backgroundImage }}; background-size: cover; background-position: right;">
	<div class="py-20 mx-8 lg:m-auto">
		<h5 data-gsap-element="header" class="text-white">{{ $bottom['subtitle'] }}</h5>
		<h2 data-gsap-element="header" class="text-white __before mt-4">{{ $bottom['title'] }}</h2>

		<div class="flex flex-col mt-10 gap-4">
			<a data-gsap-element="phone" class="__phone flex items-center text-2xl text-white" href="tel:{{ $bottom['phone'] }}">{{ $bottom['phone'] }}</a>
			<a data-gsap-element="mail" class="__mail flex items-center text-2xl text-white" href="mailto:{{ $bottom['mail'] }}">{{ $bottom['mail'] }}</a>
		</div>

	</div>

	<div class="absolute -bottom-16 -right-16 lg:bottom-0 lg:right-0 -ml-1">
		<svg class="white-svg" xmlns="http://www.w3.org/2000/svg" width="552" height="531" viewBox="0 0 552 531" fill="none">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M552.224 531.056H0.499923L436.627 410.442L552.224 0.49987L552.224 531.056Z" fill="white" />
		</svg>
	</div>

</section>