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

<!--- form -->

<section data-gsap-anim="section" @if($id) id="{{ $id }}" @endif class="form relative -smt {{ $sectionClass }} {{ $class }}">

	<div class="__wrapper c-main relative">
		<div class="w-full md:w-9/12 mx-auto">
			<h2 data-gsap-element="header" class="m-title text-center">{{ $g_form['title'] }}</h2>

			<div data-gsap-element="txt" class="text-center">
				{!! $g_form['content'] !!}
			</div>

			<div data-gsap-element="form" class="w-full md:w-3/4 mx-auto bg-white b-radius p-10 mt-14">
				{!! $g_form['form'] !!}
			</div>
		</div>
	</div>
</section>