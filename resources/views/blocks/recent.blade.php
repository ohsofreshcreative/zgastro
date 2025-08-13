{{-- Zmienne $id, $class, $title, $subtitle, $products są przekazywane z Recent.php --}}

<section
	@if(!empty($id)) id="{{ $id }}" @endif
	class="recent -smt {{ $block->classes }} {{ $class ?? '' }} @if($lightbg) -light-bg @endif @if($nomt) -no-mt @endif"
	data-gsap-anim="section">
	<div class="c-main @if(!empty($title)) flex flex-col md:flex-row md:gap-8 items-center @endif">
		
		@if(!empty($title))
		<div class="__wrapper block w-full md:w-1/3 mb-8 md:mb-0 flex-shrink-0">
			<p class="text-xl text-gray">{{ $subtitle }}</p>
			<h1 class="big">{{ $title }}</h1>
		</div>
		@endif

		<div class="slider-clipper w-full @if(!empty($title)) md:w-[60vw] @endif overflow-hidden">
			@if(!empty($products))
			<div class="swiper recents-swiper !overflow-visible">
				<div class="swiper-wrapper">
					@foreach($products as $card)
					<div class="swiper-slide">
						<a href="{{ esc_url($card['button']['url']) }}"
							class=""
							target="{{ $card['button']['target'] ?? '_self' }}">
							<div class="__card">

								@if(!empty($card['card_image']))
								<div class="__img">
									{!! wp_get_attachment_image($card['card_image']['ID'], 'large', false, ['class' => 'img-m object-cover']) !!}
								</div>
								@endif

								@if(!empty($card['card_title']))
								<h5 class="product-title block m-title text-center">{{ $card['card_title'] }}</h5>
								@endif

								@if(!empty($card['card_txt']))
								<div class="__txt text-h6 text-center">{!! $card['card_txt'] !!}</div>
								@endif
							</div>
						</a>
					</div>
					@endforeach
				</div>

				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
			</div>
			@else

			@if(is_user_logged_in() && is_admin())
			<div class="acf-notice -warning" style="margin-left: auto; margin-right: auto; max-width: 1200px;">
				<p>Blok slidera produktów: Nie znaleziono żadnych produktów do wyświetlenia.</p>
			</div>
			@endif
			@endif
		</div>
	</div>
</section>
