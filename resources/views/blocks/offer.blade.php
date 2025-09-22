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

<!--- offer -->

<section data-gsap-anim="section" @if($id) id="{{ $id }}" @endif class="offer relative -smt {{ $sectionClass }} {{ $class }}">

	<div class="__wrapper c-main">
		<h1  data-gsap-element="header" class="text-center">{{ $header }}</h1>
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 section-gap mt-10">
			<!--- Kafelek #1 --->
			<div data-gsap-element="card" class="__card bg-white b-radius px-8 py-12">
				@if (!empty($g_first['image']))
				<div class="__img order1">
					<img class="img-xs !object-contain" src="{{ $g_first['image']['url'] }}" alt="{{ $g_first['image']['alt'] ?? '' }}">
				</div>
				@endif
				<div class="__content text-center mt-6">
					<h4 class="">{{ $g_first['title'] }}</h4>
					<div class="">
						{!! $g_first['content'] !!}
					</div>
					@if (!empty($g_first['button']))
					<a class="main-btn mt-6" href="{{ $g_first['button']['url'] }}">{{ $g_first['button']['title'] }}</a>
					@endif
				</div>
			</div>
			<!--- Kafelek #2 --->
			<div data-gsap-element="card" class="__card bg-white b-radius px-8 py-12">
				@if (!empty($g_second['image']))
				<div class="__img order1">
					<img class="img-xs !object-contain" src="{{ $g_second['image']['url'] }}" alt="{{ $g_second['image']['alt'] ?? '' }}">
				</div>
				@endif
				<div class="__content text-center mt-6">
					<h4 class="">{{ $g_second['title'] }}</h4>
					<div class="">
						{!! $g_second['content'] !!}
					</div>
					@if (!empty($g_second['button']))
					<a class="main-btn mt-6" href="{{ $g_second['button']['url'] }}">{{ $g_second['button']['title'] }}</a>
					@endif
				</div>
			</div>
			<!--- Kafelek #3 --->
			<div data-gsap-element="card" class="__card bg-white b-radius px-8 py-12">
				@if (!empty($g_third['image']))
				<div class="__img order1">
					<img class="img-xs !object-contain" src="{{ $g_third['image']['url'] }}" alt="{{ $g_third['image']['alt'] ?? '' }}">
				</div>
				@endif
				<div class="__content text-center mt-6">
					<h4 class="">{{ $g_third['title'] }}</h4>
					<div class="">
						{!! $g_third['content'] !!}
					</div>
					@if (!empty($g_third['button']))
					<a class="main-btn mt-6" href="{{ $g_third['button']['url'] }}">{{ $g_third['button']['title'] }}</a>
					@endif
				</div>
			</div>
		</div>

</section>