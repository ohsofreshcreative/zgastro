@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
@endphp

<section data-gsap-anim="section" class="cta -smt {{ $sectionClass }}" style="background-image:linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ $cta['image']['url'] }}'); background-size:cover; background-position:center;">

	<div class="__wrapper c-main">
		<div class="py-20 text-center">

			@if ($cta['title'])
			<p class="text-white text-h3">{{ $cta['title'] }}</p>
			@endif
			@if (!empty($cta['button']))
			<a class="main-btn m-btn" href="{{ $cta['button']['url'] }}">{{ $cta['button']['title'] }}</a>
			@endif

		</div>
	</div>

</section>