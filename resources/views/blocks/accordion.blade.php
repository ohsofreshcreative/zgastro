@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $darkbg ? ' section-dark' : '';

$sectionId = $block->data['id'] ?? null;
$customClass = $block->data['className'] ?? '';
@endphp

<!-- accordion -->

<section data-gsap-anim="section" @if($sectionId) id="{{ $sectionId }}" @endif class="accordion faq relative overflow-hidden -smt {{ $block->classes }} {{ $customClass }} {{ $sectionClass }}">
	<div class="__wrapper c-main relative z-2">
		<h2 data-gsap-element="header" class="w-full lg:w-1/2 __before">{{ $g_accordion['title'] }}</h2>
		<div class="grid grid-cols-1 md:grid-cols-[1.3fr_2fr] gap-20 mt-10"> @if (!empty($g_accordion['image']))

			<img data-gsap-element="image" class="object-cover __img order1 img-xl" src="{{ $g_accordion['image']['url'] }}" alt="{{ $g_accordion['image']['alt'] ?? '' }}"> @endif

			<div class="__content order2"> @if (!empty($g_accordion['button'])) <a class="main-btn m-btn" href="{{ $g_accordion['button']['url'] }}">{{ $g_accordion['button']['title'] }}</a> @endif <div data-gsap-element="accordion" class="accordion-wrapper grid"> @foreach ($repeater as $item) <div class="accordion px-8"> <input class="acc-check" type="radio" name="radio-a" id="check{{ $loop->index }}" {{ $loop->first ? 'checked' : '' }}> <label class="accordion-label text-h5" for="check{{ $loop->index }}">{{ $item['title'] }}</label>

						<div class="accordion-content">
							<p>{!! $item['txt'] !!}</p>
						</div>
					</div> @endforeach </div>
			</div>
		</div>
	</div> @if ($bgimage) <svg class="__bg--first absolute -top-20 -left-50 z-1" xmlns="http://www.w3.org/2000/svg" width="772" height="1648" viewBox="0 0 772 1648" fill="none">
		<g filter="url(#filter0_f_39356_1630)">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M-90 300L472 825.028L-90 1348L204.482 827.084L-90 300Z" fill="#E30613" />
		</g>
		<defs>
			<filter id="filter0_f_39356_1630" x="-390" y="0" width="1162" height="1648" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
				<feFlood flood-opacity="0" result="BackgroundImageFix" />
				<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
				<feGaussianBlur stdDeviation="150" result="effect1_foregroundBlur_39356_1630" />
			</filter>
		</defs>
	</svg> @endif
</section>