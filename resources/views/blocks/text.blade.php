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

<!--- text -->

<section data-gsap-anim="section" @if($id) id="{{ $id }}" @endif class="text relative -spt {{ $sectionClass }} {{ $class }}">

	<div class="__wrapper c-main relative">

		<div class="__content flex flex-col justify-center bg-shade-light b-radius order2 p-10 h-full">
			<h2 data-gsap-element="header" class="m-title">{{ $g_text['title'] }}</h2>

			<div data-gsap-element="txt" class="">
				{!! $g_text['content'] !!}
			</div>

			@if (!empty($g_text['button']))
			<a data-gsap-element="btn" class="main-btn m-btn" href="{{ $g_text['button']['url'] }}">{{ $g_text['button']['title'] }}</a>
			@endif

		</div>

</section>