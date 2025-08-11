{{-- Zmienne $id, $class, $title, $categories są przekazywane z Categories.php --}}

<section
	@if(!empty($id)) id="{{ $id }}" @endif
	class="categories -smt {{ $block->classes }} {{ $class ?? '' }}"
	data-gsap-anim="section">
	<div class="c-main">
		@if(!empty($title))
		<div class="__wrapper block">
			<p class="text-xl text-gray">{{ $subtitle }}</p>
			<h1 class="big">{{ $title }}</h1>
		</div>
		@endif

		@if(!empty($categories))
		<div class="swiper usage-swiper !overflow-visible mt-8">
			<div class="swiper-wrapper">
				@foreach($categories as $card)
				<div class="swiper-slide">
					<a href="{{ esc_url($card['button']['url']) }}"
						class=""
						target="{{ $card['button']['target'] ?? '_self' }}">
						<div class="__card">
							<div class="__rectangle absolute"></div>

							@if(!empty($card['card_image']))
							<div class="__img">
								{!! wp_get_attachment_image($card['card_image']['ID'], 'large', false, ['class' => 'img-m']) !!}
							</div>
							@endif

							@if(!empty($card['card_title']))
							<h6 class="block m-title text-center">{{ $card['card_title'] }}</h6>
							@endif

							@if(!empty($card['card_txt']))
							<div class="__txt">{{ $card['card_txt'] }}</div>
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
			<p>Blok slidera kategorii: Proszę wybrać przynajmniej jedną kategorię produktu w ustawieniach bloku.</p>
		</div>
		@endif
		@endif
	</div>
</section>