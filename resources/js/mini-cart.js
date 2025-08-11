/**
 * Mini Cart (Vanilla CSS Version)
 */
export default class MiniCart {
  constructor() {
    this.miniCart = document.querySelector('#mini-cart');
    this.overlay = document.querySelector('#mini-cart-overlay');
    // Używamy naszej nowej klasy dla przycisku zamknięcia
    this.closeButton = document.querySelector('.mini-cart__close');

    if (!this.miniCart) {
      return;
    }

    this.init();
  }

  init() {
    // Sprawdzamy, czy jQuery jest dostępne (WooCommerce go wymaga)
    if (window.jQuery) {
      window.jQuery(document.body).on('added_to_cart', (e, fragments) => {
        this.openCart();
        this.updateCartContents(fragments);
      });
    }

    this.closeButton.addEventListener('click', this.closeCart.bind(this));
    this.overlay.addEventListener('click', this.closeCart.bind(this));
  }

  openCart() {
    this.miniCart.classList.add('is-open');
    this.overlay.classList.add('is-visible');
    document.body.classList.add('mini-cart-is-active');
  }

  closeCart(e) {
    if (e) e.preventDefault();
    this.miniCart.classList.remove('is-open');
    this.overlay.classList.remove('is-visible');
    document.body.classList.remove('mini-cart-is-active');
  }

  updateCartContents(fragments) {
    const miniCartContainer = this.miniCart.querySelector('.widget_shopping_cart_content');
    if (miniCartContainer && fragments && fragments['div.widget_shopping_cart_content']) {
      miniCartContainer.innerHTML = fragments['div.widget_shopping_cart_content'];
    }
  }
}