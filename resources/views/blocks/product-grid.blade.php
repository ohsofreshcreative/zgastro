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

@if ($categories_data)
<section data-gsap-anim="section" @if($id) id="{{ $id }}" @endif class="product-grid relative -smt {{ $sectionClass }} {{ $class }}">
	<div class="container mx-auto px-4">
		<div class="">
			<p class="text-xl text-gray">{{ $subtitle }}</p>
			<h2 class="big">{{ $title }}</h2>
		</div>
		<div class="grid grid-cols-1 lg:grid-cols-4 gap-8 mt-14">
			<aside class="lg:col-span-1">
				<div class="sticky top-8">
					<h3 class="text-lg font-semibold mb-4">Wybierz swój styl</h3>
					<ul class="space-y-2">
						@foreach ($categories_data as $category)
						<li>
							<a href="#cat-{{ $category['slug'] }}" class="hover:text-primary-500 transition-colors">
								{{ $category['name'] }}
							</a>
						</li>
						@endforeach
					</ul>
				</div>
			</aside>

			<main class="lg:col-span-3">
				<div class="space-y-12">
					@foreach ($categories_data as $category)
					<div id="cat-{{ $category['slug'] }}" class="scroll-mt-8">
						{{-- Nagłówek kategorii --}}
						<div class="flex justify-between items-center mb-4">
							<h2 class="text-2xl font-bold">{{ $category['name'] }}</h2>
							<a href="{{ $category['link'] }}" class="text-sm font-semibold text-primary-600 hover:text-primary-800">
								Wszystkie produkty &rarr;
							</a>
						</div>

						{{-- Siatka produktów --}}
						@if (!empty($category['products']))
						<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
							@foreach ($category['products'] as $product)
							<div class="product-card">
								<a href="{{ $product['permalink'] }}">
									<div class="">
										{!! $product['image'] !!}
									</div>
									<div class="p-4">
										<h5 class="product-title">{{ $product['title'] }}</h5>
										@if ($product['price'])
										<p class="text-h6">{!! $product['price'] !!}</p>
										@endif
									</div>
								</a>
							</div>
							@endforeach
						</div>
						@else
						<p>Brak produktów w tej kategorii.</p>
						@endif
					</div>
					@endforeach
				</div>
			</main>
		</div>
	</div>
</section>
@else
@if (is_admin())
<div class="p-4 bg-yellow-100 text-yellow-800">
	Brak kategorii produktów do wyświetlenia. Dodaj je w panelu WooCommerce.
</div>
@endif
@endif