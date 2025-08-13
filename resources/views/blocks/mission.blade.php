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

<!--- g_mission -->

<section data-gsap-anim="section" @if($id) id="{{ $id }}" @endif class="mission relative mt-14 {{ $sectionClass }} {{ $class }}">

	<div class="__wrapper c-main relative">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 gap-10">
			@if (!empty($g_mission['image']))
			<div data-gsap-element="img" class="__img order-1 md:order-2">
				<img class="object-cover w-full __img img-xl" src="{{ $g_mission['image']['url'] }}" alt="{{ $g_mission['image']['alt'] ?? '' }}">
			</div>
			@endif

			<div class="__content flex flex-col justify-between order-2 md:order-1">

				<div data-gsap-element="txt" class="">
					{!! $g_mission['content'] !!}
				</div>

				@if (!empty($g_mission['button']))
				<a data-gsap-element="btn" class="arrow-btn m-btn" href="{{ $g_mission['button']['url'] }}">{{ $g_mission['button']['title'] }}</a>
				@endif
				@if (!empty($g_mission['image2']))
				<div data-gsap-element="img" class="__img order-1 md:order-2 mt-14">
					<img class="object-cover w-2/3 __img" src="{{ $g_mission['image2']['url'] }}" alt="{{ $g_mission['image2']['alt'] ?? '' }}">
				</div>
				@endif
			</div>

		</div>

</section>