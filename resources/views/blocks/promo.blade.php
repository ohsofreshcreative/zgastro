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

<!--- promo -->

<section data-gsap-anim="section" @if($id) id="{{ $id }}" @endif class="promo -smt {{ $sectionClass }} {{ $class }}">

<div class="c-main">
	<div class="">
		<p class="text-xl text-gray">{{ $g_promo['subtitle'] }}</p>
		<h2 class="big w-3/4 mb-10">{{ $g_promo['title'] }}</h2>
	</div>

	{{-- ZMIANA: Usunięto klasę  --}}
	<div class="swiper promo-swiper !overflow-visible">

		<div class="swiper-wrapper">
			@foreach($promo as $card)
			<div class="swiper-slide">
				<div class="__card relative">
					@if(!empty($card['card_image']))
					<div class="__img img-xs m-img">
						{!! wp_get_attachment_image($card['card_image']['ID'], 'large', false, ['class' => 'img-fluid']) !!}
					</div>
					@endif

					{{-- Overlay teraz centruje zawartość --}}
					<div class="__overlay">
						{{-- Content jest teraz prostym kontenerem na treść --}}
						<div class="__content w-full lg:w-1/2">
							@if(!empty($card['card_title']))
							<h2 class="block text-white">{{ $card['card_title'] }}</h2>
							@endif
							@if(!empty($card['card_subtitle']))
							<h2 class="__txt text-white">{{ $card['card_subtitle'] }}</h2>
							@endif
							@if(!empty($card['button']))
							<a href="{{ $card['button']['url'] }}" class="arrow-btn m-btn" target="{{ $card['button']['target'] }}">
								{{ $card['button']['title'] }}
							</a>
							@endif
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>

		<div class="swiper-button-prev"></div>
		<div class="swiper-button-next"></div>
	</div>
	</div>

</section>