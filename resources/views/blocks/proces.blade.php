@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
@endphp

<section data-gsap-anim="section" class="proces -smt {{ $sectionClass }}">
	<div class="__wrapper c-main-wide">
		<div class="relative">

			@if (!empty($proces['title']))
			<h2 class="__txt mb-10 font-medium">{{ strip_tags($proces['title']) }}</h2>
			@endif

			@if (!empty($proces['repeater']))
			<div class="gap-8 grid grid-cols-1 lg:grid-cols-5">

				@foreach ($proces['repeater'] as $item)
				<div data-gsap-element="stagger" class="flex flex-col z-10">
					<div class="__nr rounded-full flex justify-center items-center bg-primary w-10 h-10">
						{{ $loop->iteration }}
					</div>
					<h6 class="__content mt-6">{{ $item['proces_title'] }}</h6>
					<div class="w-8 h-8 rounded-full border-2 b-border-4 bg-white z-10 mt-10"></div>
				</div>

				@endforeach
			</div>
			<div class="__line absolute bg-primary z-0 origin-left scale-x-0"></div>
			@endif

		</div>
	</div>

</section>