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

<!--- triple --->

<section data-gsap-anim="section" @if(!empty($id)) id="{{ $id }}" @endif class="triple -smt {{ $sectionClass }} {{ $class ?? '' }}">
	<div class="__wrapper c-main">

		<div class="w-full md:w-1/2 m-auto text-center">
			<h2 data-gsap-element="header">{{ $g_triple['title'] ?? '' }}</h2>
			@if(!empty($g_triple['txt']))
			<p data-gsap-element="txt" class="mt-2 text-xl">{!! $g_triple['txt'] !!}</p>
			@endif
		</div>

		@if (!empty($r_triple))
		<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-10">
			@foreach ($r_triple as $item)
			<div data-gsap-element="card">
				<div class="__card relative h-full b-shadow p-8 rounded-xl bg-white pt-48" style="background:linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, rgba(0, 0, 0, 0.90) 75%), url({{ $item['image']['url'] }}); background-size: cover; background-position: center;">
					<div>
						<h5 class="text-yellow">{{ $item['title'] }}</h5>
						<div class="text-lg text-white">{!! $item['txt'] !!}</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		@endif

	</div>
</section>