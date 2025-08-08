@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';

$sectionId = $block->data['id'] ?? null;
$customClass = $block->data['className'] ?? '';
@endphp

<section data-gsap-anim="section" @if($sectionId) id="{{ $sectionId }}" @endif class="offers -smt {{ $block->classes }} {{ $customClass }} {{ $sectionClass }}">

	<div class="__wrapper c-main grid grid-cols-1 lg:grid-cols-2 items-center gap-10">

		@if (!empty($g_offers['image']))
		<img data-gsap-element="image" class="c-main-wide object-cover w-full __img img-xl order1" src="{{ $g_offers['image']['url'] }}" alt="{{ $g_offers['image']['alt'] ?? '' }}">
		@endif

		<div class="__content order2">
			<h2 data-gsap-element="header" class="">{{ $g_offers['title'] }}</h2>

			<div data-gsap-element="header" class="mt-2">
				{!! $g_offers['content'] !!}
			</div>

			@if (!empty($g_offers['use_tiles']))

			{{-- Kafelki --}}
			@if (!empty($g_offers['tiles_group']['subtitle']))
			<p  data-gsap-element="subheader" class="text-xl mt-6">{{ $g_offers['tiles_group']['subtitle'] }}</p>
			@endif

			@if (!empty($g_offers['tiles_group']['repeater']))
			<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6 mt-4">
				@foreach ($g_offers['tiles_group']['repeater'] as $tile)
				@if(!empty($tile['button']))
				<a data-gsap-element="tile" href="{{ $tile['button']['url'] }}" target="{{ $tile['button']['target'] }}">
					<div class="__tile bg-white b-border px-4 py-6 text-center">

						@if (!empty($tile['image']))
						<img src="{{ $tile['image']['url'] }}" alt="{{ $tile['image']['alt'] ?? '' }}" class="mx-auto mb-3">
						@endif

						@if (!empty($tile['title']))
						<b class="">{{ $tile['title'] }}</b>
						@endif

						<svg class="__arrow mx-auto mt-3" xmlns="http://www.w3.org/2000/svg" width="18" height="8" viewBox="0 0 18 8" fill="none">
							<path d="M17.8336 3.54332L14.8684 0.187869C14.6463 -0.0634537 14.2871 -0.0625185 14.066 0.190062C13.845 0.442611 13.8458 0.851095 14.0679 1.10245L16.0584 3.35484H0.567375C0.254014 3.35484 0 3.64368 0 4C0 4.35632 0.254014 4.64516 0.567375 4.64516H16.0583L14.0679 6.89755C13.8458 7.1489 13.845 7.55739 14.066 7.80994C14.2871 8.06255 14.6464 8.06342 14.8685 7.81213L17.8331 4.45729C18.0553 4.2051 18.0551 3.79468 17.8336 3.54332Z" />
						</svg>
					</div>
				</a>
				@endif
				@endforeach
			</div>
			@endif
			@else

			{{-- Przycisk --}}
			@if (!empty($g_offers['button']))
			<a data-gsap-element="btn" class="main-btn m-btn mt-6 inline-block" href="{{ $g_offers['button']['url'] }}">
				{{ $g_offers['button']['title'] }}
			</a>
			@endif
			@endif

		</div>

	</div>

</section>