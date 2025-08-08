@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $greybg ? ' section-grey' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $brandbg ? ' section-brand' : '';

$sectionId = $block->data['id'] ?? null;
$customClass = $block->data['className'] ?? '';
@endphp

<section data-gsap-anim="section" @if($sectionId) id="{{ $sectionId }}" @endif class="text-image relative -smt {{ $block->classes }} {{ $customClass }} {{ $sectionClass }}">

	<div class="__wrapper c-main relative">
		<div class="__content order2">
			<div class="__txt w-1/2 mx-auto">
				<h2 data-gsap-element="header" class="text-center __before m-title">{{ $g_overlap['title'] }}</h2>

				<div data-gsap-element="header" class="text-center">
					{!! $g_overlap['content'] !!}
				</div>
			</div>

			<div class="grid grid-cols-1 gap-8 mt-14">
				@foreach ($r_overlap as $item)
				<div class="gsap__cards __cards sticky top-20 mt-4">
					<div class="gsap__card __card  b-border p-8" style="background-image:url({{ $item['r_image']['url'] }}); background-size: cover; background-position: center;">
						<div class="w-1/2 bg-white b-border p-10 ml-auto my-14 mr-14">
							<h6 class="m-title">{{ $item['r_header'] }}</h6>
							<p class="">{!! $item['r_txt'] !!}</p>
						</div>
					</div>
				</div>
				@endforeach
			</div>


		</div>
	</div>

</section>