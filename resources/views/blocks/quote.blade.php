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

<!--- quote -->

<section data-gsap-anim="section" @if($id) id="{{ $id }}" @endif class="quote relative -smt {{ $sectionClass }} {{ $class }}">

	<div class="__wrapper c-main relative">
		<div class="__col grid grid-cols-1 lg:grid-cols-[1fr_2fr] items-center gap-10">
			@if (!empty($g_quote['image']))
			<div data-gsap-element="img" class="__img order1">
				<img class="object-cover w-full __img img-m img-radius" src="{{ $g_quote['image']['url'] }}" alt="{{ $g_quote['image']['alt'] ?? '' }}">
			</div>
			@endif

			<div class="__content flex flex-col justify-center order2 h-full">
				<h2 data-gsap-element="header" class="m-title">{{ $g_quote['title'] }}</h2>
				<div class="__txt flex items-start gap-6">
					<img data-gsap-element="quote" class="w-12" src="/wp-content/uploads/2025/09/quote.svg" />
					<div data-gsap-element="txt" class="">
						{!! $g_quote['content'] !!}
					</div>
				</div>

			</div>

		</div>

</section>