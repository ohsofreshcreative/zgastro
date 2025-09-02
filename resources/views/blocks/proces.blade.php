@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
@endphp

<section data-gsap-anim="section" class="proces -smt {{ $sectionClass }}">
	<div class="__wrapper c-main-wide">
		<div class="relative">

			@if (!empty($g_proces['title']))
			<h2 class="text-center m-title">{{ strip_tags($g_proces['title']) }}</h2>
			@endif
			<div class="text-center">{{ strip_tags($g_proces['txt']) }}</div>

			@if (!empty($g_proces['r_proces']))
			<div class="gap-8 grid grid-cols-1 lg:grid-cols-3 mt-10">

				@foreach ($g_proces['r_proces'] as $item)
				<div data-gsap-element="stagger" class="__card relative flex gap-6 bg-white b-radius b-shadow z-10 p-10 pt-16">
					<div class="__nr absolute -top-4 flex items-center justify-center w-10 h-10 rounded-full bg-yellow text-2xl font-bold text-third">
						{{ $loop->iteration }}
					</div>
					<img class="m-img" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
					<div>
						<h5 class="m-title block">{{ $item['title'] }}</h5>
						<div class="text-lg mt-2">{!! $item['txt'] !!}</div>
					</div>
				</div>

				@endforeach
			</div>
			@endif

		</div>
	</div>

</section>