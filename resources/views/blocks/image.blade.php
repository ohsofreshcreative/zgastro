@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';

$sectionId = $block->data['id'] ?? null;
$customClass = $block->data['className'] ?? '';

@endphp

<section data-gsap-anim="section" @if($sectionId) id="{{ $sectionId }}" @endif class="image -smt">

	<div class="__wrapper">

		<a data-gsap-element="btn" href="{{ $g_image['button']['url'] }}"><img class="object-cover w-full __img" src="{{ $g_image['image']['url'] }}" alt="{{ $g_image['image']['alt'] ?? '' }}"></a>

	</div>

</section>