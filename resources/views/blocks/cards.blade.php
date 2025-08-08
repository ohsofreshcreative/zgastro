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

<section data-gsap-anim="section" class="cards -smt {{ $sectionClass }}">
	<div class="__wrapper c-main">
		<div class="">

			@if (!empty($tiles['title']))
			<h2 class="__before mb-10">{{ strip_tags($tiles['title']) }}</h2>
			@endif

			@if (!empty($tiles['repeater']))
    @php
        $itemCount = count($tiles['repeater']);
        $gridCols = $itemCount;

        if ($itemCount == 4) {
            $gridCols = 2;
        } elseif ($itemCount > 4) {
            $gridCols = 2; // Or handle it differently if there are more than 4 items
        }

        $gridClass = 'grid-cols-1'; // Default to 1 column
        if ($gridCols > 1) {
            $gridClass = 'grid-cols-1 lg:grid-cols-' . $gridCols;
        }
    @endphp

    <div class="grid {{ $gridClass }} gap-8">
        @foreach ($tiles['repeater'] as $item)
            <div class="__card relative b-border p-8">
                <img class="mb-6" src="{{ $item['card_image']['url'] }}" alt="{{ $item['card_image']['alt'] ?? '' }}" />
                <h6 class="m-title">{{ $item['card_title'] }}</h6>
                <p class="">{{ $item['card_txt'] }}</p>

                <div class="absolute top-0 right-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="87" height="87" viewBox="0 0 87 87" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M86.9104 86.6418V0.431902H0.700457L66.9906 19.8442L86.9104 86.6418Z" fill="#E30613" />
                    </svg>
                </div>
            </div>
        @endforeach
    </div>
@endif

		</div>
	</div>

</section>