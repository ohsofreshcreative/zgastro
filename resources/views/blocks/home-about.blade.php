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

<section data-gsap-anim="section" @if($id) id="{{ $id }}" @endif class="home-about  -smt {{ $sectionClass }} {{ $class }}">
	<div class="__wrapper c-main">
		<div class="__top">
			<p data-gsap-element="top" class="text-xl text-gray">{{ strip_tags($about1['subtitle']) }}</p>
			<h2 data-gsap-element="title" class="big">{{ strip_tags($about1['title']) }}</h2>
		</div>
		<div class="grid grid-cols-1 md:grid-cols-[1fr_2fr] justify-center items-center gap-10 mt-10">
			<img data-gsap-element="img" class="" src="{{ $about1['image']['url'] }}" alt="{{ $about1['image']['alt'] ?? '' }}">
			<div class="">
				<h5 data-gsap-element="content" class="">{{ strip_tags($about1['top']) }}</h5>
				<div class="ml-0 md:ml-15">
					<p data-gsap-element="content" class="mt-5">{{ strip_tags($about1['content']) }}</p>
					<a data-gsap-element="button" data-gsap-element="button" class="arrow-btn m-btn" href="{{ $about1['cta']['url'] }}" target="{{ $about1['cta']['target'] }}">
						{{ $about1['cta']['title'] }}
					</a>
				</div>
			</div>
		</div>
	</div>
</section>