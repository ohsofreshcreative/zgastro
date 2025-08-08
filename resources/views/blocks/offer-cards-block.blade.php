@php
$sectionClass = '';

$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $graybg ? ' section-gray' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $brandbg ? ' section-brand' : '';

$sectionId = $block->data['id'] ?? null;
$customClass = $block->data['className'] ?? '';
@endphp

<!-- offer-cards-block -->

<section data-gsap-anim="section" @if($sectionId) id="{{ $sectionId }}" @endif class="offer-cards -smt {{ $block->classes }} {{ $customClass }} {{ $sectionClass }}">
	<div class="{{ $block->classes }}">

		<div class="__wrapper c-main">
			<h2 data-gsap-element="header" class="m-title __before">{{ $title }}</h2>
			<div data-gsap-element="txt" class="mb-14">{!! $content !!}</div>

			@if(!empty($offer_cards))
			@if($display_type === 'grid')
			<div class="__grid mt-10 columns-{{ $columns ?? '3' }}">
				@foreach($offer_cards as $card)
				<div class="__cards">
					<a href="{{ $card['cta']['url'] }}" target="{{ $card['cta']['target'] }}">
						<div data-gsap-element="card" class="__card bg-white b-border-light">

							<div class="__content p-10">
								@if(!empty($card['offer_title']))
								<h5 class="block m-title">{{ $card['offer_title'] }}</h5>
								@endif
								@if(!empty($card['offer_description']))
								<div class="__txt">{{ $card['offer_description'] }}</div>
								@endif
								@if(!empty($card['cta']))
								<div class="__anchor m-btn">
									<svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 20" fill="none">
										<path d="M11.5645 0L22 10L11.5645 20L8.83878 17.388L14.6211 11.847H0V8.15301H14.6211L8.83878 2.61205L11.5645 0Z" fill="#E30613" />
									</svg>
								</div>
								@endif
							</div>

							@if(!empty($card['offer_image']))
							<div class="__img">
								{!! wp_get_attachment_image($card['offer_image']['ID'], 'medium', false, ['class' => 'img-fluid']) !!}
							</div>
							@endif
						</div>
					</a>
				</div>
				@endforeach
			</div>
		</div>
		@else

		<div class="swiper offer-swiper !overflow-visible">
			<div data-gsap-element="arrows" class="__arrows absolute flex gap-4 z-10">
				<div class="swiper-button-prev">
					<svg xmlns="http://www.w3.org/2000/svg" width="12" height="24" viewBox="0 0 12 24" fill="none">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M0.5 0L11.5 12.0235L0.5 24L6.26389 12.0706L0.5 0Z" fill="white" />
					</svg>
					</svg>
				</div>

				<div class="swiper-button-next">
					<svg xmlns="http://www.w3.org/2000/svg" width="12" height="24" viewBox="0 0 12 24" fill="none">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M0.5 0L11.5 12.0235L0.5 24L6.26389 12.0706L0.5 0Z" fill="white" />
					</svg>
				</div>
			</div>
			<div class="swiper-wrapper items-stretch">

				@foreach($offer_cards as $card)
				<div class="swiper-slide !h-auto">
					<a href="{{ $card['cta']['url'] }}" target="{{ $card['cta']['target'] }}">
						<div data-gsap-element="card" class="__card bg-white b-border-light">

							<div class="__content p-10">
								@if(!empty($card['offer_title']))
								<h5 class="block m-title">{{ $card['offer_title'] }}</h5>
								@endif
								@if(!empty($card['offer_description']))
								<div class="__txt">{{ $card['offer_description'] }}</div>
								@endif
								@if(!empty($card['cta']))
								<div class="__anchor m-btn">
									<svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 20" fill="none">
										<path d="M11.5645 0L22 10L11.5645 20L8.83878 17.388L14.6211 11.847H0V8.15301H14.6211L8.83878 2.61205L11.5645 0Z" fill="#E30613" />
									</svg>
								</div>
								@endif
							</div>

							@if(!empty($card['offer_image']))
							<div class="__img">
								{!! wp_get_attachment_image($card['offer_image']['ID'], 'medium', false, ['class' => 'img-fluid']) !!}
							</div>
							@endif
						</div>
					</a>
				</div>
				@endforeach
			</div>
		</div>
		@endif
		@else
		<div class="no-data">Brak danych oferty. Dodaj je w ustawieniach.</div>
		@endif
	</div>

</section>