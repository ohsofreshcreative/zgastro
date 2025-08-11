@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';

$sectionId = $block->data['id'] ?? null;
$customClass = $block->data['className'] ?? '';

@endphp

<section data-gsap-anim="section" @if($sectionId) id="{{ $sectionId }}" @endif class="baner -smt {{ $block->classes }} {{ $customClass }} {{ $sectionClass }}">

	<div class="__wrapper c-main">

		@if (!empty($g_baner['baner']))
		<a data-gsap-element="btn" href="{{ $g_baner['link']['url'] }}">
			<img class="object-cover w-full __img img-xl order1" src="{{ $g_baner['baner']['url'] }}" alt="{{ $g_baner['baner']['alt'] ?? '' }}">
		</a>
		@endif
	</div>

</section>