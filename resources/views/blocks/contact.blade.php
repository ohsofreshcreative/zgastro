@php
$sectionClass = '';
@endphp

<section data-gsap-anim="section" class="contact -spt {{ $sectionClass }}">

	<div class="__wrapper c-main-wide relative z-2">
		<h2 class="flex __before m-title w-full md:w-1/2">{!! $g_contact_1['title'] !!}</h2>
		<div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mt-14">
			<div class="__content w-full lg:w-11/12 flex flex-col justify-between">
				<div class="__data">
					<b class="">Kontakt</b>
					<a class="__phone flex items-center w-max mt-4" href="tel:{{ $g_contact_1['phone'] }}">{{ $g_contact_1['phone'] }}</a>
					<a class="__mail flex items-center w-max" href="mailto:{{ $g_contact_1['phone'] }}">{{ $g_contact_1['mail'] }}</a>
					<b class="block mt-8">Adres</b>
					<div class="__address mt-4">{!! $g_contact_1['adres'] !!}</div>
					<b class="block mt-8">Dane spółki</b>
					<div class="__info mt-4">{!! $g_contact_1['data'] !!}</div>

					<a class="stroke-btn mt-16" href="#map" target="__blank">Sprawdź dojazd</a>
				</div>
			</div>
			<div class="__form b-border bg-white p-10 ">
				<h2>{{ $g_contact_2['title'] }}</h2>
				<div class="contact-form-container">
					{!! do_shortcode($g_contact_2['shortcode']) !!}
				</div>
			</div>
		</div>
	</div>
	<svg class="absolute top-0 right-0 z-1 opacity-10 lg:opacity-100" xmlns="http://www.w3.org/2000/svg" width="928" height="1098" viewBox="0 0 928 1098" fill="none">
		<path fill-rule="evenodd" clip-rule="evenodd" d="M250.351 0C250.351 0 88.4237 151.307 6.10352e-05 233.931L928 1097.67L927.439 531.5L762.568 239.794L896.513 0H250.351Z" fill="#E30613" />
	</svg>
</section>