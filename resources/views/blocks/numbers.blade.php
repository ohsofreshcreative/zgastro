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

@php
$backgroundImage = !empty($g_numbers['image']['url']) ? "linear-gradient(270deg, rgba(114, 3, 10, 0.20) 0%, rgba(114, 3, 10, 0.90) 100%), url({$g_numbers['image']['url']})" : '';
@endphp

<!--- numbers --->

<section data-gsap-anim="section" class="numbers c-main !-mt-32 relative z-9 {{ $sectionClass }}" style="background-image: {{ $backgroundImage }}; background-size: cover; background-position: center;">

	<div class="__wrapper px-0 sm:px-10 py-8 sm:py-15">
		<div class="grid grid-cols-1 lg:grid-cols-[1fr_2fr] items-center gap-8">

			@if (!empty($g_numbers['title']))
			<h2 class="text-white">{{ strip_tags($g_numbers['title']) }}</h2>
			@endif

			 <div class="flex justify-between">
                @foreach ($g_numbers['r_numbers'] as $item)
                <div class="__card relative">
                    <div class="big text-white number-container" data-number="{{ $item['card_title'] }}">
                        {{-- Cyfry zostaną wygenerowane przez JavaScript --}}
                    </div>
                    <p class="text-2xl text-white">{{ $item['card_txt'] }}</p>
                </div>
                @endforeach
            </div>

		</div>
	</div>

</section>