@if(!empty($bottom['title']) || !empty($bottom['image']) || !empty($bottom['button']))
<section data-gsap-anim="section" class="cta-bottom c-main relative overflow-hidden -smt bg-yellow b-radius">

	<div class="relative py-20 px-20 lg:m-auto flex flex-col md:flex-row gap-6 items-center justify-between z-1">
		@if(!empty($bottom['title']))
		<h2 data-gsap-element="header" class="text-third">{{ $bottom['title'] }}</h2>
		@endif

		@if(!empty($bottom['button']))
		<div data-gsap-element="btn">
		<a class="white-btn"
			href="{{ $bottom['button']['url'] }}"
			@if(!empty($bottom['button']['target']) && $bottom['button']['target']==='_blank' ) target="_blank" rel="noopener noreferrer" @endif>
			{{ $bottom['button']['title'] }}
		</a>
		</div>
		@endif
	</div> 
	@if(!empty($imageUrl))
    <img class="absolute top-0 -right-100 w-full h-full pointer-events-none select-none"
         src="{{ $imageUrl }}"
         alt="{{ $imageAlt }}">
  @endif
</section>
@endif

<footer class="footer -mt-30">

	<div class="bg-third">
		<div class="__wrapper c-main">
			<div class="__widgets footer-py grid gap-4 md:gap-6">
				@for ($i = 1; $i <= 5; $i++)
					@if (is_active_sidebar('sidebar-footer-' . $i))
					<div>@php(dynamic_sidebar('sidebar-footer-' . $i))</div>
			@endif
			@endfor
		</div>
	</div>
	</div>

	<div class="c-main flex flex-col md:flex-row justify-between gap-6 py-10 footer-bottom">
		<p class="">Copyright ©2025 <?php echo get_bloginfo('name'); ?>. All Rights Reserved</p>
		<p class="flex gap-2">Designed &amp; Developed by
			<a target="_blank" href="https://www.ohsofresh.pl" title="OhSoFresh"><img class="oh" src="/wp-content/themes/zgastro/resources/images/ohsofresh.svg"></a>
		</p>
	</div>
</footer>