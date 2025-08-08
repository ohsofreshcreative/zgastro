@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
@endphp

<section data-gsap-anim="section" class="cards -smt {{ $sectionClass }}">
	<div class="__wrapper c-main">
		<div class="">
			
			@if (!empty($who['title']))
			<h2 class="mb-10 font-medium __txt w-1/2">{{ strip_tags($who['title']) }}</h2>
			@endif

			@if (!empty($who['repeater']))
			<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

				@foreach ($who['repeater'] as $item)
				<div class="__card">
					<img class="m-img" src="{{ $item['card_image']['url'] }}" alt="{{ $item['card_image']['alt'] ?? '' }}" />
					<h6 class="font-medium">{{ $item['card_title'] }}</h6>
					<p class="mt-3">{{ $item['card_txt'] }}</p>
				</div>
				@endforeach
			</div>
			@endif

		</div>
	</div>

</section>