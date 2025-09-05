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

<section data-gsap-anim="section" @if($id) id="{{ $id }}" @endif class="about relative -mt-14 {{ $sectionClass }} {{ $class }}">
	<div class="__wrapper c-main relative">
		<div class="__col w-full md:w-2/3 ml-0 ml-36">
			<div class="">
				@if (!empty($g_about1['image']))
				<div data-gsap-element="img" class="__img relative w-max">
					<img class="__img1 img-radius" src="{{ $g_about1['image']['url'] }}" alt="{{ $g_about1['image']['alt'] ?? '' }}">
					<img class="absolute top-1/2 -right-1/2 -translate-y-1/2 -translate-x-1/2" src="{{ $g_about1['logo']['url'] }}" alt="{{ $g_about1['logo']['alt'] ?? '' }}">
				</div>
				@endif
			</div>

			<div class="__content flex flex-col mt-26">
				<h2 data-gsap-element="header" class="m-title">{{ $g_about1['title'] }}</h2>
				<div data-gsap-element="txt" class="">
					{!! $g_about1['content'] !!}
				</div>
			</div>
		</div>
		<div class="__col -smt">
			<div class="__imgs grid grid-cols-1 md:grid-cols-[1fr_2fr] items-end gap-30">
				@if (!empty($g_about2['image1']))
				<div data-gsap-element="img" class="__img relative">
					<img class="img-radius img-l" src="{{ $g_about2['image1']['url'] }}" alt="{{ $g_about2['image1']['alt'] ?? '' }}">
				</div>
				@endif


				<div>
					<div class="__content flex flex-col">
						<h2 data-gsap-element="header" class="m-title">{{ $g_about2['title'] }}</h2>
						<div data-gsap-element="txt" class="">
							{!! $g_about2['content'] !!}
						</div>
					</div>
					@if (!empty($g_about2['image2']))
					<div data-gsap-element="img" class="__img relative mt-16 mb-30">
						<img class="img-radius" src="{{ $g_about2['image2']['url'] }}" alt="{{ $g_about2['image2']['alt'] ?? '' }}">
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</section>