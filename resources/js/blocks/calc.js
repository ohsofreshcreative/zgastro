const initializeCateringCalculator = () => {
  const calculatorBlock = document.getElementById('catering-calculator-block');
  if (!calculatorBlock || calculatorBlock.dataset.initialized === 'true') {
    return;
  }
  calculatorBlock.dataset.initialized = 'true';

  // Elementy formularza
  const guestsInput = calculatorBlock.querySelector('input[name="guests"]');
  const childrenInput = calculatorBlock.querySelector('input[name="children"]');
  
  // Checkboxy
  const soupCheckboxes = calculatorBlock.querySelectorAll('input[name="soups[]"]');
  const meatCheckboxes = calculatorBlock.querySelectorAll('input[name="meats[]"]');
  const sideCheckboxes = calculatorBlock.querySelectorAll('input[name="sides[]"]');
  const vegetableCheckboxes = calculatorBlock.querySelectorAll('input[name="vegetables[]"]');
  const appetizerCheckboxes = calculatorBlock.querySelectorAll('input[name="appetizers[]"]');
  const dessertCheckboxes = calculatorBlock.querySelectorAll('input[name="desserts[]"]');
  
  // Opcje serwowania
  const serviceRadios = calculatorBlock.querySelectorAll('input[name="service_type"]');
  const liveCookingDishCheckboxes = calculatorBlock.querySelectorAll('input[name="live_cooking_dishes[]"]');
  
  // Dodatkowe opcje
  const coffeeBuffetCheckbox = calculatorBlock.querySelector('input[name="coffee_buffet"]');
  const drinksCheckbox = calculatorBlock.querySelector('input[name="drinks"]');
  const equipmentCheckbox = calculatorBlock.querySelector('input[name="equipment_needed"]');

  // Elementy podsumowania
  const summary = {
    guests: document.getElementById('summary-guests'),
    children: document.getElementById('summary-children'),
    soups: document.getElementById('summary-soups'),
    mainDishes: document.getElementById('summary-main-dishes'),
    appetizers: document.getElementById('summary-appetizers'),
    desserts: document.getElementById('summary-desserts'),
    service: document.getElementById('summary-service'),
    extras: document.getElementById('summary-extras'),
    cost: document.getElementById('summary-cost'),
    warnings: document.getElementById('summary-warnings'),
  };

  // Liczniki
  const appetizerCounter = document.getElementById('appetizer-counter');
  const dessertCounter = document.getElementById('dessert-counter');

  // Pobieranie cen z data-attributes
  const prices = {
    soup: parseFloat(calculatorBlock.dataset.soupPrice) || 15,
    mainDish: parseFloat(calculatorBlock.dataset.mainDishPrice) || 40,
    childDish: parseFloat(calculatorBlock.dataset.childDishPrice) || 29,
    appetizer: parseFloat(calculatorBlock.dataset.appetizerPrice) || 110,
    dessert: parseFloat(calculatorBlock.dataset.dessertPrice) || 20,
    waiterBase: parseFloat(calculatorBlock.dataset.waiterBase) || 500,
    waiterAdditional: parseFloat(calculatorBlock.dataset.waiterAdditional) || 500,
    liveCookingBase: parseFloat(calculatorBlock.dataset.liveCookingBase) || 1000,
    liveCookingAdditional: parseFloat(calculatorBlock.dataset.liveCookingAdditional) || 500,
    chefServiceBase: parseFloat(calculatorBlock.dataset.chefServiceBase) || 1000,
    chefServiceAdditional: parseFloat(calculatorBlock.dataset.chefServiceAdditional) || 500,
    hotBuffet: parseFloat(calculatorBlock.dataset.hotBuffet) || 300,
    coffeeBuffet: parseFloat(calculatorBlock.dataset.coffeeBuffet) || 10,
    drinks: parseFloat(calculatorBlock.dataset.drinks) || 15,
  };

  const minPortions = {
    soup: parseInt(calculatorBlock.dataset.soupMin) || 15,
    mainDish: parseInt(calculatorBlock.dataset.mainDishMin) || 15,
  };

  const updateSummary = () => {
    const guests = parseInt(guestsInput?.value) || 0;
    const children = parseInt(childrenInput?.value) || 0;
    const totalPeople = guests + children;
    
    let totalCost = 0;
    let warnings = [];

    // === ZUPY ===
    const selectedSoups = Array.from(soupCheckboxes).filter(cb => cb.checked);
    if (selectedSoups.length > 0) {
      const soupPortions = totalPeople;
      if (soupPortions < minPortions.soup) {
        warnings.push(`Zupy: minimalne zamówienie to ${minPortions.soup} porcji tej samej zupy`);
      } else {
        totalCost += soupPortions * prices.soup;
      }
      summary.soups.innerHTML = selectedSoups.map(cb => cb.value).join(', ');
    } else {
      summary.soups.innerHTML = '<span class="empty">Brak</span>';
    }

    // === DANIA GŁÓWNE ===
    const selectedMeats = Array.from(meatCheckboxes).filter(cb => cb.checked);
    const selectedSides = Array.from(sideCheckboxes).filter(cb => cb.checked);
    const selectedVegetables = Array.from(vegetableCheckboxes).filter(cb => cb.checked);
    
    if (selectedMeats.length > 0 || selectedSides.length > 0 || selectedVegetables.length > 0) {
      if (guests < minPortions.mainDish && children === 0) {
        warnings.push(`Dania główne: minimalne zamówienie to ${minPortions.mainDish} porcji tej samej kompozycji`);
      } else {
        totalCost += guests * prices.mainDish;
        totalCost += children * prices.childDish;
      }
      
      const mainDishSummary = [];
      if (selectedMeats.length) mainDishSummary.push(`Mięso: ${selectedMeats.map(cb => cb.value).join(', ')}`);
      if (selectedSides.length) mainDishSummary.push(`Dodatki: ${selectedSides.map(cb => cb.value).join(', ')}`);
      if (selectedVegetables.length) mainDishSummary.push(`Warzywa: ${selectedVegetables.map(cb => cb.value).join(', ')}`);
      summary.mainDishes.innerHTML = mainDishSummary.join('<br>');
      
      if (children > 0) {
        summary.children.textContent = `${children} (porcje dziecięce)`;
      }
    } else {
      summary.mainDishes.innerHTML = '<span class="empty">Brak</span>';
    }

    // === ZAKĄSKI ===
    const selectedAppetizers = Array.from(appetizerCheckboxes).filter(cb => cb.checked);
    if (selectedAppetizers.length > 0) {
      const requiredPlatters = Math.ceil(totalPeople / 15);
      if (selectedAppetizers.length === 6) {
        totalCost += totalPeople * prices.appetizer;
        summary.appetizers.innerHTML = `${selectedAppetizers.length} półmisków (${requiredPlatters} wymagane dla ${totalPeople} osób)<br>${selectedAppetizers.map(cb => cb.value).join(', ')}`;
      } else {
        warnings.push(`Zakąski: wybierz dokładnie 6 półmisków (obecnie wybrano ${selectedAppetizers.length})`);
        summary.appetizers.innerHTML = `<span class="text-orange-600">Wybrano ${selectedAppetizers.length}/6 półmisków</span>`;
      }
    } else {
      summary.appetizers.innerHTML = '<span class="empty">Brak</span>';
    }

    // === DESERY ===
    const selectedDesserts = Array.from(dessertCheckboxes).filter(cb => cb.checked);
    if (selectedDesserts.length > 0) {
      const maxDesserts = parseInt(calculatorBlock.dataset.dessertMax) || 3;
      if (selectedDesserts.length <= maxDesserts) {
        totalCost += totalPeople * prices.dessert;
        summary.desserts.innerHTML = selectedDesserts.map(cb => cb.value).join(', ');
      } else {
        warnings.push(`Desery: maksymalnie ${maxDesserts} wybory (obecnie wybrano ${selectedDesserts.length})`);
        summary.desserts.innerHTML = `<span class="text-orange-600">Zbyt wiele wyborów (${selectedDesserts.length}/${maxDesserts})</span>`;
      }
    } else {
      summary.desserts.innerHTML = '<span class="empty">Brak</span>';
    }

    // === OBSŁUGA ===
    const selectedService = Array.from(serviceRadios).find(r => r.checked);
    if (selectedService) {
      const serviceType = selectedService.value;
      let serviceCost = 0;
      
      const guestBlocks = Math.ceil(totalPeople / 15);
      
      switch(serviceType) {
        case 'waiter':
          serviceCost = prices.waiterBase + (guestBlocks - 1) * prices.waiterAdditional;
          summary.service.innerHTML = `Obsługa kelnerska (${guestBlocks} kelner${guestBlocks > 1 ? 'ów' : ''}, 4h)`;
          break;
        case 'live_cooking':
          const selectedDishes = Array.from(liveCookingDishCheckboxes).filter(cb => cb.checked);
          serviceCost = prices.liveCookingBase + (guestBlocks - 1) * prices.liveCookingAdditional;
          summary.service.innerHTML = `Live cooking (${guestBlocks} stanowisk${guestBlocks > 1 ? 'a' : 'o'})<br>Dania: ${selectedDishes.map(cb => cb.value).join(', ') || 'brak wybranych'}`;
          if (selectedDishes.length === 0) {
            warnings.push('Live cooking: wybierz dania do przygotowania');
          }
          break;
        case 'chef_service':
          serviceCost = prices.chefServiceBase + (guestBlocks - 1) * prices.chefServiceAdditional;
          summary.service.innerHTML = `Serwowanie przez kucharzy (${guestBlocks} kucharz${guestBlocks > 1 ? 'y' : ''})`;
          break;
        case 'hot_buffet':
          serviceCost = prices.hotBuffet;
          summary.service.innerHTML = 'Bufet ciepły samoobsługowy';
          break;
        case 'none':
          summary.service.innerHTML = 'Bez obsługi';
          break;
      }
      
      totalCost += serviceCost;
    } else {
      summary.service.innerHTML = '<span class="empty">Nie wybrano</span>';
    }

    // === DODATKI ===
    const extras = [];
    if (coffeeBuffetCheckbox?.checked) {
      totalCost += totalPeople * prices.coffeeBuffet;
      extras.push(`Bufet kawowy (${totalPeople} os.)`);
    }
    if (drinksCheckbox?.checked) {
      totalCost += totalPeople * prices.drinks;
      extras.push(`Napoje (${totalPeople} os.)`);
    }
    if (equipmentCheckbox?.checked) {
      extras.push('Wystawa stołowa i sprzęt (wycena indywidualna)');
    }
    summary.extras.innerHTML = extras.length > 0 ? extras.join('<br>') : '<span class="empty">Brak</span>';

    // === PODSUMOWANIE ===
    summary.guests.textContent = guests || '0';
    summary.children.textContent = children || '0';
    summary.cost.textContent = `${Math.round(totalCost).toLocaleString('pl-PL')} zł`;
    
    // Wyświetlanie ostrzeżeń
    if (warnings.length > 0) {
      summary.warnings.innerHTML = `<div class="warning-box">
        <p class="warning-title">Uwaga:</p>
        ${warnings.map(w => `<p class="warning-item">${w}</p>`).join('')}
        <p class="warning-note">Skontaktujemy się w sprawie indywidualnej wyceny.</p>
      </div>`;
    } else {
      summary.warnings.innerHTML = '';
    }

    // Aktualizuj ukryte pole do wysłania
    const summaryInput = calculatorBlock.querySelector('input[name="summary-data"]');
    if (summaryInput) {
      summaryInput.value = `PODSUMOWANIE CATERING\n\nLiczba gości: ${guests}\nDzieci: ${children}\n\n${Array.from(summary.soups.parentElement.querySelectorAll('p')).map(p => p.textContent).join('\n')}\n\nKOSZT CAŁKOWITY: ${Math.round(totalCost).toLocaleString('pl-PL')} zł${warnings.length > 0 ? '\n\nUWAGI:\n' + warnings.join('\n') : ''}`;
    }
  };

  // Event listeners
  calculatorBlock.addEventListener('input', updateSummary);
  calculatorBlock.addEventListener('change', updateSummary);
  
  // Limit i licznik wyborów deserów
  const maxDesserts = parseInt(calculatorBlock.dataset.dessertMax) || 3;
  dessertCheckboxes.forEach(cb => {
    cb.addEventListener('change', () => {
      const checkedCount = Array.from(dessertCheckboxes).filter(c => c.checked).length;
      if (dessertCounter) {
        dessertCounter.innerHTML = `Wybrano: <span class="counter-value">${checkedCount}/${maxDesserts}</span>`;
      }
      if (checkedCount >= maxDesserts) {
        dessertCheckboxes.forEach(c => {
          if (!c.checked) c.disabled = true;
        });
      } else {
        dessertCheckboxes.forEach(c => c.disabled = false);
      }
    });
  });

  // Limit i licznik wyborów zakąsek (6 z 16)
  appetizerCheckboxes.forEach(cb => {
    cb.addEventListener('change', () => {
      const checkedCount = Array.from(appetizerCheckboxes).filter(c => c.checked).length;
      if (appetizerCounter) {
        appetizerCounter.innerHTML = `Wybrano: <span class="counter-value">${checkedCount}/6</span>`;
      }
      if (checkedCount >= 6) {
        appetizerCheckboxes.forEach(c => {
          if (!c.checked) c.disabled = true;
        });
      } else {
        appetizerCheckboxes.forEach(c => c.disabled = false);
      }
    });
  });

  updateSummary();
};

const setupCateringCalculator = () => {
  const cf7Form = document.querySelector('#catering-calculator-block .wpcf7-form');
  if (cf7Form && cf7Form.classList.contains('init')) {
    initializeCateringCalculator();
  } else {
    document.addEventListener('wpcf7init', initializeCateringCalculator, { once: true });
  }
};

document.addEventListener('DOMContentLoaded', setupCateringCalculator);