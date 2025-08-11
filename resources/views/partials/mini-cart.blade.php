{{--
  Partials: Mini Cart
--}}

<div id="mini-cart" class="mini-cart" aria-labelledby="mini-cart-label">
  <div class="mini-cart__inner">
    {{-- Nagłówek koszyka --}}
    <div class="mini-cart__header">
      <h2 id="mini-cart-label" class="mini-cart__title">
        Koszyk
      </h2>
      <button type="button" class="mini-cart__close">
        <span class="sr-only">Zamknij panel</span>
        <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    {{-- Zawartość koszyka --}}
    <div class="mini-cart__content">
      <div class="woocommerce-mini-cart-container">
        @php(woocommerce_mini_cart())
      </div>
    </div>
  </div>
</div>

{{-- Tło --}}
<div id="mini-cart-overlay" class="mini-cart-overlay"></div>

<style>
/* resources/styles/components/mini-cart.css */

.mini-cart {
  position: fixed;
  top: 0;
  right: 0;
  z-index: 1000; /* Wysoki z-index, aby był na wierzchu */
  height: 100%;
  width: 100%;
  max-width: 380px; /* Szerokość koszyka */
  background-color: #ffffff;
  box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
  transform: translateX(100%); /* Domyślnie schowany za prawą krawędzią */
  transition: transform 0.3s ease-in-out;
}

.mini-cart.is-open {
  transform: translateX(0); /* Widoczny */
}

.mini-cart__inner {
  display: flex;
  flex-direction: column;
  height: 100%;
}

.mini-cart__header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1rem;
  border-bottom: 1px solid #e5e7eb;
}

.mini-cart__title {
  font-size: 1.125rem;
  font-weight: 500;
  margin: 0;
}

.mini-cart__close {
  background: none;
  border: none;
  padding: 0.5rem;
  cursor: pointer;
}

.mini-cart__close .icon {
  width: 1.5rem;
  height: 1.5rem;
  color: #9ca3af;
}

.mini-cart__close:hover .icon {
  color: #6b7280;
}

.mini-cart__content {
  flex-grow: 1;
  overflow-y: auto;
  padding: 1rem;
}

.mini-cart-overlay {
  position: fixed;
  inset: 0;
  z-index: 999;
  background-color: rgba(0, 0, 0, 0.25);
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
}

.mini-cart-overlay.is-visible {
  opacity: 1;
  visibility: visible;
}

/* Zapobiega scrollowaniu strony, gdy koszyk jest otwarty */
body.mini-cart-is-active {
  overflow: hidden;
}

/* Poprawki dla WooCommerce */
.mini-cart .widget_shopping_cart_content {
  padding: 0;
}</style>