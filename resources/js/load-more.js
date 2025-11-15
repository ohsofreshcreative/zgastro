/**
 * Obsługa przycisku "Pokaż więcej" dla produktów WooCommerce.
 */
const initWooCommerceLoadMore = () => {
  console.log('1. Funkcja initWooCommerceLoadMore została wywołana.');

  const container = document.querySelector('[data-load-more-container]');
  const button = document.querySelector('[data-load-more-button]');
  const sageData = window.sage || null;

  // Diagnostyka
  console.log('2. Sprawdzanie elementów:', { container, button, sageData });

  if (!container || !button || !sageData) {
    console.error('3. BŁĄD: Jeden z kluczowych elementów nie został znaleziony. Przerywam działanie.');
    if (!container) console.error('-> Brak kontenera [data-load-more-container]');
    if (!button) console.error('-> Brak przycisku [data-load-more-button]');
    if (!sageData) console.error('-> Brak obiektu window.sage z danymi od WordPressa.');
    return;
  }

  console.log('3. Wszystkie elementy znalezione. Dodaję event listener do przycisku.');

  const spinner = button.querySelector('[data-load-more-spinner]');
  const buttonText = button.querySelector('span:not([data-load-more-spinner])');

  const showLoadingState = (isLoading) => {
    button.disabled = isLoading;
    if (spinner) spinner.classList.toggle('hidden', !isLoading);
    if (buttonText) buttonText.classList.toggle('hidden', isLoading);
  };

  button.addEventListener('click', async () => {
    console.log('4. Przycisk "Pokaż więcej" został kliknięty.');
    let currentPage = parseInt(container.dataset.currentPage, 10);
    const maxPages = parseInt(container.dataset.maxPages, 10);

    showLoadingState(true);
    const nextPage = currentPage + 1;

    try {
      const response = await fetch(sageData.ajax_url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
        },
        body: new URLSearchParams({
          action: 'load_more_products',
          page: nextPage,
          query: sageData.query_vars,
        }),
      });

      if (!response.ok) {
        throw new Error('Network response was not ok.');
      }

      const data = await response.json();
      console.log('5. Otrzymano odpowiedź z serwera:', data);

      if (data.success) {
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = data.data.html;
        const newProducts = Array.from(tempDiv.children);
        newProducts.forEach(product => container.appendChild(product));

        container.dataset.currentPage = nextPage;
        currentPage = nextPage;

        if (currentPage >= maxPages) {
          button.style.display = 'none';
        }
      } else {
        button.style.display = 'none';
      }
    } catch (error) {
      console.error('Błąd podczas ładowania produktów:', error);
      button.style.display = 'none';
    } finally {
      showLoadingState(false);
    }
  });
};

export { initWooCommerceLoadMore };