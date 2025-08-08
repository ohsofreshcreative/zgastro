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

<section data-gsap-anim="section" class="cards -smt {{ $sectionClass }}">
	<div class="__wrapper c-main">

			<div class="w-1/2">
				<h2 class="__before m-title">{{ strip_tags($g_team['title']) }}</h2>
				<div data-gsap-element="txt" class="">
					{!! $g_team['content'] !!}
				</div>
			</div>

			@if (!empty($repeater))
			@php
			$itemCount = count($repeater);
			$gridCols = 1; // Domyślna wartość

			if ($itemCount == 2 || $itemCount == 3) {
			$gridCols = $itemCount;
			} elseif ($itemCount >= 4) {
			$gridCols = 2;
			}

			$gridClass = 'grid-cols-1'; // Domyślna klasa
			if ($gridCols > 1) {
			$gridClass = 'grid-cols-1 lg:grid-cols-' . $gridCols;
			}
			@endphp

			<div class="grid {{ $gridClass }} pt-14 gap-8">
				@foreach ($repeater as $item)
				<div class="__card relative">
					<img class="mb-6" src="{{ $item['card_image']['url'] }}" alt="{{ $item['card_image']['alt'] ?? '' }}" />
					
					<div class="b-border-l pl-5">
						<h6 class="m-title">{{ $item['card_title'] }}</h6>
						<i class="text-gray block">{{ $item['card_function'] }}</i>
						<a class="primary" href="mailto:{{ $item['card_mail'] }}">{{ $item['card_mail'] }}</a>
					</div>

				</div>
				@endforeach
			</div>
			@endif

	</div>

</section>