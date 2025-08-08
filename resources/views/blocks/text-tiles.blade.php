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
		<div class="grid grid-cols-1 lg:grid-cols-2 gap-20">

			<div class="__content relative lg:sticky top-8 h-max">
				@if (!empty($g_tiles['title']))
				<h2 data-gsap-element="header" class="__before">{{ strip_tags($g_tiles['title']) }}</h2>
				@endif

				@if (!empty($g_tiles['subtitle']))
				<h5 data-gsap-element="subheader" class="mt-10">{{ strip_tags($g_tiles['subtitle']) }}</h5>
				@endif

				@if (!empty($g_tiles['text']))
				<p data-gsap-element="txt" class="__txt mt-6">{{ strip_tags($g_tiles['text']) }}</p>
				@endif

				@if (!empty($g_tiles['button']))
				<a data-gsap-element="button" class="main-btn m-btn" href="{{ $g_tiles['button']['url'] }}">{{ $g_tiles['button']['title'] }}</a>

				<svg data-gsap-element="pattern" class="mt-10 hidden lg:block" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="601" height="245" viewBox="0 0 601 245" fill="none">
					<rect opacity="0.2" width="601" height="245" fill="url(#pattern0_39401_1332)" />
					<defs>
						<pattern id="pattern0_39401_1332" patternUnits="userSpaceOnUse" viewBox="5633 -825 78.4 78.4" width="3.9134777691122329%" height="9.6000005683120495%" x="298.1" y="120.1" patternContentUnits="objectBoundingBox">
							<path d="M5641 -825L5647.93 -813H5634.07L5641 -825Z" fill="#FF0000" />
						</pattern>
					</defs>
				</svg>
				@endif
			</div>

			<div class="">

				@foreach ($repeater as $item)
				<div data-gsap-element="card" class="__card relative b-border p-10 mt-6">
					<img class="m-img" src="{{ $item['card_image']['url'] }}" alt="{{ $item['card_image']['alt'] ?? '' }}" />
					<h6 class="">{{ $item['card_title'] }}</h6>
					<p class="">{{ $item['card_txt'] }}</p>
					<div class="absolute top-0 right-0">
						<svg xmlns="http://www.w3.org/2000/svg" width="87" height="87" viewBox="0 0 87 87" fill="none">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M86.9104 86.6418V0.431902H0.700457L66.9906 19.8442L86.9104 86.6418Z" fill="#E30613" />
						</svg>
					</div>
				</div>
				@endforeach
			</div>

		</div>
	</div>

</section>