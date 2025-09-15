@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $greybg ? ' section-grey' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
@endphp

<!--- text-tiles --->

<section data-gsap-anim="section" class="text-tiles -smt {{ $sectionClass }}">
	<div class="__wrapper c-main">

		<div class="w-full md:w-3/4 mx-auto text-center">
			@if (!empty($g_tiles['title']))
			<h2 data-gsap-element="header" class="m-title">{{ strip_tags($g_tiles['title']) }}</h2>
			@endif
			@if (!empty($g_tiles['text']))
			<p data-gsap-element="txt" class="__txt">{{ strip_tags($g_tiles['text']) }}</p>
			@endif
		</div>

		<div class="grid grid-cols-1 lg:grid-cols-2 gap-20 mt-10">

			@if (!empty($g_tiles['image']))
			<div data-gsap-element="img" class="__img order1 sticky top-20 h-max">
				<img class="object-cover w-full __img img-m img-radius" src="{{ $g_tiles['image']['url'] }}" alt="{{ $g_tiles['image']['alt'] ?? '' }}">
			</div>
			@endif

			<div class="">
				@if (!empty($g_tiles['text']))
				<p data-gsap-element="txt" class="__txt">{{ strip_tags($g_tiles['content']) }}</p>
				@endif
				@foreach ($repeater as $item)
				<div data-gsap-element="card" class="__card relative bg-white b-radius flex flex-col lg:flex-row gap-6 p-10 mt-6">
					<img class="w-16" src="{{ $item['card_image']['url'] }}" alt="{{ $item['card_image']['alt'] ?? '' }}" />
					<div>
						<h6 class="text-third">{{ $item['card_title'] }}</h6>
						<p class="mt-2">{{ $item['card_txt'] }}</p>
					</div>

				</div>
				@endforeach
			</div>

		</div>
	</div>

</section>