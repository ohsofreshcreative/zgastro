@php
  // Pobierz repeater ACF z produktu
  $extras = get_field('product_extras', get_the_ID());
@endphp

@if (!empty($extras))
  <section class="product-extras pt-6 mt-6 space-y-3 y-border-t">
    @foreach ($extras as $row)
      @php
        $img = $row['image'] ?? null;
        $txt = $row['text'] ?? '';
      @endphp

      <article class="product-extra">
        <div class="product-extra__header">
          <h6 class="font-semibold">{{ esc_html($row['header']) }}</h6>
        </div>
        <div class="product-extra__content">
          {!! $txt !!}
        </div>
      </article>
    @endforeach
  </section>
@endif
