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

<!--- g_about -->

<section data-gsap-anim="section" @if($id) id="{{ $id }}" @endif class="about relative mt-14 {{ $sectionClass }} {{ $class }}">

	<div class="__wrapper c-main relative">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 gap-10">
			<div class="order-1 md:order-2">
				<div data-gsap-element="txt" class="font-medium mt-2">
					{!! $g_about['lead'] !!}
				</div>
				@if (!empty($g_about['image']))
				<div data-gsap-element="img" class="__img">
					<img class="object-cover w-full __img img-s mt-10" src="{{ $g_about['image']['url'] }}" alt="{{ $g_about['image']['alt'] ?? '' }}">
				</div>
				@endif
			</div>

			<div class="__content flex flex-col order-2 md:order-1">
				<h5 data-gsap-element="header" class="m-title">{{ $g_about['title'] }}</h5>
				<div data-gsap-element="txt" class="">
					{!! $g_about['content'] !!}
				</div>

				@if (!empty($g_about['button']))
				<a data-gsap-element="btn" class="arrow-btn m-btn" href="{{ $g_about['button']['url'] }}">{{ $g_about['button']['title'] }}</a>
				@endif
			</div>

		</div>

</section>