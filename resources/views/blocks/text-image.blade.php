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

$sectionId = $block->data['id'] ?? null;
$customClass = $block->data['className'] ?? '';
@endphp

<!--- text-image -->

<section data-gsap-anim="section" @if($sectionId) id="{{ $sectionId }}" @endif class="text-image relative -smt {{ $block->classes }} {{ $customClass }} {{ $sectionClass }}">

	<div class="__wrapper c-main relative">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-10">
			@if (!empty($textimg['image']))
			<div data-gsap-element="img" class="__img order1">
				<img class="object-cover w-full __img img-xl" src="{{ $textimg['image']['url'] }}" alt="{{ $textimg['image']['alt'] ?? '' }}">
			</div>
			@endif

			<div class="__content order2">
				<h2 data-gsap-element="header" class="">{{ $textimg['title'] }}</h2>

				<div data-gsap-element="txt" class="mt-2">
					{!! $textimg['content'] !!}
				</div>

				@if (!empty($textimg['button']))
				<a data-gsap-element="btn" class="main-btn m-btn" href="{{ $textimg['button']['url'] }}">{{ $textimg['button']['title'] }}</a>
				@endif

			</div>

		</div>
		@if ($bgimage)
		<img data-gsap-element="bg1" class="__bg--first absolute" src="{{ $bgimage['url'] }}" alt="{{ $bgimage['alt'] ?? '' }}">
		@endif
	</div>

		@if ($bgimage2)
		<img data-gsap-element="bg2" class="__bg--second absolute" src="{{ $bgimage2['url'] }}" alt="{{ $bgimage2['alt'] ?? '' }}">
		@endif

</section>