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

<!--- split -->

<section data-gsap-anim="section" @if($id) id="{{ $id }}" @endif class="split relative -smt {{ $sectionClass }} {{ $class }}">

	<div class="__wrapper c-main relative">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 items-start gap-10 w-full md:w-9/12 mx-auto">
			<h2 data-gsap-element="header" class="m-title">{{ $g_split['title'] }}</h2>

			<div data-gsap-element="txt" class="">
				{!! $g_split['content'] !!}
			</div>
		</div>
	</div>
</section>