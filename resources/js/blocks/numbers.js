import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

/**
 * Animates a single number container with a slot machine effect.
 * @param {HTMLElement} container The container element with a data-number attribute.
 */
function animateNumber(container) {
  const targetNumberStr = container.dataset.number;
  if (typeof targetNumberStr === 'undefined') {
    return;
  }

  // --- Konfiguracja animacji (możesz tu łatwo zmieniać parametry) ---
  const DURATION = 4; // Zwiększony czas trwania animacji w sekundach
  const MIN_SPINS = 5; // Zwiększona minimalna liczba pełnych obrotów bębna

  // Clear any previous content
  container.innerHTML = '';

  const chars = targetNumberStr.split('');

  // Ustawiamy wysokość kontenera na podstawie pierwszej cyfry, aby uniknąć "skakania" layoutu
  if (chars.length > 0) {
    const tempSpan = document.createElement('span');
    tempSpan.textContent = '0';
    tempSpan.style.visibility = 'hidden';
    container.appendChild(tempSpan);
    const digitHeight = tempSpan.offsetHeight;
    container.innerHTML = ''; // Czyścimy po zmierzeniu
  }

  chars.forEach((char, index) => {
    const targetDigit = parseInt(char, 10);

    // Jeśli znak nie jest cyfrą, po prostu go dodaj bez animacji
    if (isNaN(targetDigit)) {
      const staticChar = document.createElement('span');
      staticChar.className = 'digit-static';
      staticChar.textContent = char;
      container.appendChild(staticChar);
      return;
    }

    // Stwórz kontener dla pojedynczej cyfry (okno)
    const digitContainer = document.createElement('div');
    digitContainer.className = 'digit-container';
    container.appendChild(digitContainer);

    // Stwórz bęben z cyframi
    const reel = document.createElement('div');
    reel.className = 'digit-reel';
    
    // --- KLUCZOWA ZMIANA: Tworzymy dłuższy bęben ---
    // Dodajemy cyfry dla obrotów (np. 0-9, 0-9, 0-9...)
    for (let s = 0; s < MIN_SPINS; s++) {
      for (let i = 0; i <= 9; i++) {
        const d = document.createElement('div');
        d.textContent = i;
        reel.appendChild(d);
      }
    }
    // Na końcu dodajemy cyfry potrzebne do wylądowania na tej właściwej
    for (let i = 0; i <= targetDigit; i++) {
      const d = document.createElement('div');
      d.textContent = i;
      reel.appendChild(d);
    }

    digitContainer.appendChild(reel);

    // Pobierz wysokość pojedynczej cyfry
    const digitHeight = reel.children[0].offsetHeight;

    // Obliczamy pozycję końcową
    const finalY = -((MIN_SPINS * 10 + targetDigit) * digitHeight);

    gsap.fromTo(
      reel,
      { y: 0 }, // Zacznij od pozycji '0'
      {
        y: finalY, // Przesuń bęben na obliczoną pozycję końcową
        duration: DURATION + index * 0.5, // Czas trwania animacji, lekko dłuższy dla kolejnych cyfr
        delay: index * 0.2, // Małe opóźnienie startu dla kaskadowego efektu
        ease: 'power2.inOut', // Zmieniony easing na bardziej płynny
      }
    );
  });
}

// Uruchomienie animacji po załadowaniu strony i przy scrollu
document.addEventListener('DOMContentLoaded', function () {
  const numberContainers = document.querySelectorAll('.number-container');

  numberContainers.forEach((container) => {
    ScrollTrigger.create({
      trigger: container,
      start: 'top 85%', // Kiedy 85% elementu jest widoczne od góry
      onEnter: () => animateNumber(container),
      once: true, // Uruchom animację tylko raz
    });
  });
});