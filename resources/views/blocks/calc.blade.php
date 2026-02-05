<!--- calc-catering --->

<div class="b-calc-catering" id="catering-calculator-block"
     data-soup-price="{{ $soup_price ?? 15 }}"
     data-main-dish-price="{{ $main_dish_price ?? 40 }}"
     data-child-dish-price="{{ $main_dish_child_price ?? 29 }}"
     data-appetizer-price="{{ $appetizer_price ?? 110 }}"
     data-dessert-price="{{ $dessert_price ?? 20 }}"
     data-waiter-base="{{ $waiter_service['base_price'] ?? 500 }}"
     data-waiter-additional="{{ $waiter_service['additional_15_guests'] ?? 500 }}"
     data-waiter-hour="{{ $waiter_service['additional_hour'] ?? 100 }}"
     data-live-cooking-base="{{ $live_cooking['base_price'] ?? 1000 }}"
     data-live-cooking-additional="{{ $live_cooking['additional_15_guests'] ?? 500 }}"
     data-chef-service-base="{{ $chef_service['base_price'] ?? 1000 }}"
     data-chef-service-additional="{{ $chef_service['additional_15_guests'] ?? 500 }}"
     data-hot-buffet="{{ $hot_buffet_price ?? 300 }}"
     data-coffee-buffet="{{ $coffee_buffet_price ?? 10 }}"
     data-drinks="{{ $drinks_price ?? 15 }}"
     data-soup-min="{{ $soup_min_portions ?? 15 }}"
     data-main-dish-min="{{ $main_dish_min_portions ?? 15 }}"
     data-dessert-max="{{ $dessert_max_choices ?? 3 }}">
  
  <div class="c-main py-20">
    <div class="grid grid-cols-1 lg:grid-cols-[2fr_1fr] gap-8 lg:gap-12">
      
      <!-- LEWA KOLUMNA - FORMULARZ -->
      <div>
        
        <!-- LICZBA GOŚCI -->
        <div class="mb-8">
          <h4>Liczba osób</h4>
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium mb-2">Dorośli</label>
              <input type="number" name="guests" min="0" value="15">
            </div>
            <div>
              <label class="block text-sm font-medium mb-2">Dzieci <span class="text-xs text-gray-500">(porcja {{ $main_dish_child_price ?? 29 }} zł)</span></label>
              <input type="number" name="children" min="0" value="0">
            </div>
          </div>
        </div>

        <hr>

        <!-- ZUPY -->
        @if($soups)
        <div class="mb-8">
          <h4>Zupy ({{ $soup_price ?? 15 }} zł/os.)</h4>
          
          <div class="warning">Minimalne zamówienie: {{ $soup_min_portions ?? 15 }} porcji tej samej zupy</div>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            @foreach($soups as $soup)
            <label class="choice-tile">
              <input type="checkbox" name="soups[]" value="{{ $soup['name'] }}">
              <span class="choice-text">
                {{ $soup['name'] }} 
                @if($soup['popular'])
                <span class="popular-badge">★ Popularne</span>
                @endif
              </span>
            </label>
            @endforeach
          </div>
          @if($soup_hint)
          <div class="hint">{{ $soup_hint }}</div>
          @endif
        </div>

        <hr>
        @endif

        <!-- DANIA GŁÓWNE -->
        <div class="mb-8">
          <h4>Dania główne ({{ $main_dish_price ?? 40 }} zł/os.)</h4>
          <div class="warning">Minimalne zamówienie: {{ $main_dish_min_portions ?? 15 }} porcji tej samej kompozycji</div>
          
          @if($meats)
          <div class="mb-6">
            <p class="font-semibold mb-3 text-gray-700">Wybierz mięso/rybę/wege:</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
              @foreach($meats as $meat)
              <label class="choice-tile">
                <input type="checkbox" name="meats[]" value="{{ $meat['name'] }}">
                <span class="choice-text">{{ $meat['name'] }}</span>
              </label>
              @endforeach
            </div>
          </div>
          @endif

          @if($main_dish_hint)
          <div class="hint">{{ $main_dish_hint }}</div>
          @endif

          @if($sides)
          <div class="mt-4 mb-4">
            <p class="font-semibold mb-3 text-gray-700">Wybierz dodatek skrobiowy:</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
              @foreach($sides as $side)
              <label class="choice-tile">
                <input type="checkbox" name="sides[]" value="{{ $side['name'] }}">
                <span class="choice-text">{{ $side['name'] }}</span>
              </label>
              @endforeach
            </div>
          </div>
          @endif

          @if($vegetables)
          <div class="mb-4">
            <p class="font-semibold mb-3 text-gray-700">Wybierz surówkę/warzywa:</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
              @foreach($vegetables as $veg)
              <label class="choice-tile">
                <input type="checkbox" name="vegetables[]" value="{{ $veg['name'] }}">
                <span class="choice-text">{{ $veg['name'] }}</span>
              </label>
              @endforeach
            </div>
          </div>
          @endif
        </div>

        <hr>

        <!-- ZAKĄSKI -->
        @if($appetizers)
        <div class="mb-8">
          <h4>Zakąski ({{ $appetizer_price ?? 110 }} zł/os.)</h4>
          <div class="warning">{{ $appetizer_rule ?? '1 półmisek na każde 15 osób' }} | Wybierz dokładnie 8 półmisków z 16 dostępnych</div>
          
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            @foreach($appetizers as $appetizer)
            <label class="choice-tile">
              <input type="checkbox" name="appetizers[]" value="{{ $appetizer['name'] }}">
              <span class="choice-text">{{ $appetizer['name'] }}</span>
            </label>
            @endforeach
          </div>
          
          <div class="counter" id="appetizer-counter">Wybrano: <span class="counter-value">0/8</span></div>

          @if($appetizer_hint)
          <div class="hint">{{ $appetizer_hint }}</div>
          @endif
        </div>

        <hr>
        @endif

        <!-- DESERY -->
        @if($desserts)
        <div class="mb-8">
          <h4>Na słodko ({{ $dessert_price ?? 20 }} zł/os.)</h4>
          <div class="info">Wybierz maksymalnie {{ $dessert_max_choices ?? 3 }} ciasta</div>
          
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            @foreach($desserts as $dessert)
            <label class="choice-tile">
              <input type="checkbox" name="desserts[]" value="{{ $dessert['name'] }}">
              <span class="choice-text">{{ $dessert['name'] }}</span>
            </label>
            @endforeach
          </div>
          
          <div class="counter" id="dessert-counter">Wybrano: <span class="counter-value">0/{{ $dessert_max_choices ?? 3 }}</span></div>

          @if($dessert_hint)
          <div class="hint">{{ $dessert_hint }}</div>
          @endif
        </div>

        <hr>
        @endif

        <!-- OBSŁUGA -->
        <div class="mb-8">
          <h4>Sposób serwowania</h4>
          
          <div class="space-y-3">
            <!-- Bufet -->
            <label class="service-card">
              <div class="flex items-start gap-3">
                <input type="radio" name="service_type" value="hot_buffet">
                <div class="flex-1">
                  <div class="service-header">
                    <span class="service-title">Bufet samoobsługowy</span>
                    <span class="service-price">{{ $hot_buffet_price ?? 300 }} zł</span>
                  </div>
                  <p class="service-description">Stoły bufetowe, podgrzewacze, obrusy, naczynia do nakładania</p>
                </div>
              </div>
            </label>

            <!-- Kelner -->
            <label class="service-card">
              <div class="flex items-start gap-3">
                <input type="radio" name="service_type" value="waiter">
                <div class="flex-1">
                  <div class="service-header">
                    <span class="service-title">Obsługa kelnerska</span>
                  </div>
                  <p class="service-description">
                    Do 15 gości/1 kelner: {{ $waiter_service['base_price'] ?? 500 }} zł/4h<br>
                    Każde kolejne 15 osób: +{{ $waiter_service['additional_15_guests'] ?? 500 }} zł<br>
                    Każda dodatkowa godzina/kelner: +{{ $waiter_service['additional_hour'] ?? 100 }} zł
                  </p>
                </div>
              </div>
            </label>

            <!-- Live cooking -->
            <label class="service-card">
              <div class="flex items-start gap-3">
                <input type="radio" name="service_type" value="live_cooking">
                <div class="flex-1">
                  <div class="service-header">
                    <span class="service-title">Live cooking</span>
                  </div>
                  <p class="service-description">
                    Do 15 gości: {{ $live_cooking['base_price'] ?? 1000 }} zł + koszt dań<br>
                    Każde kolejne 15 osób: +{{ $live_cooking['additional_15_guests'] ?? 500 }} zł
                  </p>
                  
                  @if($live_cooking['dishes'])
                  <div class="service-options">
                    <p class="options-title">Wybierz dania:</p>
                    @foreach($live_cooking['dishes'] as $dish)
                    <label>
                      <input type="checkbox" name="live_cooking_dishes[]" value="{{ $dish['name'] }}">
                      <span>{{ $dish['name'] }}</span>
                    </label>
                    @endforeach
                  </div>
                  @endif
                </div>
              </div>
            </label>

            <!-- Kucharze -->
            <label class="service-card">
              <div class="flex items-start gap-3">
                <input type="radio" name="service_type" value="chef_service">
                <div class="flex-1">
                  <div class="service-header">
                    <span class="service-title">Serwowanie przez kucharzy</span>
                  </div>
                  <p class="service-description">
                    Do 15 gości: {{ $chef_service['base_price'] ?? 1000 }} zł<br>
                    Każde kolejne 15 osób: +{{ $chef_service['additional_15_guests'] ?? 500 }} zł<br>
                    <span class="text-orange-600">+ koszt wybranego dania głównego</span>
                  </p>
                </div>
              </div>
            </label>

            <!-- Bez obsługi -->
            <label class="service-card">
              <div class="flex items-start gap-3">
                <input type="radio" name="service_type" value="none">
                <div class="flex-1">
                  <div class="service-header">
                    <span class="service-title">Bez obsługi</span>
                  </div>
                  <p class="service-description">Tylko catering bez serwisu</p>
                </div>
              </div>
            </label>
          </div>
        </div>

        <hr>

        <!-- DODATKI -->
        <div class="mb-8">
          <h4>Dodatki</h4>
          
          <div class="space-y-3">
            <label class="addon-card">
              <div class="flex items-start gap-3">
                <input type="checkbox" name="coffee_buffet">
                <div class="flex-1">
                  <div class="addon-header">
                    <span class="addon-name">Bufet kawowy</span>
                    <span class="addon-price">{{ $coffee_buffet_price ?? 10 }} zł/os.</span>
                  </div>
                  <p class="addon-content">{{ $coffee_buffet_content ?? 'Kawa z ekspresu, Herbata, cytryna, mleko, warnik' }}</p>
                </div>
              </div>
            </label>

            <label class="addon-card">
              <div class="flex items-start gap-3">
                <input type="checkbox" name="drinks">
                <div class="flex-1">
                  <div class="addon-header">
                    <span class="addon-name">Napoje</span>
                    <span class="addon-price">{{ $drinks_price ?? 15 }} zł/os.</span>
                  </div>
                  <p class="addon-content">{{ $drinks_content ?? 'Woda z cytryną i miętą, Soki owocowe, Napoje gazowane' }}</p>
                </div>
              </div>
            </label>
          </div>
        </div>

        @if($equipment_note)
        <div class="equipment-notice">
          <p>{{ $equipment_note }}</p>
          <label class="equipment-checkbox">
            <input type="checkbox" name="equipment_needed">
            <span>Potrzebuję zastawy stołowej i sprzętu</span>
          </label>
        </div>
        @endif

        <hr>

        @if($shortcode)
        <div class="mt-8">
          {!! do_shortcode($shortcode) !!}
        </div>
        @else
        <p class="text-center text-gray-500 py-8">Wprowadź shortcode formularza Contact Form 7 w ustawieniach bloku.</p>
        @endif
      </div>

      <!-- PRAWA KOLUMNA - PODSUMOWANIE -->
      <div class="summary-sidebar">
        <h4 class="summary-title">Podsumowanie</h4>
        
        <div class="grid grid-cols-2 gap-4">
			<div class="summary-section guests">
			  <span class="summary-label">Liczba gości:</span>
			  <p id="summary-guests" class="summary-value">15</p>
			</div>
			
			<div class="summary-section flex guests">
			  <span class="summary-label">Dzieci:
			  <p id="summary-children" class="summary-value">0</p>
			</div>
		</div>

        <div class="hidden">
			<div class="summary-section">
			  <span class="summary-label">Zupy:</span>
			  <p id="summary-soups" class="summary-value empty">Brak</p>
			</div>
			<div class="summary-section">
			  <span class="summary-label">Dania główne:</span>
			  <p id="summary-main-dishes" class="summary-value empty">Brak</p>
			</div>
			<div class="summary-section">
			  <span class="summary-label">Zakąski:</span>
			  <p id="summary-appetizers" class="summary-value empty">Brak</p>
			</div>
			<div class="summary-section">
			  <span class="summary-label">Desery:</span>
			  <p id="summary-desserts" class="summary-value empty">Brak</p>
			</div>
			<div class="summary-section">
			  <span class="summary-label">Obsługa:</span>
			  <p id="summary-service" class="summary-value empty">Nie wybrano</p>
			</div>
			<div class="summary-section">
			  <span class="summary-label">Dodatki:</span>
			  <p id="summary-extras" class="summary-value empty">Brak</p>
			</div>
		</div>


        <div class="summary-divider"></div>
        <div class="summary-section cost">
          <span class="summary-label">Szacowany koszt:</span>
          <p id="summary-cost" class="summary-value">0 zł</p>
        </div>

        <div id="summary-warnings" class="summary-warnings"></div>

        <button id="trigger-cf7-submit" class="submit-button">
          Wyślij zapytanie ofertowe
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const triggerButton = document.getElementById('trigger-cf7-submit');
    const cf7Form = document.querySelector('#catering-calculator-block .wpcf7-form');

    if (triggerButton && cf7Form) {
      const cf7SubmitButton = cf7Form.querySelector('input[type="submit"]');
      if (cf7SubmitButton) {
        triggerButton.addEventListener('click', function(e) {
          e.preventDefault();
          cf7Form.requestSubmit(cf7SubmitButton);
        });
      }
    }

    // Liczniki
    const appetizerCheckboxes = document.querySelectorAll('input[name="appetizers[]"]');
    const appetizerCounter = document.getElementById('appetizer-counter');
    
    const dessertCheckboxes = document.querySelectorAll('input[name="desserts[]"]');
    const dessertCounter = document.getElementById('dessert-counter');
    const dessertMax = {{ $dessert_max_choices ?? 3 }};

    if (appetizerCheckboxes.length > 0 && appetizerCounter) {
      appetizerCheckboxes.forEach(cb => {
        cb.addEventListener('change', () => {
          const count = Array.from(appetizerCheckboxes).filter(c => c.checked).length;
          appetizerCounter.innerHTML = `Wybrano: <span class="counter-value">${count}/8</span>`;
        });
      });
    }

    if (dessertCheckboxes.length > 0 && dessertCounter) {
      dessertCheckboxes.forEach(cb => {
        cb.addEventListener('change', () => {
          const count = Array.from(dessertCheckboxes).filter(c => c.checked).length;
          dessertCounter.innerHTML = `Wybrano: <span class="counter-value">${count}/${dessertMax}</span>`;
        });
      });
    }
  });
</script>