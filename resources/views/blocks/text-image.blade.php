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

<!--- text-image -->

<section data-gsap-anim="section" @if($id) id="{{ $id }}" @endif class="text-image relative -smt {{ $sectionClass }} {{ $class }}">

	<div class="__wrapper c-main relative">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-10">
			@if (!empty($textimg['image']))
			<div data-gsap-element="img" class="__img order1">
				<img class="object-cover w-full __img img-xl img-radius" src="{{ $textimg['image']['url'] }}" alt="{{ $textimg['image']['alt'] ?? '' }}">
			</div>
			@endif

			<div class="__content flex flex-col justify-center bg-shade-light b-radius order2 p-10 h-full">
				<h2 data-gsap-element="header" class="m-title">{{ $textimg['title'] }}</h2>

				<div data-gsap-element="txt" class="">
					{!! $textimg['content'] !!}
				</div>

				@if (!empty($textimg['button']))
				<a data-gsap-element="btn" class="main-btn m-btn" href="{{ $textimg['button']['url'] }}">{{ $textimg['button']['title'] }}</a>
				@endif

			</div>

		</div>

</section>