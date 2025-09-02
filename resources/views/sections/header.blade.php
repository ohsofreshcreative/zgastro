@php
use App\Walkers\DropdownWalker;
use App\Walkers\MobileDropdownWalker;
@endphp

<header x-data="{ mobileOpen: false }" class="relative top-0 z-50 bg-white shadow-md masthead fixed-top">

	<!-- Desktop Header -->
	<div class="items-center justify-between hidden h-full py-4 px-12 mx-auto md:flex">
		<a class="brand shrink-0" href="{{ home_url('/') }}">
			@if ($logo)
			<img src="{{ $logo['url'] }}" alt="{{ $logo['alt'] ?? 'Logo' }}" class="w-auto h-12">
			@else
			<span class="text-xl font-bold">{{ $siteName }}</span>
			@endif
		</a>
		@if (has_nav_menu('primary_navigation'))
		<nav class="ml-15 nav-primary w-full flex justify-center" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
			{!! wp_nav_menu([
			'theme_location' => 'primary_navigation',
			'menu_class' => 'nav flex gap-x-5 lg:gap-x-8 text-sm font-medium items-center', // Usunięto 'nav-link' jeśli jest zbędne
			'container' => false,
			'echo' => false,
			'walker' => new DropdownWalker(),
			]) !!}
		</nav>

		{{-- WOOCOMMERCE ICONS --}}
		<div class="flex items-center gap-5 ml-6">

			{{-- ACCOUNT --}}
			<a href="{{ get_permalink( wc_get_page_id('myaccount') ) }}" class="p-2 hover:text-gray-900" aria-label="Moje konto">
				<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
					<path opacity="0.9" fill-rule="evenodd" clip-rule="evenodd" d="M8.63225 3.22338C7.94264 4.26858 7.55849 5.77803 7.55849 7.52943C7.55849 10.3867 8.49263 12.3747 9.98848 13.1046C10.4306 13.3204 10.9496 13.4444 11.5576 13.4444C12.1494 13.4444 12.6575 13.3207 13.0934 13.1059C14.6141 12.3568 15.5568 10.299 15.5568 7.52943C15.5568 5.77803 15.1726 4.26858 14.483 3.22338C13.8136 2.20875 12.8528 1.61453 11.5576 1.61453C10.2624 1.61453 9.30169 2.20875 8.63225 3.22338ZM7.31302 2.35297C8.24475 0.940809 9.6787 0.0340271 11.5576 0.0340271C13.4366 0.0340271 14.8706 0.940809 15.8023 2.35297C16.7138 3.73456 17.1373 5.57769 17.1373 7.52943C17.1373 10.1535 16.3586 12.6727 14.5905 14.0274C14.8103 14.254 15.0814 14.4799 15.3993 14.7037C15.9898 15.1193 16.693 15.4938 17.4143 15.831C18.0589 16.1323 18.6974 16.3946 19.2667 16.6284C19.3339 16.656 19.3999 16.6832 19.4649 16.7099C20.0403 16.9468 20.6192 17.1866 20.9522 17.4086C21.5675 17.8188 22.0682 18.3625 22.4043 19.1241C22.7329 19.8691 22.8846 20.7785 22.8846 21.8976C22.8846 22.3341 22.5308 22.6879 22.0943 22.6879C21.6579 22.6879 21.304 22.3341 21.304 21.8976C21.304 20.9094 21.1684 20.2383 20.9583 19.7621C20.7555 19.3023 20.4658 18.9839 20.0755 18.7237C19.9055 18.6103 19.5085 18.4371 18.8633 18.1714C18.7991 18.1451 18.7333 18.118 18.6661 18.0903C18.0997 17.8578 17.4259 17.5811 16.7449 17.2628C15.9835 16.9069 15.1874 16.4873 14.4895 15.996C13.9954 15.6483 13.5246 15.2467 13.15 14.7834C12.6555 14.9424 12.1234 15.0248 11.5576 15.0248C11.0031 15.0248 10.4801 14.9485 9.99289 14.7996C9.62606 15.3043 9.12341 15.7124 8.59982 16.046C7.84267 16.5285 6.9447 16.9162 6.09082 17.2402C5.59512 17.4285 5.06377 17.6129 4.58204 17.7801C4.26384 17.8905 3.9673 17.9935 3.71698 18.085C3.37961 18.2084 3.10044 18.3193 2.88369 18.4225C2.65119 18.5333 2.5582 18.6043 2.53764 18.6248C2.45382 18.7087 2.34735 18.8725 2.2415 19.1421C2.13887 19.4035 2.05444 19.7189 1.98839 20.0601C1.85598 20.7443 1.81121 21.4593 1.81121 21.8976C1.81121 22.3341 1.45741 22.6879 1.02096 22.6879C0.584519 22.6879 0.230713 22.3341 0.230713 21.8976C0.230713 21.3781 0.28173 20.5604 0.436688 19.7598C0.514314 19.3588 0.621469 18.9438 0.77028 18.5646C0.915876 18.1937 1.12072 17.8067 1.42005 17.5073C1.63895 17.2884 1.9351 17.1237 2.20398 16.9957C2.48863 16.86 2.8231 16.729 3.1742 16.6007C3.48609 16.4866 3.79923 16.3782 4.12022 16.2672C4.56875 16.1119 5.03262 15.9515 5.52989 15.7626C6.35231 15.4504 7.13062 15.1081 7.75043 14.7131C8.08838 14.4978 8.35265 14.2834 8.5483 14.0715C6.76073 12.7483 5.97799 10.2474 5.97799 7.52943C5.97799 5.57769 6.40147 3.73456 7.31302 2.35297Z" fill="#1E1E1E" />
				</svg>
			</a>

			{{-- CART --}}
			<a href="{{ wc_get_cart_url() }}" class="relative p-2 hover:text-gray-900" aria-label="Koszyk">
				<svg xmlns="http://www.w3.org/2000/svg" width="21" height="26" viewBox="0 0 21 26" fill="none">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M10.8655 0.841675C8.76986 0.841675 7.06496 2.71371 7.06496 5.01475V6.40577H2.63104C2.30015 6.40577 2.02473 6.68565 1.99939 7.04787L0.732558 25.1312C0.71913 25.3242 0.779431 25.5149 0.899274 25.6573C1.01937 25.7991 1.18786 25.8801 1.3642 25.8801H20.3667C20.543 25.8801 20.7116 25.7991 20.8314 25.6573C20.9512 25.5151 21.0116 25.3245 20.9981 25.1312L19.7313 7.04787C19.7062 6.68565 19.4308 6.40577 19.0999 6.40577H14.666V5.01475C14.666 2.71371 12.9611 0.841675 10.8655 0.841675ZM8.33264 5.0148C8.33264 3.48079 9.46925 2.23276 10.8663 2.23276C12.2634 2.23276 13.4 3.48079 13.4 5.0148V6.40583H8.33264V5.0148ZM19.6819 24.4893L18.5126 7.79709H14.6652V9.88363C14.6652 10.2678 14.3817 10.5791 14.0318 10.5791C13.6819 10.5791 13.3984 10.2678 13.3984 9.88363V7.79709H8.33102V9.88363C8.33102 10.2678 8.0475 10.5791 7.69761 10.5791C7.3477 10.5791 7.06418 10.2678 7.06418 9.88363V7.79709H3.21681L2.04751 24.4893H19.6819Z" fill="#1E1E1E" />
				</svg>
				<span class="js-cart-count absolute -top-1 -right-1 min-w-[1.25rem] h-5 px-1 rounded-full bg-primary text-white text-xs flex items-center justify-center">
					{{ WC()->cart ? WC()->cart->get_cart_contents_count() : 0 }}
				</span>
			</a>

		</div>
		{{-- WOOCOMMERCE ICONS END --}}

		@endif
	</div>

	<!-- Mobile Header Bar -->
	<div class="flex items-center justify-between p-4 mobile-menu fixed-top md:hidden">
		<a class="brand shrink-0" href="{{ home_url('/') }}">
			@if ($logo)
			<img src="{{ $logo['url'] }}" alt="{{ $logo['alt'] ?? 'Logo' }}" class="w-auto h-12">
			@else
			<span class="text-lg font-bold">{{ $siteName }}</span>
			@endif
		</a>
		<div class="flex items-center gap-3">
			{{-- Lupa: otwieramy pole pod paskiem (prosto) --}}
			<button @click="$refs.mSearch.classList.toggle('hidden')" class="p-2" aria-label="Szukaj">
				<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
					<circle cx="11" cy="11" r="8" stroke-width="2" />
					<path d="M21 21l-3.8-3.8" stroke-width="2" />
				</svg>
			</button>
			<a href="{{ get_permalink( wc_get_page_id('myaccount') ) }}" class="p-2" aria-label="Moje konto">
				<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
					<path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Z" stroke-width="2" />
					<path d="M3 21a9 9 0 0 1 18 0" stroke-width="2" />
				</svg>
			</a>
			<a href="{{ wc_get_cart_url() }}" class="relative p-2" aria-label="Koszyk">
				<svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
					<path d="M6 6h15l-1.5 9h-12z" stroke-width="2" />
					<path d="M6 6l-2-3" stroke-width="2" />
					<circle cx="9" cy="21" r="1.5" />
					<circle cx="18" cy="21" r="1.5" />
				</svg>
				<span class="js-cart-count absolute -top-1 -right-1 min-w-[1.25rem] h-5 px-1 rounded-full bg-primary text-white text-xs flex items-center justify-center">
					{{ WC()->cart ? WC()->cart->get_cart_contents_count() : 0 }}
				</span>
			</a>
		</div>

		<button
			@click.stop="mobileOpen = !mobileOpen"
			class="p-2 text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset"
			aria-expanded="mobileOpen"
			aria-controls="mobile-menu-panel">
			<span class="sr-only">Otwórz menu główne</span>
			<svg x-show="!mobileOpen" class="block w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
			</svg>
			<svg x-show="mobileOpen" class="block w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" style="display: none;">
				<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
			</svg>
		</button>
		<div x-ref="mSearch" class="hidden px-4 py-2 bg-white border-b md:hidden">
			<form method="get" action="{{ esc_url( home_url('/') ) }}" class="flex">
				<input type="hidden" name="post_type" value="product">
				<input name="s" type="search" placeholder="Szukaj produktów…" class="flex-1 border rounded-l-md px-3 py-2">
				<button type="submit" class="px-3 py-2 border border-l-0 rounded-r-md bg-gray-100">Szukaj</button>
			</form>
		</div>
	</div>


	<!-- Mobile Menu Panel -->
	<div
		id="mobile-menu-panel"
		x-show="mobileOpen"
		@click.away="mobileOpen = false"
		@keydown.escape.window="mobileOpen = false"
		x-transition:enter="transition ease-out duration-200"
		x-transition:enter-start="opacity-0 transform translate-x-full"
		x-transition:enter-end="opacity-100 transform translate-x-0"
		x-transition:leave="transition ease-in duration-150"
		x-transition:leave-start="opacity-100 transform translate-x-0"
		x-transition:leave-end="opacity-0 transform translate-x-full"
		class="mobile-menu fixed top-0 right-0 bottom-0 w-full h-full bg-white shadow-xl z-[51] overflow-y-auto md:hidden" {{-- ZMIANA: Usunięto style="display: none;" i zmieniono z-40 na z-[51] --}}
		aria-label="Menu mobilne">
		<div class="p-4">
			<div class="flex items-center justify-between mb-6">
				<span class=""><a class="brand shrink-0" href="{{ home_url('/') }}"><img src="{{ $logo['url'] }}" alt="{{ $logo['alt'] ?? 'Logo' }}" class="w-auto h-12"></a></span>
				<button
					@click="mobileOpen = false"
					class="p-2 text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset">
					<span class="sr-only">Zamknij menu</span>
					<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
					</svg>
				</button>
			</div>

			@if (has_nav_menu('primary_navigation'))
			<nav class="flex flex-col space-y-1">
				{!! wp_nav_menu([
				'theme_location' => 'primary_navigation',
				'menu_class' => 'nav-mobile flex flex-col space-y-2',
				'container' => false,
				'echo' => false,
				'walker' => new MobileDropdownWalker(),
				]) !!}
			</nav>
			@endif

			<div class="pt-6 mt-8 border-t border-gray-200">
				<a href="/kontakt/" class="block w-full  main-btn">
					Umów konsultację
				</a>
			</div>
		</div>
	</div>
</header>