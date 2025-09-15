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

// Sprawdzenie liczby kafelków w repeaterze
$gridColsClass = '';
if (!empty($g_proces['r_proces'])) {
    $count = count($g_proces['r_proces']);
    if ($count === 2) {
        $gridColsClass = 'lg:grid-cols-2';
    } elseif ($count === 3) {
        $gridColsClass = 'lg:grid-cols-3';
    } elseif ($count >= 4) {
        $gridColsClass = 'lg:grid-cols-4';
    } else {
        $gridColsClass = 'lg:grid-cols-1';
    }
}
@endphp

<section data-gsap-anim="section" @if($id) id="{{ $id }}" @endif class="proces -smt {{ $sectionClass }} {{ $class }}">
    <div class="__wrapper c-main-wide">
        <div class="relative">

            @if (!empty($g_proces['title']))
            <h2 data-gsap-element="header" class="text-center m-title">{{ strip_tags($g_proces['title']) }}</h2>
            @endif
            <div data-gsap-element="txt" class="text-center">{{ strip_tags($g_proces['txt']) }}</div>

            @if (!empty($g_proces['r_proces']))
            <div class="gap-8 grid grid-cols-1 {{ $gridColsClass }} mt-10">

                @foreach ($g_proces['r_proces'] as $item)
                <div data-gsap-element="stagger" class="__card relative flex gap-6 bg-white b-radius b-shadow z-10 p-10 pt-16">
                    <div class="__nr absolute -top-4 flex items-center justify-center w-10 h-10 rounded-full bg-yellow text-2xl font-bold text-third">
                        {{ $loop->iteration }}
                    </div>
                    <img class="" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
                    <div>
                        <h6 class="text-third m-title block">{{ $item['title'] }}</h6>
                        <div class="text-lg mt-2">{!! $item['txt'] !!}</div>
                    </div>
                </div>
                @endforeach

            </div>
            @endif

        </div>
    </div>
</section>
