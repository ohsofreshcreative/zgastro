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
<section data-gsap-anim="section" @if($id) id="{{ $id }}" @endif class="tabs c-main -smt {{ $sectionClass }} {{ $class }}">

  <div class="w-1/2 m-auto text-center">
    <h2 data-gsap-element="header">{{ $g_tabs['title'] ?? '' }}</h2>
    @if(!empty($g_tabs['txt']))
      <p data-gsap-element="txt" class="mt-2 text-xl">{!! $g_tabs['txt'] !!}</p>
    @endif
  </div>

  @if (!empty($r_tabs) && is_array($r_tabs))
    @php $activeIndex = 0; @endphp

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start pt-14">
      {{-- LEWY PANEL: TABS --}}
      <div class="lg:col-span-3 h-full">
        <div class="flex flex-row lg:flex-col justify-between h-full js-tabs-nav" role="tablist" aria-orientation="vertical">
          @foreach ($r_tabs as $i => $tab)
            <button
              type="button"
              class="tab_btn w-full text-left px-10 py-6 rounded-xl transition {{ $i === $activeIndex ? 'active' : '' }}"
              data-tab-index="{{ $i }}"
              role="tab"
              aria-controls="tab-panel-{{ $i }}"
              aria-selected="{{ $i === $activeIndex ? 'true' : 'false' }}"
            >
              <span class="tabs__h4 font-semibold">{{ $tab['tab'] ?? 'Zakładka ' . ($i+1) }}</span>
            </button>
          @endforeach
        </div>
      </div>

      {{-- PRAWY PANEL: TREŚĆ --}}
      <div class="lg:col-span-9">
        <div class="tabs-panels js-tabs-panels bg-white p-10 b-radius relative overflow-hidden">
          @foreach ($r_tabs as $i => $tab)
            <div
              id="tab-panel-{{ $i }}"
              role="tabpanel"
              class="__content relative-div {{ $i === $activeIndex ? 'active' : '' }}"
              aria-labelledby="tab-{{ $i }}"
            >
              <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-8">
                <div>
                  @if (!empty($tab['title']))
                    <h3 class="text-2xl font-bold mb-4">{{ $tab['title'] }}</h3>
                  @endif

                  @if (!empty($tab['txt']))
                    <div class="prose max-w-none">
                      {!! $tab['txt'] !!}
                    </div>
                  @endif
                </div>

                @if (!empty($tab['image']['url']))
                  <img class="rounded-xl img-l max-w-full h-auto overflow-visible"
                       src="{{ $tab['image']['url'] }}"
                       alt="{{ $tab['image']['alt'] ?? '' }}">
                @endif
              </div>  
            </div>
          @endforeach
        </div>
      </div>
    </div>
  @endif
</section>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
