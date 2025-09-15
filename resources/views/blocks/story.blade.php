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

<!--- story -->

<section data-gsap-anim="section" @if($id) id="{{ $id }}" @endif class="story relative -smt {{ $sectionClass }} {{ $class }}">

	<div class="__wrapper c-main relative">
		<div class="__col grid grid-cols-1 lg:grid-cols-[1fr_2fr] gap-10">
			@if (!empty($g_story['image']))
			<div data-gsap-element="img" class="__img order1 w-full lg:w-3/4 ml-auto">
				<img class="object-cover w-full __img img-xl img-radius" src="{{ $g_story['image']['url'] }}" alt="{{ $g_story['image']['alt'] ?? '' }}">
			</div>
			@endif

			<div class="__content w-full lg:w-90">
				<h2 data-gsap-element="header" class="m-title">{{ $g_story['title'] }}</h2>

				<div data-gsap-element="txt" class="">
					{!! $g_story['content'] !!}
				</div>

				@if (!empty($g_story['button']))
				<a data-gsap-element="btn" class="main-btn m-btn" href="{{ $g_story['button']['url'] }}">{{ $g_story['button']['title'] }}</a>
				@endif

				<img class="absolute -top-20 -left-10" src="/wp-content/uploads/2025/09/about-bg.svg" />
			</div>

		</div>

</section>