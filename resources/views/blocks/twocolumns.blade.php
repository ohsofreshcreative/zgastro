@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
@endphp

<!--- two-columns --->

<section data-gsap-anim="section" class="b-two-cols -smt {{ $sectionClass }}">
	<div class="__wrapper c-main grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-8">
		<div data-gsap-element="card" class="__first">

			<img class="m-img img-m w-full object-cover rounded-4xl" src="{{ $col1['image']['url'] }}" alt="{{ $col1['image']['alt'] ?? '' }}">
			<h4 class="mt-5 primary">{{ $col1['title'] }}</h4>
			<p>{{ $col1['text'] }}</p>
			<h5 class="mt-5">{{ $col1['subtitle'] }}</h5>
			<div class="mt-4 __content">{!! $col1['content'] !!}</div>
			@if (!empty($col1['button']))
			<a href="{{ $col1['button']['url'] }}">{{ $col1['button']['title'] }}</a>
			@endif
		</div>
		<div data-gsap-element="card" class="__second">

			<img class="m-img img-m w-full object-cover rounded-4xl" src="{{ $col2['image']['url'] }}" alt="{{ $col2['image']['alt'] ?? '' }}">
			<h4 class="mt-6">{{ $col2['title'] }}</h4>
			<p>{{ $col2['text'] }}</p>
			<h5 class="mt-5">{{ $col2['subtitle'] }}</h5>
			<div class="mt-4 __content">{!! $col2['content'] !!}</div>
			@if (!empty($col2['button']))
			<a href="{{ $col2['button']['url'] }}">{{ $col2['button']['title'] }}</a>
			@endif
		</div>
	</div>

</section>