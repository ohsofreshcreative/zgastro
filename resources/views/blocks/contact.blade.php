@php
$sectionClass = '';
@endphp

<section data-gsap-anim="section" class="contact pt-1 {{ $sectionClass }}">

	<div class="__wrapper c-main-wide relative z-2">

		<div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mt-14">
			<div class="__content flex flex-col justify-center">
				<h2 class="flex">{!! $g_contact_1['title'] !!}</h2>
				<div class="__txt mt-4">{!! $g_contact_1['txt'] !!}</div>
				<div class="__data">
					<a class="__phone flex items-center w-max mt-4" href="tel:{{ $g_contact_1['phone'] }}">{{ $g_contact_1['phone'] }}</a>
					<a class="__mail flex items-center w-max" href="mailto:{{ $g_contact_1['phone'] }}">{{ $g_contact_1['mail'] }}</a>
					<b class="block mt-8">Adres</b>
					<div class="__address mt-4">{!! $g_contact_1['adres'] !!}</div>

					<div class="__social flex gap-4 mt-8">
						<a href=""><img src="/wp-content/uploads/2025/09/fb.svg" /></a>
						<a href=""><img src="/wp-content/uploads/2025/09/ig.svg" /></a>
					</div>
				</div>
			</div>
			<div class="__form b-radius bg-white p-10 ">
				<h4 class="text-third">{{ $g_contact_2['title'] }}</h4>
				<div class="contact-form-container">
					{!! do_shortcode($g_contact_2['shortcode']) !!}
				</div>
			</div>
		</div>
	</div>

</section>