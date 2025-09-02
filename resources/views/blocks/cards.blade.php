@php
$sectionClass = '';
$sectionClass .= !empty($flip) ? ' order-flip' : '';
$sectionClass .= !empty($wide) ? ' wide' : '';
$sectionClass .= !empty($nomt) ? ' !mt-0' : '';
$sectionClass .= !empty($gap) ? ' wider-gap' : '';
$sectionClass .= !empty($lightbg) ? ' section-light' : '';
$sectionClass .= !empty($graybg) ? ' section-gray' : '';
$sectionClass .= !empty($whitebg) ? ' section-white' : '';
$sectionClass .= !empty($brandbg) ? ' section-brand' : '';

$gTitle = $g_cards['title'] ?? '';
$gImage = $g_cards['image'] ?? null;
$gContent = $g_cards['content'] ?? '';

$items = is_array($r_cards ?? null) ? $r_cards : [];
$itemCount = count($items);

$cols = max(1, min($itemCount, 4));
$gridClass = $itemCount > 1 ? ('grid-cols-1 lg:grid-cols-' . $cols) : 'grid-cols-1';
@endphp

<section data-gsap-anim="section" @if(!empty($id)) id="{{ $id }}" @endif class="cards -smt {{ $sectionClass }} {{ $class ?? '' }}">
	<div class="__wrapper c-main">

		<div class="grid grid-cols-1 lg:grid-cols-[1fr_2fr] items-center gap-8 lg:gap-20">
			<img class="mb-6 max-w-full img-l rounded-xl" src="{{ $gImage['url'] }}" alt="{{ $gImage['alt'] ?? '' }}" loading="lazy" decoding="async" width="{{ $gImage['width'] ?? '' }}" height="{{ $gImage['height'] ?? '' }}">
			<div>
				<h2 class="mb-6">{{ strip_tags($gTitle) }}</h2>
				<div class=max-w-none">{!! $gContent !!}</div>
			</div>
		</div>

		@if($itemCount)
		<div class="grid {{ $gridClass }} gap-8 -mt-20">
			@foreach($items as $item)
			@php
			$img = $item['card_image'] ?? null;
			$title = $item['card_title'] ?? '';
			$txt = $item['card_txt'] ?? '';
			@endphp

			<div class="__card relative b-shadow p-6 rounded-xl bg-white">
				<img class="mb-2 w-[40px] h-auto shrink-0" src="{{ $img['url'] }}" alt="{{ $img['alt'] ?? '' }}" loading="lazy" decoding="async" width="{{ $img['width'] ?? '' }}" height="{{ $img['height'] ?? '' }}">

				<div>
					<b class="m-title block">{{ $title }}</b>
					<div class="text-lg mt-2">{!! $txt !!}</div>
				</div>
			</div>
			@endforeach
		</div>
		@endif

	</div>
</section>