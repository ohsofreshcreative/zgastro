@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
@endphp

<!-- hero --->

<section data-gsap-anim="section" @if($id) id="{{ $id }}" @endif class="hero relative overflow-hidden {{ $sectionClass }} {{ $class }}">

	<div class="__wrapper c-main z-1">

		<div class="w-1/3">
			<h1 data-gsap-element="header" class="w-full sm:w-2/3">
				{{ $hero['title'] }}
			</h1>
			<h3 data-gsap-element="content" class="__content">
				{!! $hero['content'] !!}
			</h3>
		</div>

		@if (!empty($hero['cta']))
		<a data-gsap-element="button" class="arrow-btn m-btn" href="{{ $hero['cta']['url'] }}" target="{{ $hero['cta']['target'] }}">
			{{ $hero['cta']['title'] }}
		</a>
		@endif

		@if (!empty($hero['image']))
		<div data-gsap-element="img" class="__img order1">
			<img class="" src="{{ $hero['image']['url'] }}" alt="{{ $hero['image']['alt'] ?? '' }}">
		</div>
		@endif
	</div>

	<img class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" src="/wp-content/uploads/2025/08/stroke.svg" />
</section>