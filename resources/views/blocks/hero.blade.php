@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
@endphp

<!-- hero --->

<section data-gsap-anim="section" @if($id) id="{{ $id }}" @endif class="hero relative mx-6 {{ $sectionClass }} {{ $class }}">

	<div class="__wrapper grid grid-cols-1 sm:grid-cols-2 gap-6 items-center">

		<div data-gsap-element="content" class="flex flex-col justify-center h-full bg-shade b-radius px-10 md:px-30">
			<h1 data-gsap-element="header" class="m-title">
				{{ $hero['title'] }}
			</h1>
			<div data-gsap-element="txt" class="__content">
				{!! $hero['content'] !!}
			</div>

			@if (!empty($hero['cta']))
			<a data-gsap-element="button" class="main-btn m-btn" href="{{ $hero['cta']['url'] }}" target="{{ $hero['cta']['target'] }}">
				{{ $hero['cta']['title'] }}
			</a>
			@endif
		</div>

		@if (!empty($hero['image']))
		<div data-gsap-element="img" class="__img order1">
			<img class="img-radius img-xl" src="{{ $hero['image']['url'] }}" alt="{{ $hero['image']['alt'] ?? '' }}">
		</div>
		@endif
	</div>
	<a class="__arrow bg-yellow rounded-full absolute -bottom-[40px] inset-x-0 mx-auto transition-all duration-300">
		<svg class="" xmlns="http://www.w3.org/2000/svg" width="26" height="32" viewBox="0 0 26 32" fill="none">
			<path style="" d="M10.847 2.30616L10.847 24.4768L3.73684 17.2286C1.69456 15.1466 -1.36876 18.2696 0.673522 20.3516L11.4885 31.3595C12.3312 32.2135 13.6923 32.2135 14.5351 31.3595L25.3458 20.3516C25.768 19.9328 26.0048 19.3563 25.9999 18.7556C25.9997 16.773 23.6308 15.8 22.2822 17.2286L15.172 24.494L15.172 2.19217C15.0234 -0.861279 10.6979 -0.633291 10.847 2.30616Z" fill="#5F262F" />
		</svg>
	</a>
</section>