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

<!--- title -->

<section data-gsap-anim="section" @if($id) id="{{ $id }}" @endif class="title relative -spt {{ $block->classes }} {{ $sectionClass }} {{ $class }}">

	<div class="__wrapper c-main">
		<p class="text-xl text-gray">{{ $g_title['subtitle'] }}</p>
		<h1 class="big">{{ $g_title['title'] }}</h1>
	</div>

</section>