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
@endphp

<section data-gsap-anim="section" @if(!empty($id)) id="{{ $id }}" @endif class="triple -smt {{ $sectionClass }} {{ $class ?? '' }}">
	<div class="__wrapper c-main">

		<div class="w-1/2 m-auto text-center">
			<h2 data-gsap-element="header">{{ $g_triple['title'] ?? '' }}</h2>
			@if(!empty($g_triple['txt']))
			<p data-gsap-element="txt" class="mt-2 text-xl">{!! $g_triple['txt'] !!}</p>
			@endif
		</div>

		@if (!empty($r_triple))
		<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-10">
			@foreach ($r_triple as $item)
			<div class="__card relative b-shadow p-8 rounded-xl bg-white pt-48" style="background:linear-gradient(180deg, rgba(0, 0, 0, 0.00) 30%, rgba(0, 0, 0, 0.90) 85%), url({{ $item['image']['url'] }}); background-size: cover; background-position: center;">
				<div>
					<h4 class="text-yellow">{{ $item['title'] }}</h4>
					<div class="text-lg text-white">{!! $item['txt'] !!}</div>
				</div>
			</div>
			@endforeach
		</div>
		@endif

	</div>
</section>