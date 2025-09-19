@php
$sectionClass = '';
$sectionId = $block->data['id'] ?? null;
$customClass = $block->data['className'] ?? '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $graybg ? ' section-gray' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $brandbg ? ' section-brand' : '';

@endphp

<section data-gsap-anim="section" @if($sectionId) id="{{ $sectionId }}" @endif class="reviews -smt {{ $customClass }} {{ $sectionClass }}">
	<div class="c-main">

		<div class="__wrapper text-center w-full md:w-1/2 m-auto pb-10">
			<h2 class="">{{ $g_reviews['title']}}</h2>
			<p>{{ $g_reviews['txt'] }}</p>
		</div>

		<div class="swiper usage-swiper !overflow-visible my-10">

			<div class="__arrows  flex gap-4 mb-10 ml-auto">
				<div class="swiper-button-prev">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none">
						<path d="M13.2296 5.31498C13.2293 5.31469 13.2291 5.31435 13.2287 5.31406L8.41118 0.281803C8.05027 -0.0951806 7.46652 -0.0937777 7.10727 0.285093C6.74806 0.663916 6.74944 1.27664 7.11036 1.65367L10.3449 5.03226H1.42198C0.912773 5.03226 0.5 5.46552 0.5 6C0.5 6.53448 0.912773 6.96774 1.42198 6.96774H10.3448L7.1104 10.3463C6.74949 10.7234 6.74811 11.3361 7.10731 11.7149C7.46656 12.0938 8.05037 12.0951 8.41123 11.7182L13.2288 6.68594C13.2291 6.68565 13.2293 6.68531 13.2296 6.68502C13.5907 6.30673 13.5896 5.69202 13.2296 5.31498Z" />
					</svg>
				</div>

				<div class="swiper-button-next">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none">
						<path d="M13.2296 5.31498C13.2293 5.31469 13.2291 5.31435 13.2287 5.31406L8.41118 0.281803C8.05027 -0.0951806 7.46652 -0.0937777 7.10727 0.285093C6.74806 0.663916 6.74944 1.27664 7.11036 1.65367L10.3449 5.03226H1.42198C0.912773 5.03226 0.5 5.46552 0.5 6C0.5 6.53448 0.912773 6.96774 1.42198 6.96774H10.3448L7.1104 10.3463C6.74949 10.7234 6.74811 11.3361 7.10731 11.7149C7.46656 12.0938 8.05037 12.0951 8.41123 11.7182L13.2288 6.68594C13.2291 6.68565 13.2293 6.68531 13.2296 6.68502C13.5907 6.30673 13.5896 5.69202 13.2296 5.31498Z" />
					</svg>
				</div>
			</div>
			<div class="swiper-wrapper ml-0 md:ml-30">

				@foreach($reviews as $card)
				<div class="swiper-slide">
					<div class="__card bg-white b-shadow b-radius px-8 py-8">
						<div class="__rectangle absolute"></div>
						<div class="__img mb-6">
							<img src="/wp-content/uploads/2025/08/stars.svg" />
						</div>

						@if(!empty($card['card_txt']))
						<div class="__txt">{{ $card['card_txt'] }}</div>
						@endif

						@if(!empty($card['card_name']))
						<b class="block mt-6">{{ $card['card_name'] }}</b>
						@endif

						@if(!empty($card['button']))
						<a href="{{ $card['button']['url'] }}" class="main-btn m-btn" target="{{ $card['button']['target'] }}">
							{{ $card['button']['title'] }}
						</a>
						@endif
					</div>
				</div>
				@endforeach
			</div>
			<img class="absolute top-1/2 -translate-y-1/2 left-0 rounded-r-3xl aspect-square" src="{{ $g_reviews['image']['url'] }}">

			<div class="text-right pt-8 ml-auto">
				<img class="ml-auto" src="/wp-content/uploads/2025/08/google.svg" />
				<p>45 opinii Google<br /><a class="!underline" href="https://www.google.com/search?sa=X&sca_esv=80f6c8a4b1eab6de&tbm=lcl&sxsrf=AE3TifONeYGA8zqd-uvpdt8h7pQoUo3sCQ:1756634002049&q=Zak%C5%82ad+Gastronomiczny+-+Catering+-+Wyroby+Garma%C5%BCeryjne+Opinie&rflfq=1&num=20&stick=H4sIAAAAAAAAAONgkxIxNDI0NjA1NTMzNjWxMDEyNrY0MNnAyPiK0T4qMftoU2KKgnticUlRfl5-bmZyVV6lgq6Cc2JJalFmXjqQGV5ZlJ9UCVRSlJt4dE9qUWVWXqqCf0FmXmbqIlZKTQAAyfEtEZ8AAAA&rldimm=12130556635484233904&hl=pl-PL&ved=2ahUKEwjM48TN47SPAxUyPRAIHT76OnsQ9fQKegQIMRAF&biw=1792&bih=903&dpr=2#lkt=LocalPoiReviews" target="_blank" rel="noopener">Sprawdź wszystkie</a></p>
			</div>
		</div>
	</div>
</section>


<!-- 	<div class="swiper">
  <div class="swiper-wrapper">
    <div class="swiper-slide">Slide 1</div>
    <div class="swiper-slide">Slide 2</div>
    <div class="swiper-slide">Slide 3</div>
  </div>

  <div class="swiper-pagination"></div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div> -->