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

<section data-gsap-anim="section" @if($id) id="{{ $id }}" @endif class="cards -smt {{ $sectionClass }} {{ $class }}">
	<div class="__wrapper c-main">
		<div class="">

			@if (!empty($tiles['title']))
			<h2 class="__before mb-10">{{ strip_tags($tiles['title']) }}</h2>
			@endif

			@if (!empty($tiles['repeater']))
			@php
			$itemCount = count($tiles['repeater']);
			$gridCols = $itemCount;

			if ($itemCount == 4) {
			$gridCols = 4;
			} elseif ($itemCount > 4) {
			$gridCols = 2; // Or handle it differently if there are more than 4 items
			}

			$gridClass = 'grid-cols-1'; // Default to 1 column
			if ($gridCols > 1) {
			$gridClass = 'grid-cols-1 lg:grid-cols-' . $gridCols;
			}
			@endphp

			<div class="grid {{ $gridClass }} gap-8">
				@foreach ($tiles['repeater'] as $item)
				<div class="__card relative flex items-start gap-4">
					<img class="mb-6 w-[40px]" src="{{ $item['card_image']['url'] }}" alt="{{ $item['card_image']['alt'] ?? '' }}" />
					<div>
						<b class="m-title">{{ $item['card_title'] }}</b>
						<p class="text-lg mt-2">{{ $item['card_txt'] }}</p>
					</div>
				</div>
				@endforeach
			</div>
			@endif

		</div>
	</div>

</section>